@extends('layouts.template')
@section('sub-judul', 'Tambah Data Guru | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
        </a>
    </div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('nama_admin') ? ' has-error' : ''}}">
                                <label for="nama_admin">Nama Admin</label>
                                <input name ="nama_admin" type="text" class="form-control"
                                id="nama_admin" aria-describedby="emailHelp" placeholder="Nama admin"
                                value="{{ old('nama_admin') }}">
                                    @if ($errors->has('nama_admin'))
                                        <span class="help-block">{{$errors->first('nama_admin')}}</span>
                                    @endif
                                <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Nama admin wajib diisi !</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{$errors->first('email')}}</span>
                                    @endif
                                <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Isi Email dengan benar !</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block"></span>
                                    @endif
                                <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Silahkan buat passwordnya !</h6>
                            </div>
                        </div>
                    </div>

                    <!--Input Avatar-->
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Foto Profil</label>
                        <input type="file" name="foto_profil" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-default" style="color: black">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
