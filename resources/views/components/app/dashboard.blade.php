@extends('components.app.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- Greetings --}}
            @auth
                <div class="row">
                    <h3>Selamat datang, {{ Auth::user()->nickname }}</h3>
                </div>
            @endauth


        </div>
    </div>
@endsection
