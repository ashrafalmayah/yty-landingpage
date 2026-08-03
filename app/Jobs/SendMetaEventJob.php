<?php

namespace App\Jobs;

use FacebookAds\Api;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMetaEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $eventName,
        protected string $eventId,
        protected int $eventTime,
        protected string $sourceUrl,
        protected array $userData,
        protected array $customData = []
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $enabled = config('services.meta.enabled', true);
        $pixelId = config('services.meta.pixel_id');
        $accessToken = config('services.meta.access_token');
        $testEventCode = config('services.meta.test_event_code');

        if (!$enabled || !$pixelId || !$accessToken) {
            return;
        }

        try {
            Api::init(null, null, $accessToken);

            $event = (new Event())
                ->setEventName($this->eventName)
                ->setEventTime($this->eventTime)
                ->setEventId($this->eventId)
                ->setEventSourceUrl($this->sourceUrl)
                ->setActionSource('website')
                ->setUserData($this->buildUserData())
                ->setCustomData($this->buildCustomData());

            $request = (new EventRequest($pixelId))
                ->setEvents([$event]);

            if (!empty($testEventCode)) {
                $request->setTestEventCode($testEventCode);
            }

            $request->execute();
        } catch (\Exception $e) {
            Log::error("Meta CAPI Job Error [{$this->eventName}]: " . $e->getMessage(), [
                'event_id' => $this->eventId,
                'exception' => $e,
            ]);
            throw $e;
        }
    }

    /**
     * Build UserData object from array.
     */
    protected function buildUserData(): UserData
    {
        $userData = new UserData();
        $data = $this->userData;

        if (!empty($data['em'])) $userData->setEmails($data['em']);
        if (!empty($data['ph'])) $userData->setPhones($data['ph']);
        if (!empty($data['fn'])) $userData->setFirstNames($data['fn']);
        if (!empty($data['ln'])) $userData->setLastNames($data['ln']);
        if (!empty($data['external_id'])) $userData->setExternalIds($data['external_id']);
        if (!empty($data['client_ip_address'])) $userData->setClientIpAddress($data['client_ip_address']);
        if (!empty($data['client_user_agent'])) $userData->setClientUserAgent($data['client_user_agent']);
        if (!empty($data['fbp'])) $userData->setFbp($data['fbp']);
        if (!empty($data['fbc'])) $userData->setFbc($data['fbc']);

        return $userData;
    }

    /**
     * Build CustomData object from array.
     */
    protected function buildCustomData(): CustomData
    {
        $customData = new CustomData();
        $data = $this->customData;

        if (!empty($data['currency'])) $customData->setCurrency($data['currency']);
        if (isset($data['value'])) $customData->setValue($data['value']);
        if (!empty($data['content_name'])) $customData->setContentName($data['content_name']);
        if (!empty($data['content_category'])) $customData->setContentCategory($data['content_category']);
        if (!empty($data['status'])) $customData->setStatus($data['status']);

        return $customData;
    }
}
