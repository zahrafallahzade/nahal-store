@extends('errors.base')

@section('code', '500')
@section('title', 'اوه! یه جای کار میلنگه.')
@section('message', 'هنگام پردازش درخواست شما خطایی پیش اومده. مشکل رو بررسی می‌کنیم؛ لطفاً کمی بعد دوباره تلاش کنید.')


@section('art')
    <svg class="art a-swing" viewBox="0 0 120 120" aria-hidden="true">
        <rect class="piece" x="25" y="35" width="70" height="70" rx="8"/>
        <circle class="piece" cx="60" cy="35" r="14"/>
        <circle class="piece" cx="95" cy="70" r="14"/>
        <circle class="notch" cx="25" cy="70" r="14"/>
        <path class="crack" d="M58 24 L52 50 L66 64 L54 88 L62 106"/>
    </svg>
@endsection
