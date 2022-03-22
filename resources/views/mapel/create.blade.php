@extends('layouts.template')
@section('sub-judul', 'Tambah Data Mata Pelajaran | E-Learning SKPK')
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
                                    <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                          {{csrf_field()}}
                                          <div class="form-group {{$errors->has('nama_mapel') ? ' has-error' : ''}}">
                                                <label>Nama Mata Pelajaran</label>
                                                <input name ="nama_mapel" type="text" class="form-control" placeholder="Nama Mata Pelajaran" value="{{ old('nama_mapel') }}">
                                                @if ($errors->has('nama_mapel'))
                                                      <span class="help-block">{{ $errors->first('nama_mapel') }}</span>
                                                @endif
                                                <h5 style="margin-left: 20px; font-style: italic;">* Nama Mata Pelajaran Harus Diisi !</h5>
                                          </div>

                                          <div class="form-group {{$errors->has('kelas_id') ? ' has-error' : ''}}">
                                                <label>Kelas</label>
                                                <select name ="kelas_id" class="form-control" id="exampleFormControlSelect1">
                                                      <option value="0" disabled="true" selected="true">== Pilih Kelas ==</option>
                                                      @foreach($kelas as $r)
                                                            <option value="{{ $r->id }}" {{(old('kelas_id') == 'id') ? 'selected' : ''}}>{{ $r->nama_kelas }}</option>
                                                      @endforeach
                                                </select>
                                                @if ($errors->has('kelas_id'))
                                                      <span class="help-block"></span>
                                                @endif
                                                <h5 style="margin-left: 20px; font-style: italic;">* Kelas Harus Dipilih !</h5>
                                          </div>

                                          <div class="form-group {{$errors->has('guru_id') ? ' has-error' : ''}}">
                                                <label>Guru Pengajar</label>
                                                <select name ="guru_id" class="form-control" id="exampleFormControlSelect1">
                                                      <option value="0" disabled="true" selected="true">== Pilih Guru Pengajar ==</option>
                                                      @foreach($guru as $r)
                                                            <option value="{{ $r->id }}" {{(old('guru_id') == 'id') ? 'selected' : ''}}>{{ $r->nama_guru }}</option>
                                                      @endforeach
                                                </select>
                                                @if ($errors->has('guru_id'))
                                                      <span class="help-block"></span>
                                                @endif
                                                <h5 style="margin-left: 20px; font-style: italic;">* Pilih Guru Pengajar dari Mata Pelajaran Tersebut !</h5>
                                          </div>

                                          <div class="modal-footer">
                                                <a href="{{ route('mapel.index') }}" class="btn btn-default" style="color: black">Cancel</a>
                                                <button type="submit" class="btn btn-success">Tambah</button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
        </div>
@endsection
