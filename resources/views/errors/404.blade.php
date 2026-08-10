@extends('errors.layout')

@section('title', '404 - Halaman Tidak Ditemukan')
@section('code', '404')
@section('icon-bg', 'bg-amber-50 text-amber-500 border border-amber-100')
@section('code-bg', 'bg-amber-100 text-amber-800')

@section('icon')
    <i class="fas fa-search-location text-3xl"></i>
@endsection

@section('header', 'Halaman atau ID Tidak Ditemukan')

@section('message')
    Maaf, halaman yang Anda tuju tidak ditemukan atau parameter ID pada tautan telah diubah/diacak. Pastikan Anda mengakses URL yang benar.
@endsection
