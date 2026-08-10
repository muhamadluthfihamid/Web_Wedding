@extends('errors.layout')

@section('title', '500 - Kesalahan Server')
@section('code', '500')
@section('icon-bg', 'bg-purple-50 text-purple-500 border border-purple-100')
@section('code-bg', 'bg-purple-100 text-purple-800')

@section('icon')
    <i class="fas fa-server text-3xl"></i>
@endsection

@section('header', 'Kesalahan Internal Server')

@section('message')
    Terjadi masalah teknis pada server kami saat memproses permintaan Anda. Tim kami telah diberitahu dan sedang memperbaikinya.
@endsection
