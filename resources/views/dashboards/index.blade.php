@extends('layouts.template')
@section('sub-judul', 'DASHBOARD | E-Learning SKPK')
@section('panel-heading')
      <div class="panel-heading">
            <div class="row">
                  <div class="col-md-6">
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
                  <div class="col-md-6">
                        <h5 class="panel-title float-right mb-auto">{{ date('Y-m-d') }}</h5>
                  </div>
            </div>
      </div>
@stop
@section('content')
      <div class="row">
            <div class="col-md-12">
                  <div class="col-sm-12 bg-info">
                        <div class="card">
                              <div class="card-body">
                                    <div class="mb-2">
                                          <h1 class="text-center">SELAMAT DATANG, 
                                                @if (Auth::user()->level == 'guru')
                                                      @if (Auth::user()->guru['jk'] == 'Perempuan')
                                                            Miss 
                                                      @else 
                                                            Mr. 
                                                      @endif 
                                                      {{ Auth::user()->name }} !
                                                @else
                                                      {{ Auth::user()->name }} !
                                                @endif
                                                
                                          </h1>
                                          <h3 class="text-center" style="margin-top: -5px;">di E-LEARNING</h3>
                                          <h3 class="text-center" style="margin-top: -5px;">SEKOLAH KRISTEN PELITA KASIH LAWANG</h3>
                                          <h3 class="text-center" style="margin-top: -5px;">TAHUN AJARAN 2021/2022</h3>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <br>
      <div class="row">
            @include('layouts.includes.dashboard')
      </div>
      <div class="row">
            <div class="col-md-12">
                  <!-- PANEL HEADLINE -->
                  <h3>PENGUMUMAN</h3>
                  @forelse ($pengumuman as $umum)
                        <div class="panel panel-headline shadow p-3 mb-5 bg-white rounded">
                              <div class="panel-heading bg-primary">
                                    <h3 class="panel-title">{{ $umum->judul }}</h3>
                                    <p class="panel-subtitle" style="color: white">{{ $umum->created_at }} | {{ $umum->kepsek }}</p>
                              </div>
                              <div class="panel-body bg-snowwhite" style="background-color: whitesmoke">
                                    {!! $umum->isi_pengumuman !!}
                              </div>
                        </div>
                  @empty
                        <div class="card">
                              <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                          Tidak Ada Pengumuman ... !!!
                                    </div>
                              </div>
                        </div>
                  @endforelse
                  
                  <!-- END PANEL HEADLINE -->
            </div>
      </div>
@endsection