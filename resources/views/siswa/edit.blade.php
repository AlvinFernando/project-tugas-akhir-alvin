@extends('layouts.template')
@section('sub-judul', 'Ubah Data Siswa | E-Learning SKPK')
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
                              <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-4">
                                                <div class="form-group {{$errors->has('no_induk') ? ' has-error' : ''}}">
                                                    <label for="no_induk">No Induk</label>
                                                    <input name ="no_induk" type="text" class="form-control" value="{{ $siswa->no_induk }}">
                                                    @if ($errors->has('no_induk'))
                                                            <span class="help-block">{{$errors->first('no_induk')}}</span>
                                                    @endif
                                                </div>
                                        </div>
                                        <div class="col-md-8">
                                                <div class="form-group {{$errors->has('nama_siswa') ? ' has-error' : ''}}">
                                                    <label for="nama_siswa">Nama siswa</label>
                                                    <input name ="nama_siswa" type="text" class="form-control"
                                                    value="{{ $siswa->nama_siswa }}">
                                                    @if ($errors->has('nama_siswa'))
                                                            <span class="help-block">{{$errors->first('nama_siswa')}}</span>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <label>Kelas</label>
                                                      <select class="form-control" name="kelas_id">
                                                            <option value="" holder>== Ubah Kelas ==</option>
                                                            @foreach($kelas as $result)
                                                                  <option value="{{ $result->id }}"
                                                                        @if($result->id == $siswa->kelas_id)
                                                                              selected
                                                                        @endif
                                                                        >{{  $result->nama_kelas }}</option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                          </div>

                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <label>Wali Kelas</label>
                                                      <select class="form-control" name="guru_id">
                                                            <option value="" holder>== Ubah Wali Kelas ==</option>
                                                            @foreach($guru as $result)
                                                                  <option value="{{ $result->id }}"
                                                                        @if($result->id == $siswa->guru_id)
                                                                              selected
                                                                        @endif
                                                                        >{{  $result->nama_guru }}</option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-3">
                                                <!-- Combo Box -->
                                                <div class="form-group {{$errors->has('jk') ? ' has-error' : ''}}">
                                                      <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                                      <select name ="jk" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="0" disabled="true" selected="true">== Jenis Kelamin ==</option>
                                                            <option value="Laki-Laki" @if($siswa->jk == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                            <option value="Perempuan" @if($siswa->jk == 'Perempuan') selected @endif>Perempuan</option>
                                                      </select>
                                                      @if ($errors->has('jk'))
                                                            <span class="help-block">{{$errors->first('jk')}}</span>
                                                      @endif
                                                </div>
                                          </div>
                                          <div class="col-md-3">
                                                <div class="form-group {{$errors->has('agama') ? ' has-error' : ''}}">
                                                      <label for="exampleFormControlSelect1">Agama</label>
                                                      <select name ="agama" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="0" disabled="true" selected="true">== Agama ==</option>
                                                            <option value="Islam" @if($siswa->agama == 'Islam') selected @endif>Islam</option>
                                                            <option value="Kristen" @if($siswa->agama == 'Kristen') selected @endif>Kristen</option>
                                                            <option value="Katholik" @if($siswa->agama == 'Katholik') selected @endif>Katholik</option>
                                                            <option value="Hindu" @if($siswa->agama == 'Hindu') selected @endif>Hindu</option>
                                                            <option value="Budha" @if($siswa->agama == 'Budha') selected @endif>Budha</option>
                                                            <option value="Kong Hu Chu" @if($siswa->agama == 'Kong Hu Chu') selected @endif>Kong Hu Chu</option>
                                                      </select>
                                                      @if ($errors->has('agama'))
                                                            <span class="help-block">{{$errors->first('agama')}}</span>
                                                      @endif

                                                </div>
                                                <!-- End Combo Box -->
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('no_telp') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">No Telp</label>
                                                      <input name ="no_telp" type="text" class="form-control" value="{{ $siswa->no_telp }}">
                                                      @if ($errors->has('no_telp'))
                                                            <span class="help-block">{{$errors->first('no_telp')}}</span>
                                                      @endif

                                                </div>
                                          </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-12">
                                                <div class="form-group {{$errors->has('alamat') ? ' has-error' : ''}}">
                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                <textarea name ="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $siswa->alamat }}</textarea>
                                                @if ($errors->has('alamat'))
                                                      <span class="help-block">{{$errors->first('alamat')}}</span>
                                                @endif

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
