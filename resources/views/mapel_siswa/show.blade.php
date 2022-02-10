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
                    <div class="card" style="border-radius:20px">
                        <div class="card-title bg-success rounded-lg">
                              <h2 class="text-light" style="margin-left:20px;">{{ $materi->judul_materi }}</h2>
                              <h5 class="text-light" style="margin-left:20px;">{{ $materi->created_at }} | {{ $materi->users->name }}</h5>
                        </div>
                        <div class="card-body" style="margin-left:20px;">
                                <h2>{!! $materi->isi_materi !!}</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-title bg-danger" style="height:30px; padding:20px;">
                                                <h4 class="text-light" style="margin-top:-10px;">Silahkan Download Materi Di Bawah Ini !!</h4>
                                            </div>
                                            <div class="card-body" style="background-color:beige;">
                                                @foreach ($materi->files as $file)
                                                    <p>
                                                        <a href="{{ asset('/storage/'.$file->url) }}">  {{ $file->file }}</a>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>

@endsection
