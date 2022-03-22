@extends('layouts.template')
@section('sub-judul', 'Materi | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('sub-judul')</h3>
            <a href="/dashboards" class="back-hover">
                <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
            </a>
        </div>
    </div>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-headline rounded">
                <div class="panel-heading bg-primary">
                    <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $materi->judul_materi }}</h1>
                    <h4 class="text-light" style="margin-left:10px; ">
                        {{ $materi->updated_at->format('d-m-Y') }} | {{ Auth::user()->name }}
                    </h4>
                </div>
                <div class="panel-body" style="margin-left:10px;">
                    <h2>{!! $materi->isi_materi !!}</h2>
                    @foreach ($materi->files as $file)
                        <p>
                            <a href="{{ asset('storage/'.$file->url) }}">  {{ $file->file }}</a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
