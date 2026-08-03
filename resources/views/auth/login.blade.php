@extends('layouts.app')

@section('content')
<div dir="rtl" style="background: linear-gradient(135deg, #0F2042 0%, #163060 60%, #0d3a55 100%);" class="min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8 space-y-6">
        
        <!-- Header & Logo -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/yty_logo.jpg') }}" alt="شعار YTY" class="h-14 w-auto mx-auto object-contain rounded" />
            </a>
            <h1 style="color: #0F2042;" class="text-2xl font-extrabold">تسجيل الدخول للوحة التحكم</h1>
            <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs">
                مرحباً بك مجدداً، أدخل بياناتك للوصول إلى طلبيات ومساحات YTY
            </p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label style="color: #0F2042;" class="block text-xs font-semibold mb-1.5">
                    البريد الإلكتروني
                </label>
                <input
                    required
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@yty-incubator.com"
                    style="font-family: 'Tajawal', sans-serif; direction: ltr; text-align: right;"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-900 bg-slate-50 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                />
            </div>

            <div>
                <label style="color: #0F2042;" class="block text-xs font-semibold mb-1.5">
                    كلمة المرور
                </label>
                <input
                    required
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-900 bg-slate-50 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                />
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-slate-600 cursor-pointer" style="font-family: 'Tajawal', sans-serif;">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#1797B8] focus:ring-[#1797B8]">
                    <span>تذكرني على هذا الجهاز</span>
                </label>
            </div>

            <button
                type="submit"
                style="background-color: #1797B8;"
                class="w-full text-white font-bold py-3.5 rounded-xl text-sm hover:opacity-90 transition-opacity cursor-pointer shadow-md"
            >
                تسجيل الدخول ←
            </button>

            <div class="text-center pt-2">
                <a href="{{ route('home') }}" style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs hover:text-[#1797B8] transition-colors">
                    ← العودة إلى الصفحة الرئيسية
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
