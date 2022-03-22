@extends('layouts.template')
@section('sub-judul', 'Ubah Data Admin | E-Learning SKPK')
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
                              <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                    @method('PATCH')
                                    {{csrf_field()}}
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <label for="email">Email</label>
                                                      <input type="email" class="form-control" name="email" value="{!! $admin->user['email'] !!}" readonly>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                                                      <label for="password">Password</label>
                                                      <input type="password" class="form-control" name="password" value="{!! $admin->user['password'] !!}" readonly>
                                                      @if ($errors->has('password'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic; color:darkgray;">* Silahkan Ubah passwordnya !</h5>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-9">
                                                <div class="form-group {{$errors->has('nama_admin') ? ' has-error' : ''}}">
                                                      <label for="nama_admin">Nama admin</label>
                                                      <input name ="nama_admin" type="text" class="form-control"
                                                      value="{{ $admin->nama_admin }}">
                                                      @if ($errors->has('nama_admin'))
                                                            <span class="help-block">{{$errors->first('nama_admin')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Ubah Nama admin !</h5>
                                                </div>
                                          </div>
                                    </div>

                                    <!--Edit Avatar-->
                                    <div class="form-group">
                                          <label for="exampleFormControlTextarea1">Foto Profil</label>
                                          <input type="file" name="foto_profil" class="form-control">
                                    </div>

                                    <div class="modal-footer">
                                          <a href="{{ url()->previous() }}" class="btn btn-default" style="color: black">Cancel</a>
                                          <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection
