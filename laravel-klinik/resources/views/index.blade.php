@extends('layouts.app')

@section('content')
    {{-- 1. Hero Banner Partial --}}
    @include('partials.hero')

    {{-- 2. Quick Queue Generator Partial --}}
    @include('partials.quick-queue')

    {{-- 3. Operational Modules Grid Partial --}}
    @include('partials.modules')

    {{-- 4. Doctor Shift Roster Partial --}}
    @include('partials.roster')

    {{-- 5. WhatsApp Simulator Modal Component --}}
    <x-wa-simulator-modal />
@endsection
