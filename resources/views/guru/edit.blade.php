@extends('layouts.template')
@section('sub-judul', 'Ubah Data Guru | E-Learning SKPK')
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
                        <div class="card-body">
                            <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                    @method('PATCH')
                                    {{csrf_field()}}
                                    @if (Auth::user()->level == 'guru')
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
                                                    <input type="password" class="form-control" name="password" value="password" readonly>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block"></span>
                                                    @endif
                                                    <h6 style="margin-left: 20px; font-style: italic; color:rgb(31, 31, 31);">* Silahkan buat passwordnya !</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
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
                                    </div>

                                    <div class="row">
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
                                                <!-- End Combo Box -->
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
                                    </div>

                                    <div class="row">
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

                                    <!--Edit Avatar-->
                                    <div class="form-group">
                                          <label for="exampleFormControlTextarea1">Foto Profil</label>
                                          <input type="file" name="foto_profil" class="form-control">
                                    </div>

                                    <div class="modal-footer">
                                          <a href="{{ url()->previous() }}" class="btn btn-default" style="color: black">Cancel</a>
                                          <button type="submit" class="btn btn-warning">Ubah</button>
                                    </div>
                            </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection
