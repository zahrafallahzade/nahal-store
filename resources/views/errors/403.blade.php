@extends('errors.base')

@section('code', '403')
@section('title', 'دسترسی ممنوع!')
@section('message', 'حساب کاربری شما اجازه دیدن این بخش را ندارد. اگر فکر می‌کنید اشتباهی رخ داده است، با پشتیبان فروشگاه تماس بگیرید.')


@section('art')
    <svg class="art a-shake" viewBox="0 0 120 120" aria-hidden="true">
        <path class="stroke" d="M38 54 V40 a22 22 0 0 1 44 0 V54"/>
        <rect class="piece" x="26" y="52" width="68" height="52" rx="10"/>
        <circle class="notch" cx="60" cy="76" r="7"/>
        <rect class="notch" x="57" y="78" width="6" height="14" rx="3"/>
    </svg>
@endsection
