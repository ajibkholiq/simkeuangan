@extends('layout.master')

@section('main')
    {{-- membuat landing page selamat datang --}}
    <style>
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: auto;
        }

        .content .text h2 {

            width: 100%;
            font-weight: 700;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            font-family: inter;
            font-size: 32px;
            color: #1AB394;
        }

        .content .text p {
            width: 85%;

        }

        .content .text h4 {
            color: #000;
            /* font-family:inter; */
            /* font-style: normal;
            font-weight: 400;
            line-height: normal; */
        }
    </style>

    <div class="content">
        <div class="text">
            <h2 style="text-transform: capitalize ">Selamat Datang {{ session('nama') }}</h2>
            <h4>Menemukan Solusi Keuangan Yang Andal Dan Efektif</h4>
            <p>Apakah anda mencari cara untuk mengelola keuangan anda lebih cerdas ?
                Atau mungkin anda ingin berivestasi untuk masa depan yang lebih stabil dan sejahtera ?
            </p>

        </div>
        <div class="image">
            <img alt="image" class=""style="height: 300px; margin-right: 100px; margin-top:50px "
                src="{{ URL::asset('assets/img/line-graph.png') }}" />
        </div>
    @endsection
