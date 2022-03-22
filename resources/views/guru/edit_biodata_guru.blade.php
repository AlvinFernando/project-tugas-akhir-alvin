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
                                                                  <img src="{{$guru->getProfile()}}"
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
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                                <div class="card-body">
                                                                    <form action="{{ route('guru.update_biodata_guru', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                                                        @method('PATCH')
                                                                        {{csrf_field()}}

                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <!--Edit Avatar-->
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="foto_profil">Foto Profil</label>
                                                                                        <input type="file" name="foto_profil" class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                @if (Auth::user()->level == 'guru')
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                                                                            <label for="email">Email</label>
                                                                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                                                                                            @if ($errors->has('email'))
                                                                                                <span class="help-block">{{$errors->first('email')}}</span>
                                                                                            @endif
                                                                                            <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Isi Email dengan benar !</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                                                                                            <label for="password">Password</label>
                                                                                            <input type="password" class="form-control" name="password" value="password">
                                                                                            @if ($errors->has('password'))
                                                                                                <span class="help-block"></span>
                                                                                            @endif
                                                                                            <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Silahkan buat passwordnya !</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif

                                                                                <div class="col-md-3">
                                                                                      <div class="form-group">
                                                                                            <label for="kode_guru">NIP</label>
                                                                                            <input name ="kode_guru" type="text" class="form-control" value="{{ $guru->kode_guru }}">
                                                                                      </div>
                                                                                </div>

                                                                                <div class="col-md-9">
                                                                                      <div class="form-group {{$errors->has('nama_guru') ? ' has-error' : ''}}">
                                                                                            <label for="nama_guru">Nama Guru</label>
                                                                                            <input name ="nama_guru" type="text" class="form-control"
                                                                                            value="{{ $guru->nama_guru }}">
                                                                                            @if ($errors->has('nama_guru'))
                                                                                                  <span class="help-block">{{$errors->first('nama_guru')}}</span>
                                                                                            @endif
                                                                                            <h5 style="margin-left: 20px; font-style: italic;">* Ubah Nama Guru !</h5>
                                                                                      </div>
                                                                                </div>

                                                                                {{-- Jenis Kelamin --}}
                                                                                <div class="col-md-3">
                                                                                    <!-- Combo Box -->
                                                                                    <div class="form-group {{$errors->has('jk') ? ' has-error' : ''}}">
                                                                                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                                                                        <select name ="jk" class="form-control" id="exampleFormControlSelect1">
                                                                                              <option value="0" disabled="true" selected="true">== Jenis Kelamin ==</option>
                                                                                              <option value="Laki-Laki" @if($guru->jk == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                                                              <option value="Perempuan" @if($guru->jk == 'Perempuan') selected @endif>Perempuan</option>
                                                                                        </select>
                                                                                        @if ($errors->has('jk'))
                                                                                              <span class="help-block">{{$errors->first('jk')}}</span>
                                                                                        @endif
                                                                                        <h5 style="margin-left: 20px; font-style: italic; color:darkgray;">* Pilih Jenis Kelamin !</h5>

                                                                                    </div>
                                                                                </div>

                                                                                {{-- Agama --}}
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group {{$errors->has('agama') ? ' has-error' : ''}}">
                                                                                        <label for="exampleFormControlSelect1">Agama</label>
                                                                                        <select name ="agama" class="form-control" id="exampleFormControlSelect1">
                                                                                                <option value="0" disabled="true" selected="true">== Agama ==</option>
                                                                                                <option value="Islam" @if($guru->agama == 'Islam') selected @endif>Islam</option>
                                                                                                <option value="Kristen" @if($guru->agama == 'Kristen') selected @endif>Kristen</option>
                                                                                                <option value="Katholik" @if($guru->agama == 'Katholik') selected @endif>Katholik</option>
                                                                                                <option value="Hindu" @if($guru->agama == 'Hindu') selected @endif>Hindu</option>
                                                                                                <option value="Budha" @if($guru->agama == 'Budha') selected @endif>Budha</option>
                                                                                                <option value="Kong Hu Chu" @if($guru->agama == 'Kong Hu Chu') selected @endif>Kong Hu Chu</option>
                                                                                        </select>
                                                                                        @if ($errors->has('agama'))
                                                                                                <span class="help-block">{{$errors->first('agama')}}</span>
                                                                                        @endif
                                                                                        <h5 style="margin-left: 20px; font-style: italic; color:darkgray;">* Agama wajib dipilih !</h5>
                                                                                    </div>
                                                                                </div>

                                                                                {{-- No Telp --}}
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group {{$errors->has('no_telp') ? ' has-error' : ''}}">
                                                                                        <label for="exampleInputEmail1">No Telp</label>
                                                                                        <input name ="no_telp" type="text" class="form-control" value="{{ $guru->no_telp }}">
                                                                                        @if ($errors->has('no_telp'))
                                                                                                <span class="help-block">{{$errors->first('no_telp')}}</span>
                                                                                        @endif
                                                                                        <h5 style="margin-left: 20px; font-style: italic; color:darkgray;">* Isi No Telepon dengan Benar !</h5>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Combo Box -->

                                                                                {{-- alamat --}}
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group {{$errors->has('alamat') ? ' has-error' : ''}}">
                                                                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                                                                    <textarea name ="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $guru->alamat }}</textarea>
                                                                                    @if ($errors->has('alamat'))
                                                                                          <span class="help-block">{{$errors->first('alamat')}}</span>
                                                                                    @endif
                                                                                    <h5 style="margin-left: 20px; font-style: italic; color:darkgray;">* Alamat Wajib Diisi, min. 8 karakter dan maks. 100 karakter !</h5>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="icon-profil" style="margin-left: -125px;">
                                                                                <a href="{{ url()->previous() }}" class="btn btn-default btn-md float-center" style="color: black">Cancel</a>
                                                                                <button type="submit" class="btn btn-warning btn-md float-left">SUNTING BIODATA</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                          </div>

                                    </div>
                              </div>
                        </div>
                  </table>
            </div>
      </div>

@endsection
