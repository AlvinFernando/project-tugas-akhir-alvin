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
                    <div class="card">
                        <div class="card-title bg-success">
                              <h2 class="text-light">{{ $materi->judul_materi }}</h2>
                              <h5 class="text-light">{{ $materi->created_at }} | {{ Auth::user()->name }}</h5>
                        </div>
                        <div class="card-body">
                                <h2>{!! $materi->isi_materi !!}</h2>
                                @foreach ($materi->files as $file)
                                    <p>
                                        <a href="{{ 'storage/'.$file->url }}">  {{ $file->file }}</a>
                                    </p>
                                @endforeach
                                Silahkan Download Materi Diatas !!
                        </div>
                    </div>
                </div>
            </div>
      </div>

@endsection