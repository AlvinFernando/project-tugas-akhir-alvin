@extends('layouts.template')
@section('sub-judul', 'Tugas Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
        </a>
    </div>
@stop
@section('content')

    <style>
        /* .bio{
            margin-top: 10px;
        }

        .float-center{
            margin-left: 45%;
        } */

        .img-circle {
            border:2px solid #fff;
            background: url(img/duck.png) no-repeat;
            -moz-box-shadow: 0px 6px 5px #ccc;
            -webkit-box-shadow: 0px 6px 5px #ccc;
            box-shadow: 0px 6px 5px #ccc;
            -moz-border-radius:190px;
            -webkit-border-radius:190px;
            border-radius:190px;
        }

/*
        .icon-profil{
            margin-left: -50px;
        } */
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-headline rounded">
                <div class="panel-heading bg-primary">
                    <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $tugas_siswa->judul }}</h1>
                    <h4 class="text-light" style="margin-left:10px; ">
                        {{ $tugas_siswa->updated_at->format('d-m-Y') }} | {{ Auth::user()->name }}
                    </h4>
                </div>
                <div class="panel-body" style="margin-left:10px;">
                    <h2>{!! $tugas_siswa->isi_tugas !!}</h2>
                    @foreach ($tugas_siswa->files as $file)
                        <p>
                            Lampiran : <a href="{{ asset('storage/'.$file->url) }}">  {{ $file->file }}</a>
                        </p>
                    @endforeach
                    <h2>Batas Waktu Pengumpulan Tugas : {{ $tugas_siswa->end_date }}</h2>
                    <h3>Siswa Yang Sudah Mengumpulkan Tugas : </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                                @foreach ($kumpul_tugas_siswas as $result => $f)
                                    @if ($f->tugas_siswas_id == $tugas_siswa->id)
                                        <div class="row">
                                            <div class="col-md-12" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(49, 49, 49, 0.19); margin-top: 20px;">
                                                <div class="col-sm-2">
                                                    <img src="{{ $f->users->siswa->getProfile() }}" alt="Avatar"
                                                    class="img-circle pull-left avatar"
                                                    style="margin-top: 20px;
                                                            margin-left: 10px;
                                                            width:70px; height: 70px;">
                                                </div>
                                                <div class="col-sm-8" style="margin-top: -5px;">
                                                    <h3>
                                                        {{ $f->users->name }} - {{ $f->users->siswa->kelas['nama_kelas'] }}
                                                    </h3>
                                                    <h3 style="margin-top: 5px; ">Nama Tugas : {{ $f->nama_tugas }}</h3>
                                                    {{-- @foreach ($f->files as $file)
                                                        <p>
                                                            <a href="{{ asset('storage/'.$file->url) }}">  {{ $file->file }}</a>
                                                        </p>
                                                    @endforeach --}}
                                                    <h5>Mengumpulkan Tugas Pada Tanggal {{ $f->created_at }}</h5>
                                                </div>
                                                <div class="col-sm-2" style="margin-top: 40px; margin-left: auto;">
                                                    <a href="{{ route('lihat_tugas_siswa', $f->id) }}" class="btn btn-info" style="width: 100px;">
                                                        <i class="fas fa-eye fa-md" aria-hidden="true" style="margin-left: -8px;"></i>
                                                        LIHAT
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
