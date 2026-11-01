@extends('errors.base')

@section('code', '419')
@section('title', 'انگار زیادی منتظرتون موندیم!')
@section('message', 'نشست کاربری شما به پایان رسیده و ارتباط‌تون با سایت قطع شده.لطفاً صفحه رو تازه‌سازی کنید و دوباره وارد حساب خود شوید و ادامه دهید.')
@section('link', url('/login'))
@section('button', 'ورود به حساب')


@section('art')
    <svg class="art a-flip" viewBox="0 0 120 120" aria-hidden="true">
        <rect class="piece" x="28" y="12" width="64" height="8" rx="4"/>
        <rect class="piece" x="28" y="100" width="64" height="8" rx="4"/>
        <path class="stroke thin" d="M36 20 V32 L60 60 L36 88 V100 M84 20 V32 L60 60 L84 88 V100"/>
        <path class="piece" d="M42 26 H78 L60 52 Z"/>
        <path class="piece" d="M44 98 Q60 74 76 98 Z"/>
    </svg>
@endsection
