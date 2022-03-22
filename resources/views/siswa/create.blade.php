@extends('layouts.template')
@section('sub-judul', 'Tambah Data Siswa | E-Learning SKPK')
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
                              <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                    {{csrf_field()}}
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

                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('no_induk') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">No. Induk</label>
                                                      <input name ="no_induk" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Induk">
                                                      @if ($errors->has('no_induk'))
                                                            <span class="help-block">{{ $errors->first('no_induk') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* No Induk Wajib Diisi !</h5>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('nama_siswa') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">Nama siswa</label>
                                                      <input name ="nama_siswa" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama siswa">
                                                      @if ($errors->has('nama_siswa'))
                                                            <span class="help-block">{{ $errors->first('nama_siswa') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Isi Nama Siswa dengan Benar !</h5>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="row">
                                          {{-- Kelas --}}
                                          <div class="col-md-3">
                                                <div class="form-group {{$errors->has('kelas_id') ? ' has-error' : ''}}">
                                                      <label>Kelas</label>
                                                      <select name ="kelas_id" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="0" disabled="true" selected="true">== Pilih Kelas ==</option>
                                                            @foreach($kelas as $r)
                                                                  <option value="{{ $r->id }}">{{ $r->nama_kelas }}</option>
                                                            @endforeach
                                                      </select>
                                                      @if ($errors->has('kelas_id'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Kelas Harus Dipilih !</h5>
                                                </div>
                                          </div>

                                          {{-- Wali Kelas --}}
                                          <div class="col-md-3">
                                                <div class="form-group {{$errors->has('guru_id') ? ' has-error' : ''}}">
                                                      <label>Wali Kelas</label>
                                                      <select name ="guru_id" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="0" disabled="true" selected="true">== Pilih Wali Kelas ==</option>
                                                            @foreach($guru as $r)
                                                                  <option value="{{ $r->id }}">{{ $r->nama_guru }}</option>
                                                            @endforeach
                                                      </select>
                                                      @if ($errors->has('guru_id'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Wali Kelas Harus Dipilih !</h5>
                                                </div>
                                          </div>

                                          {{-- jenis kelamin --}}
                                          <div class="col-md-3">
                                                <!-- Combo Box -->
                                                <div class="form-group {{$errors->has('jk') ? ' has-error' : ''}}">
                                                      <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                                      <select name ="jk" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="0" disabled="true" selected="true">== Jenis Kelamin ==</option>
                                                            <option value="Laki-Laki" {{(old('jk') == 'Laki-Laki') ? 'selected' : ''}}>Laki-Laki</option>
                                                            <option value="Perempuan" {{(old('jk') == 'Perempuan') ? 'selected' : ''}}>Perempuan</option>
                                                      </select>
                                                      @if ($errors->has('jk'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Pilih Jenis Kelamin !</h5>
                                                </div>
                                          </div>

                                          {{-- agama --}}
                                          <div class="col-md-3">
                                                <div class="form-group {{$errors->has('agama') ? ' has-error' : ''}}">
                                                      <label for="exampleFormControlSelect1">Agama</label>
                                                      <select name ="agama" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" holder>== Agama ==</option>
                                                            <option value="Islam" {{(old('agama') == 'Islam') ? 'selected' : ''}}>Islam</option>
                                                            <option value="Kristen" {{(old('agama') == 'Kristen') ? 'selected' : ''}}>Kristen</option>
                                                            <option value="Katholik" {{(old('agama') == 'Katholik') ? 'selected' : ''}}>Katholik</option>
                                                            <option value="Hindu" {{(old('agama') == 'Hindu') ? 'selected' : ''}}>Hindu</option>
                                                            <option value="Budha" {{(old('agama') == 'Budha') ? 'selected' : ''}}>Budha</option>
                                                            <option value="Kong Hu Chu" {{(old('agama') == 'Kong Hu Chu') ? 'selected' : ''}}>Kong Hu Chu</option>
                                                      </select>
                                                      @if ($errors->has('agama'))
                                                            <span class="help-block">{{ $errors->first('agama') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Agama wajib diisi !</h5>
                                                </div>
                                                <!-- End Combo Box -->
                                          </div>
                                    </div>

                                    <div class="row">
                                          <div class="col-md-4">
                                                <div class="form-group {{$errors->has('nama_ayah') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">Nama Ayah</label>
                                                      <input name ="nama_ayah" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Ayah">
                                                      @if ($errors->has('nama_ayah'))
                                                            <span class="help-block">{{ $errors->first('nama_ayah') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Isi Nama ayah dengan Benar !</h5>
                                                </div>
                                          </div>

                                          <div class="col-md-4">
                                                <div class="form-group {{$errors->has('nama_ibu') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">Nama Ibu</label>
                                                      <input name ="nama_ibu" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Ibu">
                                                      @if ($errors->has('nama_ibu'))
                                                            <span class="help-block">{{ $errors->first('nama_ibu') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Isi Nama ibu dengan Benar !</h5>
                                                </div>
                                          </div>

                                          <div class="col-md-4">
                                                <div class="form-group">
                                                      <label for="exampleInputEmail1">Nama Wali</label>
                                                      <input name ="nama_wali" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Wali">

                                                      <h5 style="margin-left: 20px; font-style: italic;">* Nama Wali Tidak Wajib Diisi !</h5>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="row">
                                          {{-- alamat --}}
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('alamat') ? ' has-error' : ''}}">
                                                      <label for="exampleFormControlTextarea1">Alamat</label>
                                                      <textarea name ="alamat" class="form-control" id="exampleFormControlTextarea1" rows="4">{{old('alamat')}}</textarea>
                                                      @if ($errors->has('alamat'))
                                                            <span class="help-block">{{ $errors->first('alamat') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Alamat Wajib Diisi, min. 8 karakter dan maks. 100 karakter !</h5>
                                                </div>
                                          </div>

                                          {{-- nomor telepon --}}
                                          <div class="col-md-6">
                                                <div class="form-group {{$errors->has('no_telp') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">No Telp</label>
                                                      <input name ="no_telp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Telp">
                                                      @if ($errors->has('no_telp'))
                                                            <span class="help-block">{{ $errors->first('no_telp') }}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Isi No Telepon dengan Benar !</h5>
                                                </div>
                                          </div>

                                          <!--Input Avatar-->
                                          <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Foto Profil</label>
                                                <input type="file" name="foto_profil" class="form-control">
                                          </div>
                                    </div>

                                    <div class="modal-footer">
                                          <a href="/siswa" class="btn btn-default" style="color: black">Cancel</a>
                                          <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
@endsection
