@extends('layouts.template')
@section('sub-judul', 'Tugas Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul') -
            @if (Auth::user()->level == 'guru')
                <span class="label label-primary">Guru</span>
            @endif
            @if (Auth::user()->level == 'siswa')
                <span class="label label-danger">Siswa</span>
            @endif
            @if (Auth::user()->level == 'admin')
                <span class="label label-success">Admin</span>
            @endif
            @if (Auth::user()->level == 'kepsek')
                <span class="label label-warning">Kepala Sekolah</span>
            @endif
        </h3>
    </div>
@stop
@section('content')

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
                    <h2>Tanggal Terakhir Pengumpulan Tugas : {{ $tugas_siswa->end_date }}</h2>
                </div>
            </div>
        </div>
    </div>

@endsection
