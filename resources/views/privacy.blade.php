@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-[#f0f4f8]">
    <!-- ─── HEADER ─── -->
    <header style="background-color: #0F2042;" class="sticky top-0 z-50 shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}">
                <img
                    src="{{ asset('images/yty_logo.jpg') }}"
                    alt="شعار YTY"
                    class="h-12 w-auto object-contain rounded"
                />
            </a>
            <a
                href="{{ route('home') }}#booking-form"
                style="background-color: #1797B8; color: #fff;"
                class="px-5 py-2.5 rounded-lg transition-opacity hover:opacity-90 text-sm font-semibold"
            >
                احجز مكتبك
            </a>
        </div>
    </header>

    <!-- Page Title / Hero -->
    <section class="py-12 bg-gradient-to-b from-[#0F2042] to-[#162c57] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-3">
            <span class="inline-block px-3 py-1 bg-[#1797B8]/20 border border-[#1797B8]/40 rounded-full text-[#1797B8] text-xs font-semibold" style="font-family: 'Tajawal', sans-serif;">
                الخصوصية والأمان
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">سياسة الخصوصية</h1>
            <p class="text-slate-300 text-sm max-w-xl mx-auto leading-relaxed" style="font-family: 'Tajawal', sans-serif;">
                نحن في مركز YTY للأعمال نلتزم بحماية خصوصيتك وصيانة بياناتك الشخصية بشفافية وأمان تام.
            </p>
            <p class="text-xs text-slate-400 pt-2" style="font-family: 'Tajawal', sans-serif;">آخر تحديث: {{ date('Y/m/d') }}</p>
        </div>
    </section>

    <!-- Content Body -->
    <main class="flex-grow py-12">
        <div class="max-w-4xl mx-auto px-6 space-y-8">

            <!-- Card 1: Intro -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">1. مقدمة والتزام بالخصوصية</h2>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed" style="font-family: 'Tajawal', sans-serif;">
                    ترحب بكم منصة ومركز <strong>YTY (Yemen Tech Youth)</strong> للأعمال. توضح هذه السياسة كيفية جمع معلوماتكم الشخصية، استخدامها، وحمايتها عند زيارة موقعنا الإلكتروني أو حجز خدمات المكاتب وقاعات الاجتماعات لدينا في صنعاء. بتصفحك للموقع أو طلب خدماتنا، فإنك توافق على ممارسات جمع واستخدام البيانات الموضحة في هذه السياسة.
                </p>
            </div>

            <!-- Card 2: Data Collected -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">2. البيانات التي نجمعها</h2>
                </div>
                <div class="text-slate-600 text-sm leading-relaxed space-y-3" style="font-family: 'Tajawal', sans-serif;">
                    <p>نجمع البيانات للتقديم الأمثل للخدمات وتسهيل عملية التواصل، وتشمل:</p>
                    <ul class="list-disc list-inside space-y-2 pr-2 text-slate-700">
                        <li><strong>معلومات التواصل الأساسية:</strong> الاسم الكامل، رقم الهاتف/الواتساب عند تعبئة نموذج طلب الحجز.</li>
                        <li><strong>تفاصيل الطلب بالحجز:</strong> نوع المساحة المطلوبة (مكتب خاص، قاعة اجتماعات، مساحة مشتركة)، والملاحظات المرفقة بالطلب.</li>
                        <li><strong>البيانات التقنية والتحليلية:</strong> معلومات الجهاز والزيارة (عنوان IP، نوع المتصفح، وعناوين الصفحات المزارة) عبر أدوات التحليل مثل Meta Pixel لتطوير تجربة المستخدم.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 3: How we use data -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">3. كيفية استخدام البيانات</h2>
                </div>
                <div class="text-slate-600 text-sm leading-relaxed space-y-3" style="font-family: 'Tajawal', sans-serif;">
                    <p>نستخدم معلوماتك لأغراض محددة ومشروعة فقط، ومنها:</p>
                    <ul class="list-disc list-inside space-y-2 pr-2 text-slate-700">
                        <li>مراجعة وتأكيد طلبات الحجز وتوفير المساحة المناسبة لاحتياجاتك.</li>
                        <li>التواصل المباشر معك عبر الهاتف أو الواتساب لمتابعة تفاصيل الحجز وتقديم الدعم المطلوب.</li>
                        <li>إرسال تحديثات مهمة حول خدمات مركز YTY أو العروض المتاحة.</li>
                        <li>تحسين وتطوير أداء الموقع الإلكتروني وجوانب التسويق الرقمي.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 4: Data Security & Protection -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">4. حماية وأمان المعلومات</h2>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed" style="font-family: 'Tajawal', sans-serif;">
                    نلتزم باتخاذ كافة الإجراءات التقنية والتنظيمية المناسبة لحماية بياناتك من الوصول غير المصرح به، أو التغيير، أو الإفصاح، أو الإتلاف. تُحفظ بيانات الحجوزات في قواعد بيانات مؤمنة ومحمية، ولا يتم الوصول إليها إلا من قبل الفريق المختص بإدارة الحجوزات وخدمة العملاء.
                </p>
            </div>

            <!-- Card 5: Cookies & Meta Pixel -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">5. ملفات تعريف الارتباط (Cookies) والتحليلات</h2>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed" style="font-family: 'Tajawal', sans-serif;">
                    يستخدم موقعنا ملفات تعريف الارتباط التقنية وأداة (Meta Pixel) لقياس وتتبع تفاعلات الزوار مع الموقع، مثل إرسال طلبات الحجز أو النقر على روابط التواصل. تساعدنا هذه البيانات الإحصائية في فهم اهتمامات زوارنا وتحسين حملاتنا الإعلانية، ولا تهدف إلى كشف الهوية الشخصية بدون إذنك.
                </p>
            </div>

            <!-- Card 6: Sharing with Third Parties -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">6. عدم بيع أو مشاركة البيانات</h2>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed" style="font-family: 'Tajawal', sans-serif;">
                    نحن لا نبيع، ولا نؤجر، ولا نتاجر ببياناتك الشخصية لأي طرف ثالث نهائيًا. قد نشارك البيانات فقط إذا تطلب ذلك تطبيق القانون أو بطلب رسمي من الجهات المختصة وفق التشريعات النافذة.
                </p>
            </div>

            <!-- Card 7: User Rights & Contact -->
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1797B8]/10 text-[#1797B8] flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#0F2042]">7. حقوقك والتواصل معنا</h2>
                </div>
                <div class="text-slate-600 text-sm leading-relaxed space-y-3" style="font-family: 'Tajawal', sans-serif;">
                    <p>يحق لك في أي وقت التواصل معنا لطلب تعديل أو تحديث أو حذف بياناتك الشخصية المخزنة لدينا.</p>
                    <div class="bg-[#f0f4f8] rounded-xl p-4 border border-slate-200 space-y-2 text-slate-800 text-xs">
                        <div class="font-bold text-[#0F2042] text-sm mb-1">مركز YTY للأعمال — Yemen Tech Youth</div>
                        <div><strong>العنوان:</strong> صنعاء، شارع بغداد - خلف مستشفى المتوكل</div>
                        <div><strong>رقم التواصل / الواتساب:</strong> <a href="tel:+967775076672" class="text-[#1797B8] hover:underline" dir="ltr">+967 775 076 672</a></div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F2042] text-[#b8d0e8] py-8 border-t border-slate-700/50">
        <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <p style="font-family: 'Tajawal', sans-serif;">
                © {{ date('Y') }} YTY — Yemen Tech Youth. جميع الحقوق محفوظة.
            </p>
            <div style="font-family: 'Tajawal', sans-serif;" class="flex gap-4">
                <a href="{{ route('home') }}" class="hover:text-[#1797B8] transition-colors">الرئيسية</a>
                <a href="{{ route('privacy') }}" class="text-[#1797B8] font-semibold">سياسة الخصوصية</a>
            </div>
        </div>
    </footer>
</div>
@endsection
