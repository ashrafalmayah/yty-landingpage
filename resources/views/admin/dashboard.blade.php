@extends('layouts.app')

@section('content')
<div dir="rtl" style="font-family: 'Cairo', 'Tajawal', sans-serif;" class="min-h-screen bg-slate-100 text-slate-800">

    <!-- ─── TOP NAVBAR ─── -->
    <header style="background-color: #0F2042;" class="sticky top-0 z-50 shadow-md text-white">
        <div class="max-w-7xl mx-auto px-6 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/yty_logo.jpg') }}" alt="YTY Logo" class="h-10 w-auto object-contain rounded" />
                </a>
                <div class="h-6 w-px bg-white/20"></div>
                <span class="font-bold text-base text-white">لوحة تحكم طلبات YTY</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 text-xs text-slate-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>{{ Auth::user()->name }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600/80 hover:bg-red-600 text-white text-xs font-semibold transition-colors cursor-pointer"
                    >
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- ─── MAIN CONTENT ─── -->
    <main class="max-w-7xl mx-auto px-6 py-8 space-y-8">

        <!-- Flash Alert -->
        @if (session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <div style="font-family: 'Tajawal', sans-serif;" class="text-xs text-slate-500 font-medium">إجمالي الطلبات</div>
                    <div style="color: #0F2042;" class="text-3xl font-extrabold mt-1">{{ $stats['total'] }}</div>
                </div>
                <div style="background-color: rgba(15,32,66,0.08);" class="w-12 h-12 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" style="color: #0F2042;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-2xl p-5 border border-amber-100 shadow-sm flex items-center justify-between">
                <div>
                    <div style="font-family: 'Tajawal', sans-serif;" class="text-xs text-amber-600 font-medium">طلبات جديدة</div>
                    <div class="text-3xl font-extrabold mt-1 text-amber-600">{{ $stats['pending'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Contacted -->
            <div class="bg-white rounded-2xl p-5 border border-sky-100 shadow-sm flex items-center justify-between">
                <div>
                    <div style="font-family: 'Tajawal', sans-serif;" class="text-xs text-[#1797B8] font-medium">تم التواصل</div>
                    <div style="color: #1797B8;" class="text-3xl font-extrabold mt-1">{{ $stats['contacted'] }}</div>
                </div>
                <div style="background-color: rgba(23,151,184,0.1);" class="w-12 h-12 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" style="color: #1797B8;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-white rounded-2xl p-5 border border-emerald-100 shadow-sm flex items-center justify-between">
                <div>
                    <div style="font-family: 'Tajawal', sans-serif;" class="text-xs text-emerald-600 font-medium">طلبات مكتملة</div>
                    <div class="text-3xl font-extrabold mt-1 text-emerald-600">{{ $stats['completed'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filters & Search Bar -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                <!-- Search Input -->
                <div class="sm:col-span-2 relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="ابحث باسم العميل، الهاتف، البريد أو الملاحظات..."
                        style="font-family: 'Tajawal', sans-serif;"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 bg-slate-50 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                    />
                </div>

                <!-- Status Filter -->
                <div class="flex gap-2">
                    <select
                        name="status"
                        style="font-family: 'Tajawal', sans-serif;"
                        class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 bg-slate-50 focus:outline-none focus:border-[#1797B8] focus:bg-white transition-colors"
                    >
                        <option value="">جميع الحالات</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>جديد</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>تم التواصل</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>مكتمل</option>
                    </select>

                    <button
                        type="submit"
                        style="background-color: #1797B8;"
                        class="px-5 py-2.5 rounded-xl text-white font-bold text-xs hover:opacity-90 transition-opacity cursor-pointer flex-shrink-0"
                    >
                        تصفية
                    </button>
                    
                    @if(request('search') || request('status'))
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold transition-colors flex items-center justify-center"
                        >
                            إلغاء
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h2 style="color: #0F2042;" class="font-extrabold text-lg">قائمة طلبات حجز المساحات</h2>
                <span class="text-xs text-slate-500 font-semibold" style="font-family: 'Tajawal', sans-serif;">
                    عرض {{ $bookings->count() }} من أصل {{ $bookings->total() }} طلب
                </span>
            </div>

            @if ($bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-right text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-bold uppercase" style="font-family: 'Tajawal', sans-serif;">
                            <tr>
                                <th class="px-5 py-3.5">#</th>
                                <th class="px-5 py-3.5">العميل</th>
                                <th class="px-5 py-3.5">التواصل</th>
                                <th class="px-5 py-3.5">نوع المساحة / الملاحظات</th>
                                <th class="px-5 py-3.5 text-center">الحالة</th>
                                <th class="px-5 py-3.5">التاريخ</th>
                                <th class="px-5 py-3.5 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach ($bookings as $booking)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <!-- ID -->
                                    <td class="px-5 py-4 font-mono text-xs text-slate-400">#{{ $booking->id }}</td>

                                    <!-- Name -->
                                    <td class="px-5 py-4">
                                        <div style="color: #0F2042;" class="font-bold text-sm">{{ $booking->name }}</div>
                                    </td>

                                    <!-- Contact Info -->
                                    <td class="px-5 py-4 space-y-1">
                                        <div class="text-xs font-mono text-slate-600" dir="ltr" style="text-align: right;">{{ $booking->email }}</div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-mono text-slate-800 font-semibold" dir="ltr">{{ $booking->phone }}</span>
                                            @php
                                                $cleanPhone = preg_replace('/[^0-9]/', '', $booking->phone);
                                            @endphp
                                            <a
                                                href="https://wa.me/{{ $cleanPhone }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1 text-[11px] text-emerald-600 hover:text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-full"
                                                style="font-family: 'Tajawal', sans-serif;"
                                            >
                                                واتساب ↗
                                            </a>
                                        </div>
                                    </td>

                                    <!-- Notes -->
                                    <td class="px-5 py-4 max-w-xs">
                                        <p style="font-family: 'Tajawal', sans-serif;" class="text-xs text-slate-600 line-clamp-2">
                                            {{ $booking->notes ?: 'لا توجد ملاحظات إضافية' }}
                                        </p>
                                    </td>

                                    <!-- Status Badge & Form -->
                                    <td class="px-5 py-4 text-center">
                                        <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select
                                                name="status"
                                                onchange="this.form.submit()"
                                                style="font-family: 'Tajawal', sans-serif;"
                                                class="text-xs font-bold rounded-lg px-2.5 py-1.5 border-0 outline-none cursor-pointer shadow-sm transition-colors
                                                {{ $booking->status === 'pending' ? 'bg-amber-100 text-amber-800 hover:bg-amber-200' : '' }}
                                                {{ $booking->status === 'contacted' ? 'bg-sky-100 text-[#1797B8] hover:bg-sky-200' : '' }}
                                                {{ $booking->status === 'completed' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : '' }}"
                                            >
                                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>⏳ جديد</option>
                                                <option value="contacted" {{ $booking->status === 'contacted' ? 'selected' : '' }}>📞 تم التواصل</option>
                                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>✅ مكتمل</option>
                                            </select>
                                        </form>
                                    </td>

                                    <!-- Date -->
                                    <td class="px-5 py-4 whitespace-nowrap text-xs text-slate-500" style="font-family: 'Tajawal', sans-serif;">
                                        {{ $booking->created_at->format('Y-m-d') }}
                                        <span class="block text-[10px] text-slate-400">{{ $booking->created_at->format('H:i') }}</span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-5 py-4 text-center">
                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('هل أنت تأكد من رغبتك في حذف هذا الطلب؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="text-xs text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors font-semibold cursor-pointer"
                                                style="font-family: 'Tajawal', sans-serif;"
                                            >
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-slate-100">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="p-12 text-center space-y-3">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 style="color: #0F2042;" class="text-base font-bold">لا توجد طلبات حجز حالياً</h3>
                    <p style="color: #5a7090; font-family: 'Tajawal', sans-serif;" class="text-xs">
                        تظهر الطلبات المرسلة من الصفحة الرئيسية هنا بشكل تلقائي.
                    </p>
                </div>
            @endif
        </div>

    </main>

</div>
@endsection
