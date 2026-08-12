@extends('errors.layout')

@section('title', '403 - Akses Ditolak')
@section('code', '403')
@section('icon-bg', 'bg-rose-50 text-rose-500 border border-rose-100')
@section('code-bg', 'bg-rose-100 text-rose-800')

@section('icon')
    <i class="fas fa-user-shield text-3xl"></i>
@endsection

@section('header', 'Akses Ditolak')

@section('message')
    Anda tidak memiliki hak akses atau izin yang cukup untuk melihat halaman atau data ini.
@endsection
