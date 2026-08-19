@extends('errors.layout')

@section('title', '503 - Pemeliharaan Sistem')
@section('code', '503')
@section('icon-bg', 'bg-indigo-50 text-indigo-500 border border-indigo-100')
@section('code-bg', 'bg-indigo-100 text-indigo-800')

@section('icon')
    <i class="fas fa-tools text-3xl"></i>
@endsection

@section('header', 'Sistem Sedang Pemeliharaan')

@section('message')
    Layanan {{ $store_name ?? config('app.name', "Lu'iz-Wedding") }} saat ini sedang dalam pemeliharaan rutin untuk meningkatkan kualitas sistem. Silakan kembali beberapa saat lagi.
@endsection
