@extends('errors.layout')

@section('title', '419 - Sesi Berakhir')
@section('code', '419')
@section('icon-bg', 'bg-sky-50 text-sky-500 border border-sky-100')
@section('code-bg', 'bg-sky-100 text-sky-800')

@section('icon')
    <i class="fas fa-hourglass-end text-3xl"></i>
@endsection

@section('header', 'Sesi Halaman Berakhir')

@section('message')
    Masa berlaku sesi keamanan form Anda telah berakhir karena tidak ada aktivitas. Silakan muat ulang halaman dan coba kembali.
@endsection
