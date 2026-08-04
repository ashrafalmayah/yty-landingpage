@extends('layouts.app')

@section('content')
<div dir="rtl" style="font-family: 'Cairo', 'Tajawal', sans-serif; background-color: #f0f4f8;" class="min-h-screen">

    <!-- ─── HEADER ─── -->
    <header style="background-color: #0F2042;" class="sticky top-0 z-50 shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
            <img
                src="{{ asset('images/yty_logo.jpg') }}"
                alt="شعار YTY"
                class="h-12 w-auto object-contain rounded"
            />
            <a
                href="#booking-form"
                style="background-color: #1797B8; color: #fff;"
                class="px-5 py-2.5 rounded-lg transition-opacity hover:opacity-90 text-sm font-semibold"
            >
                احجز مكتبك
            </a>
        </div>
    </header>

    <!-- ─── HERO ─── -->
    <section
        style="background: linear-gradient(135deg, #0F2042 0%, #163060 60%, #0d3a55 100%);"
        class="relative overflow-hidden"
    >
        <!-- Geometric decoration -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div style="background-color: #1797B8; opacity: 0.06;" class="absolute -top-32 -left-32 w-96 h-96 rounded-full"></div>
            <div style="background-color: #1797B8; opacity: 0.04;" class="absolute top-20 left-40 w-64 h-64 rounded-full"></div>
            <div style="background-color: #1797B8; opacity: 0.08;" class="absolute -bottom-20 -right-20 w-80 h-80 rounded-full"></div>
            <svg class="absolute top-0 left-0 w-full h-full opacity-5" viewBox="0 0 800 600" preserveAspectRatio="xMidYMid slice">
                <line x1="0" y1="0" x2="800" y2="600" stroke="#1797B8" stroke-width="1" />
                <line x1="200" y1="0" x2="800" y2="400" stroke="#1797B8" stroke-width="1" />
                <line x1="0" y1="200" x2="600" y2="600" stroke="#1797B8" stroke-width="1" />
            </svg>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Text side -->
            <div class="text-white space-y-6 lg:pt-6">
                <div
                    style="background-color: rgba(23,151,184,0.18); border: 1px solid rgba(23,151,184,0.4); color: #1797B8;"
                    class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold"
                >
                    مساحة عمل احترافية في قلب العاصمة
                </div>
                <h1 style="line-height: 1.35;" class="text-white">
                    <span class="block text-3xl md:text-5xl font-extrabold">
                        احجز مساحة عملك المكتبية
                    </span>
                    <span class="block text-3xl md:text-5xl font-extrabold" style="color: #1797B8;">
                        في حاضنة YTY
                    </span>
                </h1>
                <p style="color: #b8d0e8; font-size: 1.05rem; line-height: 1.85; font-family: 'Tajawal', sans-serif;" class="font-normal">
                    بيئة عمل هادئة وعصرية مجهزة بأحدث التقنيات — مكاتب خاصة ومشتركة، إنترنت فائق السرعة، وقاعات اجتماعات احترافية. كل ما تحتاجه للتركيز والإنجاز في مكان واحد.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    @foreach (['إنترنت سريع', 'استراحة مجهزة', 'قاعة اجتماعات', 'خدمات مكتملة'] as $feature)
                        <div class="flex items-center gap-2" style="color: #b8d0e8; font-size: 0.9rem;">
                            <div style="background-color: #1797B8; width: 7px; height: 7px; border-radius: 50%;"></div>
                            <span>{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Office photo -->
                <div class="rounded-2xl overflow-hidden shadow-lg mt-4 h-44">
                    <img
                        src="/images/main-photo.jpg"
                        alt="مساحة العمل في YTY"
                        class="w-full h-full object-cover"
                        style="filter: brightness(0.85) saturate(0.9);"
                    />
                </div>
            </div>

            <!-- Lead Form -->
            <div id="booking-form" style="background-color: rgba(255,255,255,0.97);" class="rounded-2xl shadow-2xl p-7 scroll-mt-20">
                @if(session('success_name'))
                    <div class="text-center py-10 space-y-4">
                        <div style="background-color: rgba(23,151,184,0.15);" class="rounded-full w-18 h-18 flex items-center justify-center mx-auto">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none">
                                <circle cx="24" cy="24" r="20" fill="#1797B8" opacity="0.2" />
                                <path d="M14 24l7 7 13-13" stroke="#1797B8" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 style="color: #0F2042;" class="text-xl font-bold">تم إرسال طلبك بنجاح!</h3>
                        <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-sm leading-relaxed">
                            شكراً {{ session('success_name') }}، سيتواصل معك فريق YTY خلال أقرب وقت ممكن عبر الاتصال أو الواتساب.
                        </p>
                        <a href="{{ route('home') }}" class="inline-block mt-4 text-xs font-semibold px-4 py-2 rounded-lg text-white" style="background-color: #1797B8;">
                            إرسال طلب آخر
                        </a>
                    </div>
                @else
                    <h2 style="color: #0F2042;" class="text-xl font-bold mb-1">
                        احجز مكتبك الآن
                    </h2>
                    <p style="color: #0F2042; font-family: 'Tajawal', sans-serif;" class="text-sm mb-5">
                        تواصل معنا وسيقوم فريقنا بالرد خلال ساعات العمل
                    </p>

                    @php
                        $otherErrors = collect($errors->getMessages())->except(['name', 'email', 'phone'])->flatten();
                    @endphp
                    @if ($otherErrors->isNotEmpty())
                        <div class="mb-4 p-3 rounded-lg text-xs bg-red-50 text-red-600 border border-red-200">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($otherErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label style="color: #0F2042;" class="block text-sm font-semibold mb-1">
                                الاسم الكامل *
                            </label>
                            <input
                                required
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="أدخل اسمك الكامل"
                                style="font-family: 'Tajawal', sans-serif;"
                                class="w-full border @error('name') border-red-500 bg-red-50/50 @else border-slate-200 bg-slate-50 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                            />
                            @error('name')
                                <p class="text-xs text-red-600 mt-1 font-semibold" style="font-family: 'Tajawal', sans-serif;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label style="color: #0F2042;" class="block text-sm font-semibold mb-1">
                                البريد الإلكتروني *
                            </label>
                            <input
                                required
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="example@email.com"
                                style="font-family: 'Tajawal', sans-serif; direction: ltr; text-align: right;"
                                class="w-full border @error('email') border-red-500 bg-red-50/50 @else border-slate-200 bg-slate-50 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                            />
                            @error('email')
                                <p class="text-xs text-red-600 mt-1 font-semibold" style="font-family: 'Tajawal', sans-serif;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label style="color: #0F2042;" class="block text-sm font-semibold mb-1">
                                رقم الهاتف / الواتساب *
                            </label>
                            <input
                                required
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="ادخل رقم الهاتف"
                                style="font-family: 'Tajawal', sans-serif; direction: ltr; text-align: right;"
                                class="w-full border @error('phone') border-red-500 bg-red-50/50 @else border-slate-200 bg-slate-50 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                            />
                            @error('phone')
                                <p class="text-xs text-red-600 mt-1 font-semibold" style="font-family: 'Tajawal', sans-serif;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label style="color: #0F2042;" class="block text-sm font-semibold mb-1">
                                الملاحظات / نوع المساحة المطلوبة
                            </label>
                            <textarea
                                rows="3"
                                name="notes"
                                placeholder="مثال: أبحث عن مكتب خاص بدوام كامل، أو مقعد مشترك..."
                                style="font-family: 'Tajawal', sans-serif;"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 bg-slate-50 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors resize-y"
                            >{{ old('notes') }}</textarea>
                        </div>

                        <button
                            type="submit"
                            style="background-color: #1797B8;"
                            class="w-full text-white font-bold py-3.5 px-4 rounded-xl text-base transition-opacity hover:opacity-90 cursor-pointer shadow-md"
                        >
                            احجز مكتبك الآن ←
                        </button>
                        <p style="color: #0F2042; font-family: 'Tajawal', sans-serif;" class="text-xs text-center">
                            تتوفر مساحات محدودة. احجز مكانك اليوم لتضمن حصولك على المكتب المناسب.
                        </p>
                    </form>
                @endif
            </div>
        </div>
    </section>

    <!-- ─── SERVICES ─── -->
    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 space-y-3">
                <div style="color: #1797B8;" class="text-sm font-semibold tracking-wider">خدماتنا</div>
                <h2 style="color: #0F2042;" class="text-2xl md:text-3xl font-extrabold leading-snug">
                    كل ما تحتاجه لبيئة عمل احترافية
                </h2>
                <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="max-w-lg mx-auto text-sm leading-relaxed">
                    صُممت مساحات YTY لتمنحك بيئة العمل المثالية — هادئة، مجهزة، وجاهزة من اليوم الأول.
                </p>
                <div style="background-color: #1797B8;" class="w-12 h-1 mx-auto mt-2 rounded"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#1797B8] hover:shadow-xl group">
                    <div style="background-color: rgba(23,151,184,0.12);" class="w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        <svg viewBox="0 0 48 48" fill="none" class="w-10 h-10" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="12" width="36" height="26" rx="3" stroke="#1797B8" stroke-width="2.5" />
                            <rect x="14" y="20" width="10" height="10" rx="1.5" fill="#1797B8" opacity="0.2" stroke="#1797B8" stroke-width="2" />
                            <rect x="28" y="20" width="10" height="10" rx="1.5" fill="#1797B8" opacity="0.2" stroke="#1797B8" stroke-width="2" />
                            <path d="M16 38v4M32 38v4" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M10 42h28" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 style="color: #0F2042;" class="text-base font-bold mb-2">مكاتب خاصة ومشتركة</h3>
                    <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed">
                        اختر بين مكتب خاص بالكامل أو مقعد مشترك في بيئة منفتحة – بمرونة تناسب احتياجاتك اليومية والشهرية.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#1797B8] hover:shadow-xl group">
                    <div style="background-color: rgba(23,151,184,0.12);" class="w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        <svg viewBox="0 0 48 48" fill="none" class="w-10 h-10" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="24" cy="24" r="16" stroke="#1797B8" stroke-width="2.5" />
                            <path d="M12 24c0-6.627 5.373-12 12-12" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M16 24c0-4.418 3.582-8 8-8" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <circle cx="24" cy="24" r="3" fill="#1797B8" />
                            <path d="M24 10v4M24 34v4M10 24h4M34 24h4" stroke="#1797B8" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 style="color: #0F2042;" class="text-base font-bold mb-2">إنترنت فائق السرعة</h3>
                    <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed">
                        اتصال عالي السرعة – لا انقطاعات، ولا تأخير في مواعيدك المهنية.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#1797B8] hover:shadow-xl group">
                    <div style="background-color: rgba(23,151,184,0.12);" class="w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        <svg viewBox="0 0 48 48" fill="none" class="w-10 h-10" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="36" height="28" rx="3" stroke="#1797B8" stroke-width="2.5" />
                            <path d="M14 20h20M14 26h14" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <circle cx="36" cy="26" r="3" fill="#1797B8" opacity="0.3" stroke="#1797B8" stroke-width="2" />
                            <path d="M16 38v4M32 38v4" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <path d="M10 42h28" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 style="color: #0F2042;" class="text-base font-bold mb-2">قاعات اجتماعات مجهزة</h3>
                    <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed">
                        صالة اجتماعات مجهزة بشاشات عرض – مجانية للمشتركين.
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#1797B8] hover:shadow-xl group">
                    <div style="background-color: rgba(23,151,184,0.12);" class="w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        <svg viewBox="0 0 48 48" fill="none" class="w-10 h-10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 36h32" stroke="#1797B8" stroke-width="2.5" stroke-linecap="round" />
                            <rect x="12" y="14" width="10" height="22" rx="2" fill="#1797B8" opacity="0.15" stroke="#1797B8" stroke-width="2" />
                            <rect x="26" y="20" width="10" height="16" rx="2" fill="#1797B8" opacity="0.15" stroke="#1797B8" stroke-width="2" />
                            <path d="M14 10c0-1.105.895-2 2-2h6c1.105 0 2 .895 2 2" stroke="#1797B8" stroke-width="2" stroke-linecap="round" />
                            <circle cx="38" cy="12" r="4" fill="#1797B8" opacity="0.25" stroke="#1797B8" stroke-width="2" />
                            <path d="M38 10v2l1.5 1.5" stroke="#1797B8" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 style="color: #0F2042;" class="text-base font-bold mb-2">خدمات ومرافق مكملة</h3>
                    <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed">
                        استراحة مجهزة بركن ضيافة، وطابعات وماسحات – كل شيء في مكان واحد.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── TESTIMONIALS ─── -->
    <section class="py-20" style="background-color: #f0f4f8;">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 space-y-3">
                <div style="color: #1797B8;" class="text-sm font-semibold tracking-wider">آراء عملائنا</div>
                <h2 style="color: #0F2042;" class="text-2xl md:text-3xl font-extrabold leading-snug">
                    ماذا يقول رواد الأعمال عن بيئة العمل لدينا؟
                </h2>
                <div style="background-color: #1797B8;" class="w-12 h-1 mx-auto mt-2 rounded"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $testimonials = [
                        [
                            'name' => 'أيمن',
                            'title' => 'مؤسس VarShop',
                            'photo' => '/images/people/aiman.webp',
                            'quote' => 'كنت أعمل 5 إعلانات بصعوبة، واليوم 80 إعلان بكل متعة. مبيعاتي قفزت من 10 آلاف إلى 4 ملايين. البيئة المناسبة والرواد الطموحون بجانبي صنعوا الفرق.',
                        ],
                        [
                            'name' => 'أسماء',
                            'title' => 'كاتبة محتوى',
                            'photo' => '/images/female-avatar.svg',
                            'quote' => 'بيئة عمل مريحة وخدمات متكاملة ساعدتني على التركيز في عملي. أنصح بالمركز لكل رائد أعمال.',
                        ],
                        [
                            'name' => 'حنان',
                            'title' => 'خدمات لوجستية',
                            'photo' => '/images/female-avatar.svg',
                            'quote' => 'المكاتب مجهزة بشكل ممتاز، وفريق العمل متعاون واحترافي. تجربة رائعة بكل المقاييس.',
                        ],
                        [
                            'name' => 'هديل',
                            'title' => 'IT',
                            'photo' => '/images/female-avatar.svg',
                            'quote' => 'مكان هادئ ومنظم، مناسب للاجتماعات والعمل اليومي. سعيدة باختياري لـ YTY.',
                        ],
                        [
                            'name' => 'وسيم',
                            'title' => 'مؤسس Done',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'وفرت عليّ الكثير من الوقت والجهد، وكل الخدمات التي أحتاجها متوفرة في مكان واحد.',
                        ],
                        [
                            'name' => 'باسل',
                            'title' => 'Freelancer',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'أفضل ما يميز المركز هو جاهزية المكاتب وجودة بيئة العمل، مما ساعدني على بدء عملي بسرعة.',
                        ],
                        [
                            'name' => 'رامي',
                            'title' => 'مصمم',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'قاعات الاجتماعات مجهزة بشكل احترافي، وكانت تجربة ممتازة في استقبال العملاء.',
                        ],
                        [
                            'name' => 'حسام',
                            'title' => 'مؤسس ماركتيرلك للتسويق',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'بيئة احترافية وأسعار مناسبة، مع اهتمام واضح براحة العملاء وجودة الخدمات.',
                        ],
                        [
                            'name' => 'معتصم',
                            'title' => 'علاقات عامة وتسويق',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'مركز متكامل يوفر كل ما يحتاجه أصحاب المشاريع، وأنصح به لكل من يبحث عن بيئة عمل مناسبة.',
                        ],
                        [
                            'name' => 'خلود',
                            'title' => 'كاتبه محتوى',
                            'photo' => '/images/female-avatar.svg',
                            'quote' => 'أعجبني التنظيم والاهتمام بالتفاصيل، والمكان يمنح انطباعًا احترافيًا منذ أول زيارة.',
                        ],
                        [
                            'name' => 'لميس',
                            'title' => 'مهندسة ديكور',
                            'photo' => '/images/female-avatar.svg',
                            'quote' => 'تجربة مميزة من حيث جودة المرافق وسهولة التعامل، وأتطلع للاستمرار مع YTY.',
                        ],
                        [
                            'name' => 'يوسف',
                            'title' => 'مؤسس يوزرسيف للسفريات',
                            'photo' => '/images/male-avatar.svg',
                            'quote' => 'قبل YTY كنت أقضي وقت كبير في تجهيز مكان العمل ومتابعة التفاصيل التشغيلية، أما اليوم انا مركز بشكل أكبر على تطوير خدماتي وخدمة عملائي... المكتب ساعدني على بناء ثقة أكبر مع العملاء وتحسين صورة مشروعي',
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $t)
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-lg transition-shadow">
                        <div class="space-y-3">
                            <div style="color: #1797B8; opacity: 0.5;" class="text-3xl font-serif leading-none">&ldquo;</div>
                            <p style="color: #334966; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed">
                                {{ $t['quote'] }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 mt-4 space-y-3">
                            <!-- Star Rating -->
                            <div class="flex gap-0.5 justify-end">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg viewBox="0 0 16 16" class="w-4 h-4" fill="#1797B8">
                                        <path d="M8 1l1.854 3.756 4.146.603-3 2.924.708 4.127L8 10.454l-3.708 1.956.708-4.127-3-2.924 4.146-.603z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $t['photo'] }}"
                                    alt="{{ $t['name'] }}"
                                    class="w-11 h-11 rounded-full object-cover border-2"
                                    style="border-color: rgba(23,151,184,0.4);"
                                />
                                <div>
                                    <div style="color: #0F2042;" class="text-sm font-bold">{{ $t['name'] }}</div>
                                    <div style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs">{{ $t['title'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ─── FOOTER ─── -->
    <footer style="background-color: #0F2042; color: #b8d0e8;" class="pt-14 pb-7">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10 border-b border-white/10">
                <!-- Brand -->
                <div class="space-y-4">
                    <img src="{{ asset('images/yty_logo.jpg') }}" alt="YTY Logo" class="h-12 w-auto object-contain rounded" />
                    <p style="color: #8aabc8; font-family: 'Tajawal', sans-serif;" class="text-xs leading-relaxed max-w-xs">
                        YTY — Yemen Tech Youth — مساحات عمل احترافية تجمع بين الراحة والإنتاجية في قلب صنعاء.
                    </p>
                    <div class="flex gap-3 pt-1">
                        @foreach ([
                            [
                                'label' => 'WhatsApp',
                                'url' => 'https://wa.me/967775076672',
                                'svg' => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16.5 13.5c-.3-.2-1.5-.7-1.7-.8-.2-.1-.4-.1-.5.1-.2.3-.6.8-.8 1-.1.1-.3.2-.6.1-1-.4-1.9-1.2-2.6-2.1-.2-.3 0-.4.1-.6l.4-.5c.1-.1.1-.3 0-.4L10 8.5c-.2-.4-.4-.4-.6-.4h-.5c-.2 0-.6.1-.8.4-.7.8-.7 2 0 3.2 1.2 2 3.1 3.8 5.3 4.6 1.4.5 2.4.4 3.1.2.5-.1 1.2-.6 1.4-1.2.2-.6.2-1.1.1-1.2-.1-.1-.3-.2-.6-.3z" fill="white" stroke="none"/>'
                            ],
                            [
                                'label' => 'Facebook',
                                'url' => 'https://www.facebook.com/yementechyouth',
                                'svg' => '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
                            ],
                            [
                                'label' => 'Instagram',
                                'url' => 'https://www.instagram.com/yty.yemen',
                                'svg' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="white" stroke-width="2"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" fill="none" stroke="white" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5" fill="white"/>'
                            ]
                        ] as $social)
                            <a
                                href="{{ $social['url'] }}"
                                onclick="if(window.trackMetaContact){ trackMetaContact('{{ $social['label'] }}', this.href); return false; }"
                                aria-label="{{ $social['label'] }}"
                                style="background-color: rgba(255,255,255,0.08);"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition-colors hover:bg-[#1797B8]"
                            >
                                <svg viewBox="0 0 24 24" class="w-4 h-4">
                                    {!! $social['svg'] !!}
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white text-base font-bold mb-4">تواصل معنا</h4>
                    <div style="font-family: 'Tajawal', sans-serif;" class="space-y-3 text-xs text-[#8aabc8]">
                        <div class="flex items-start gap-3">
                            <svg viewBox="0 0 24 24" class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1797B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>صنعاء، شارع بغداد - خلف مستشفى المتوكل، مركز YTY للأعمال</span>
                        </div>
                        <a href="tel:+967775076672" onclick="if(window.trackMetaContact){ trackMetaContact('Phone Call', this.href); }" class="flex items-start gap-3 hover:text-[#1797B8] transition-colors">
                            <svg viewBox="0 0 24 24" class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1797B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span dir="ltr">+967 775 076 672</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[#5a7090]">
                <p style="font-family: 'Tajawal', sans-serif;">
                    © {{ date('Y') }} YTY — Yemen Tech Youth. جميع الحقوق محفوظة.
                </p>
                <div style="font-family: 'Tajawal', sans-serif;" class="flex gap-4">
                    <a href="{{ route('privacy') }}" class="hover:text-[#1797B8] transition-colors">سياسة الخصوصية</a>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection
