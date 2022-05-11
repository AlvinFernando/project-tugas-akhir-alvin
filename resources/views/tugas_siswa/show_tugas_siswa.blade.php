@extends('layouts.template')
@section('sub-judul', 'Lihat Tugas Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="{{ url()->previous() }}" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Halaman Tugas
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

    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-headline rounded">
                    {{-- ======================================================================================  --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-headline rounded">
                                <div class="panel-heading bg-primary">
                                    <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $kumpul_tugas_siswas->users->name }}</h1>
                                    <h4 class="text-light" style="margin-left:10px; ">
                                        Kelas {{ $kumpul_tugas_siswas->users->siswa->kelas['nama_kelas'] }}
                                    </h4>
                                </div>
                                <div class="panel-body" style="margin-left:10px;">
                                    <h4>Nama Tugas :</h4><h4 style="font-weight: bold;"> {{ $kumpul_tugas_siswas->nama_tugas }}</h4>
                                    <h4>Isi :</h4>
                                    <textarea class="form-control" name="isi" id="isi" readonly>
                                        {!! $kumpul_tugas_siswas->isi !!}
                                    </textarea>

                                    <br />
                                    File Tugas Siswa :
                                    @foreach ($file3 as $f)
                                        @if ($f->kumpul_tugas_siswas_id == $kumpul_tugas_siswas->id)
                                            <p>
                                                <a href="{{ asset('storage/'.$f->url) }}">  {{ $f->file }}</a>
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
