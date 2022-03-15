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
            <div class="col-md-12">
                  <div class="card">
                        <div class="card-title bg-success">
                              <h2>{{ $materi->judul_materi }}</h2>
                              <h5>{{ $materi->updated_at }} | {{ Auth::user()->name }}</h5>
                        </div>
                        <div class="card-body">
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
