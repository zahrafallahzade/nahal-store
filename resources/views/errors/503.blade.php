@extends('errors.base')

@section('code', '503')
@section('title', 'سایت در دست تعمیر است.')
@section('message', 'در حال به‌روزرسانی سایت هستیم و به‌زودی برمی‌گردیم. از صبر شما متشکریم.')


@section('art')
    <svg class="art a-spin" viewBox="0 0 120 120" aria-hidden="true">
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(45 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(90 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(135 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(180 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(225 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(270 60 60)"/>
        <rect class="piece" x="54" y="14" width="12" height="20" rx="3" transform="rotate(315 60 60)"/>
        <circle class="piece" cx="60" cy="60" r="32"/>
        <circle class="notch" cx="60" cy="60" r="13"/>
    </svg>
@endsection
