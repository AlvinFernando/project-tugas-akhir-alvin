@extends('layouts.template')
@section('sub-judul', 'Materi | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="{{ url()->previous() }}" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Halaman Materi
        </a>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-bg-12">
            <div class="col-sm-12">
                <div class="panel panel-headline rounded">
                    <div class="panel-heading bg-success">
                        <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $materi->judul_materi }}</h1>
                        <h4 class="text-light" style="margin-left:10px; ">{{ $materi->created_at }} | {{ $materi->users->name }}</h4>
                    </div>
                    <div class="panel-body" style="margin-left:10px;">
                        <h3>{!! $materi->isi_materi !!}</h3>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="padding: 20px;">
                                        @foreach ($materi->files as $file)
                                            <p>
                                                <h4 style="color: black;">{{ $file->file }}</h4>
                                                <a href="{{ asset('storage/'.$file->url) }}" class="bg-danger right text-light"
                                                style="width: 140px; height: 30px; padding: 5px;">
                                                    <i class="fas fa-download" aria-hidden="true" style="margin-left: 18px;"></i>&nbsp;&nbsp;Download
                                                </a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
