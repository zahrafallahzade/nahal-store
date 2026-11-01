@extends('errors.base')

@section('code', '429')
@section('title', 'یکم آهسته‌تر!')
@section('message', 'در مدت کوتاه درخواست‌های زیادی ارسال کرده‌اید. لطفاً چند دقیقه صبر کنید و دوباره تلاش کنید.')


@section('art')
    <svg class="art" viewBox="0 0 120 120" aria-hidden="true">
        <g class="a-swing">
            <rect class="piece" x="10" y="52" width="48" height="48" rx="9"/>
            <circle class="notch" cx="22" cy="64" r="4.5"/>
            <circle class="notch" cx="34" cy="76" r="4.5"/>
            <circle class="notch" cx="46" cy="88" r="4.5"/>
        </g>
        <g class="a-float">
            <rect class="piece" x="66" y="24" width="44" height="44" rx="9"/>
            <circle class="notch" cx="76" cy="34" r="4"/>
            <circle class="notch" cx="100" cy="34" r="4"/>
            <circle class="notch" cx="88" cy="46" r="4"/>
            <circle class="notch" cx="76" cy="58" r="4"/>
            <circle class="notch" cx="100" cy="58" r="4"/>
        </g>
    </svg>
@endsection
