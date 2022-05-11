@extends('layouts.template')
@section('sub-judul', 'Biodata | E-Learning SKPK')
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
                                            <img src="{{Auth::user()->guru->getProfile()}}"
                                            style="margin-left: 20px; width:90px; height: 90px;"
                                            class="img-circle" alt="Profile">
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="bio">
                                                <h1 style="margin-top: -8px; font-size:44px;">
                                                    @if ($guru->jk == 'Laki-Laki')
                                                        Mr.
                                                    @else
                                                        Miss
                                                    @endif
                                                    {{ $guru->nama_guru }}
                                                </h1>
                                                <p style="margin-top: -12px; font-size:x-large;">{!! $guru->user['email'] !!}</p>
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
                                                    <h4 class="heading">Profil Guru</h4>
                                                    <ul class="list-unstyled list-justify">
                                                        <li>Kode Guru <span>{{ $guru->kode_guru }}</span></li>
                                                        <li>Nama Guru <span>{{ $guru->nama_guru }}</span></li>
                                                        <li>Email <span>{!! $guru->user['email'] !!}</span></li>
                                                        <li>Jenis Kelamin
                                                            @if ($guru->jk == 'Laki-Laki')
                                                                <span class="label label-primary">{{ $guru->jk }}</span>
                                                            @else
                                                                <span class="label label-danger">{{ $guru->jk }}</span>
                                                            @endif
                                                        </li>
                                                        <li>Agama <span>{{ $guru->agama }}</span></li>
                                                        <li>Alamat <span>{{ $guru->alamat }}</span></li>
                                                        <li>No. Telp <span>{{ $guru->no_telp }}</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                {{-- Mata Pelajaran Yang diajar oleh Guru Pengajar --}}
                                                <div class="profile-info">
                                                    <h4 class="heading">Mata Pelajaran Yang Diajar Oleh {{ $guru->nama_guru }}</h4>
                                                    @foreach ($guru->mapel as $mapel)
                                                        <ul class="list-unstyled list-justify">
                                                            <li>{{$mapel->nama_mapel}} - {{ $mapel->kelas['nama_kelas'] }}</li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-profil" style="margin-left: -10px;">
                                <a href="{{ url()->previous() }}" class="btn btn-default btn-md float-center" style="color: black">Cancel</a>
                                <a href="{{ route('guru.edit_biodata_gurus', Auth::user()->guru->id ) }}"
                                class="btn btn-warning btn-md float-left">UBAH BIODATA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>

@endsection
