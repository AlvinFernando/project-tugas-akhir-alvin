@extends('layouts.template')
@section('sub-judul', 'Materi | E-Learning SKPK')
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
        <div class="col-bg-12">
            <div class="col-sm-12">
                <div class="panel panel-headline rounded">
                    <div class="panel-heading bg-success">
                        <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $materi->judul_materi }}</h1>
                        <h4 class="text-light" style="margin-left:10px; ">{{ $materi->created_at }} | {{ $materi->users->name }}</h4>
                    </div>
                    <div class="panel-body">
                        <p>{!! $materi->isi_materi !!}</p>
                        @if (!empty($filess))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-title bg-danger" style="height:30px; padding:20px;">
                                        <h4 class="text-light" style="margin-top:-10px;">Silahkan Download Materi Di Bawah Ini !!</h4>
                                    </div>
                                    <div class="card-body" style="background-color:beige;">
                                        @foreach ($materi->files as $file)
                                            <p>
                                                <a href="{{ asset('/storage/'.$file->url) }}" style="margin-left: 20px;">
                                                    {{ $file->file }}
                                                </a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        TIdak Ada Materi
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
