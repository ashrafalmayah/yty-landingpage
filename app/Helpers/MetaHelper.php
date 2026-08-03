<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MetaHelper
{
    protected static array $queuedEvents = [];

    /**
     * Generate or retrieve a unique Event ID for deduplication.
     */
    public static function getEventId(): string
    {
        if (request()->hasHeader('X-Event-ID')) {
            return (string) request()->header('X-Event-ID');
        }

        return (string) Str::uuid();
    }

    /**
     * Get or set a persistent External ID cookie.
     */
    public static function getExternalId(): string
    {
        $cookieName = 'meta_external_id';
        $externalId = Cookie::get($cookieName);

        if (!$externalId) {
            $externalId = (string) Str::uuid();
            Cookie::queue($cookieName, $externalId, 60 * 24 * 365); // 1 year
        }

        return (string) $externalId;
    }

    /**
     * Format and hash PII user data for Meta CAPI.
     */
    public static function getUserData(?Request $request = null, array $inputData = []): array
    {
        $req = $request ?: request();
        $data = [];

        if (!empty($inputData['email'])) {
            $email = strtolower(trim($inputData['email']));
            $data['em'] = [hash('sha256', $email)];
        }

        if (!empty($inputData['phone'])) {
            $phone = preg_replace('/\D/', '', $inputData['phone']);
            if ($phone) {
                $data['ph'] = [hash('sha256', $phone)];
            }
        }

        if (!empty($inputData['name'])) {
            $name = strtolower(trim($inputData['name']));
            $parts = explode(' ', $name);
            $fn = $parts[0] ?? '';
            $ln = $parts[count($parts) - 1] ?? '';

            if ($fn) {
                $data['fn'] = [hash('sha256', $fn)];
            }
            if ($ln) {
                $data['ln'] = [hash('sha256', $ln)];
            }
        }

        // If PII was passed in inputData, persist it for future events; otherwise restore saved PII
        if (isset($data['em']) || isset($data['ph']) || isset($data['fn'])) {
            self::persistUserData($data);
        } else {
            $savedPii = self::getPersistedUserData();
            foreach (['em', 'ph', 'fn', 'ln'] as $key) {
                if (!empty($savedPii[$key])) {
                    $data[$key] = $savedPii[$key];
                }
            }
        }

        // Hardcoded location identifiers following Meta CAPI specs (City: sanaa, Country: ye, Zip: 15000)
        $data['ct'] = [hash('sha256', 'sanaa')];
        $data['st'] = [hash('sha256', 'sa')];
        $data['country'] = [hash('sha256', 'ye')];
        $data['zp'] = [hash('sha256', '15000')];

        // IP and User-Agent
        $ip = $req->header('X-Client-IP') ?: (Cookie::get('_client_ip_address') ?: $req->ip());
        $userAgent = $req->header('X-Client-User-Agent') ?: $req->userAgent();

        $data['client_ip_address'] = $ip;
        $data['client_user_agent'] = $userAgent;
        $data['external_id'] = [self::getExternalId()];

        // Handle _fbp and _fbc cookies
        $fbp = $req->header('X-Meta-FBP') ?: Cookie::get('_fbp');
        $fbc = $req->header('X-Meta-FBC') ?: Cookie::get('_fbc');

        if ($fbp) {
            $data['fbp'] = $fbp;
        }
        if ($fbc) {
            $data['fbc'] = $fbc;
        }

        \Log::info('User Data: ' . json_encode($data));

        return $data;
    }

    /**
     * Persist user PII data to session and cookie for future requests/events.
     */
    public static function persistUserData(array $userData): void
    {
        $piiKeys = ['em', 'ph', 'fn', 'ln'];
        $piiData = array_intersect_key($userData, array_flip($piiKeys));

        if (!empty($piiData)) {
            Session::put('meta_persisted_pii', $piiData);
            Session::save();
            Cookie::queue('meta_persisted_pii', json_encode($piiData), 60 * 24 * 365);
        }
    }

    /**
     * Retrieve persisted PII user data from session or cookie.
     */
    public static function getPersistedUserData(): array
    {
        $sessionData = Session::get('meta_persisted_pii');
        if (!empty($sessionData)) {
            return $sessionData;
        }

        $cookieData = Cookie::get('meta_persisted_pii');
        if ($cookieData) {
            $decoded = json_decode($cookieData, true);
            if (is_array($decoded)) {
                Session::put('meta_persisted_pii', $decoded);
                return $decoded;
            }
        }

        return [];
    }

    /**
     * Flash an event for the frontend JavaScript pixel (Next Request).
     */
    public static function flashEvent(string $eventName, string $eventId, array $customData = []): void
    {
        $events = Session::get('meta_events', []);
        $events[] = [
            'name' => $eventName,
            'id' => $eventId,
            'data' => $customData,
        ];
        Session::put('meta_events', $events);
        Session::save();
    }

    /**
     * Queue an event for current request execution.
     */
    public static function queueEvent(string $eventName, string $eventId, array $customData = []): void
    {
        self::$queuedEvents[] = [
            'name' => $eventName,
            'id' => $eventId,
            'data' => $customData,
        ];
    }

    /**
     * Get all events (Session Flashed + Current Request Queued).
     */
    public static function getAllEvents(): array
    {
        $flashed = Session::pull('meta_events', []);
        $all = array_merge($flashed, self::$queuedEvents);
        self::$queuedEvents = [];

        return $all;
    }

    /**
     * Flash user data to session for browser Pixel Advanced Matching.
     */
    public static function flashUserData(array $userData): void
    {
        $matchingKeys = ['em', 'ph', 'fn', 'ln', 'ct', 'st', 'country', 'zp', 'external_id'];
        $matchingData = array_intersect_key($userData, array_flip($matchingKeys));

        foreach ($matchingData as $k => $v) {
            if (is_array($v)) {
                $matchingData[$k] = $v[0] ?? '';
            }
        }

        Session::put('meta_advanced_matching', $matchingData);
        Session::save();
    }

    /**
     * Get Advanced Matching data for browser Pixel init object.
     */
    public static function getAdvancedMatchingData(): array
    {
        $matching = Session::pull('meta_advanced_matching', []);
        $savedPii = self::getPersistedUserData();

        foreach (['em', 'ph', 'fn', 'ln'] as $key) {
            if (empty($matching[$key]) && !empty($savedPii[$key])) {
                $matching[$key] = is_array($savedPii[$key]) ? ($savedPii[$key][0] ?? '') : $savedPii[$key];
            }
        }

        if (empty($matching['ct'])) $matching['ct'] = hash('sha256', 'sanaa');
        if (empty($matching['st'])) $matching['st'] = hash('sha256', 'sa');
        if (empty($matching['country'])) $matching['country'] = hash('sha256', 'ye');
        if (empty($matching['zp'])) $matching['zp'] = hash('sha256', '15000');
        if (empty($matching['external_id'])) $matching['external_id'] = self::getExternalId();

        return array_filter($matching);
    }
}
