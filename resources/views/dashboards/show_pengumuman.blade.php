@extends('layouts.template')
@section('sub-judul', 'Pengumuman | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
        </a>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                <div class="panel panel-headline rounded">
                    <div class="panel-heading bg-primary">
                        <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $pengumumans->judul }}</h1>
                        <h4 class="text-light" style="margin-left:10px; ">{{ $pengumumans->created_at }} | {!! $pengumumans->users->name !!}</h4>
                    </div>
                    <div class="panel-body" style="margin-left:10px;">
                        <p class="text-lg">{!! $pengumumans->isi_pengumuman !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
