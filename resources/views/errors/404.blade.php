@extends('errors.base')

@section('code', '404')
@section('title', 'صفحه پیدا نشد!!!')
@section('message', 'صفحه‌ای که دنبالش بودید وجود ندارد یا آدرس آن تغییر کرده است. ممکن است آدرس را اشتباه وارد کرده باشید یا محصول حذف شده باشد.')


@section('art')
    <svg class="art" viewBox="0 0 120 120" aria-hidden="true">
        <rect class="slot" x="14" y="50" width="56" height="56" rx="8"/>
        <g class="a-float">
            <rect class="piece" x="62" y="14" width="40" height="40" rx="6"/>
            <circle class="piece" cx="82" cy="14" r="9"/>
            <circle class="piece" cx="102" cy="34" r="9"/>
            <circle class="notch" cx="62" cy="34" r="9"/>
        </g>
    </svg>
@endsection
