@extends('layouts.template')
@section('sub-judul', 'Foto Profil siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="{{ route('siswa.index') }}" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Halaman Data Siswa
        </a>
    </div>
@stop
@section('content')
      <style>
            .bio{
                  margin-top: 10px;
            }

            .float-center{
                  margin-left: 45%;
            }

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

            .icon-profil{
                  margin-left: -50px;
            }
      </style>
      <div class="row">
            <div class="col-md-12">
                  <table class="table table-striped table-hover table-sm table-bordered">
                        <div class="row">
                              <div class="col-sm-12">
                                    <div class="card">
                                          <div class="card-header">
                                                <div class="row">
                                                      <div class="col-md-12">
                                                            <div class="col-sm-2">
                                                                  <img src="{{$siswa->getProfile()}}"
                                                                  style="margin-left: 20px; width:90px; height: 90px;"
                                                                  class="img-circle" alt="Profile">
                                                            </div>
                                                            <div class="col-sm-10">
                                                                  <div class="bio">
                                                                        <h1 style="margin-top: -8px; font-size:44px;">
                                                                              {{ $siswa->nama_siswa }}
                                                                        </h1>
                                                                        <p style="margin-top: -12px; font-size:x-large;">{!! $siswa->user['email'] !!}</p>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <hr />
                                          <div class="card-body">
                                                <div class="row">
                                                      <div class="col-md-6">
                                                            <div class="card">
                                                                  <div class="card-body">
                                                                        <div class="profile-info">
                                                                              <h4 class="heading">Profil siswa</h4>
                                                                              <ul class="list-unstyled list-justify">
                                                                                    <li>Kode siswa: <span>{{ $siswa->no_induk }}</span></li>
                                                                                    <li>Nama siswa: <span>{{ $siswa->nama_siswa }}</span></li>
                                                                                    <li>Email: <span>{!! $siswa->user['email'] !!}</span></li>
                                                                                    <li>Jenis Kelamin:
                                                                                          @if ($siswa->jk == 'Laki-Laki')
                                                                                                <span class="label label-primary">{{ $siswa->jk }}</span>
                                                                                          @else
                                                                                                <span class="label label-danger">{{ $siswa->jk }}</span>
                                                                                          @endif
                                                                                    </li>

                                                                              </ul>
                                                                        </div>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                      <div class="col-md-6">
                                                            <div class="card">
                                                                  <div class="card-body">
                                                                      <div style="margin-top: 100px;">
                                                                        <ul class="list-unstyled list-justify">
                                                                              <li>Agama <span>{{ $siswa->agama }}</span></li>
                                                                            <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                                                                            <li>No. Telp <span>{{ $siswa->no_telp }}</span></li>

                                                                        </ul>
                                                                      </div>

                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="icon-profil">
                                                <a href="{{ url()->previous() }}" class="btn btn-default btn-md float-center" style="color: black">Cancel</a>
                                                <a href="{{ route('siswa.edit_biodata_siswas', Auth::user()->id ) }}" class="btn btn-warning btn-md float-left">UBAH BIODATA</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </table>
            </div>
      </div>

@endsection
