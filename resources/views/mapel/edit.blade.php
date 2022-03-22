@extends('layouts.template')
@section('sub-judul', 'Ubah Data Mata Pelajaran | E-Learning SKPK')
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
                              <form action="{{ route('mapel.update', $mapel->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                          <div class="col-md-4">
                                                <div class="form-group {{$errors->has('nama_mapel') ? ' has-error' : ''}}">
                                                      <label for="nama_mapel">Nama Mata Pelajaran</label>
                                                      <input name ="nama_mapel" type="text" class="form-control"
                                                      value="{{ $mapel->nama_mapel }}">
                                                      @if ($errors->has('nama_mapel'))
                                                            <span class="help-block">{{$errors->first('nama_mapel')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Nama mata pelajaran tidak boleh kosong !</h5>
                                                </div>
                                          </div>
                                          <div class="col-md-4">
                                                <div class="form-group">
                                                      <label>Kelas</label>
                                                      <select class="form-control" name="kelas_id">
                                                            <option value="" holder>== Ubah Kelas ==</option>
                                                            @foreach($kelas as $result)
                                                                  <option value="{{ $result->id }}"
                                                                        @if($result->id == $mapel->kelas_id)
                                                                              selected
                                                                        @endif
                                                                        >{{  $result->nama_kelas }}</option>
                                                            @endforeach
                                                      </select>
                                                      @if ($errors->has('kelas_id'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Kelas Harus Dipilih !</h5>
                                                </div>
                                          </div>
                                          <div class="col-md-4">
                                                <div class="form-group">
                                                      <label>Guru Pengajar</label>
                                                      <select class="form-control" name="guru_id">
                                                            <option value="" holder>== Ubah Guru Pengajar ==</option>
                                                            @foreach($guru as $result)
                                                                  <option value="{{ $result->id }}"
                                                                        @if($result->id == $mapel->guru_id)
                                                                              selected
                                                                        @endif
                                                                        >{{  $result->nama_guru }}</option>
                                                            @endforeach
                                                      </select>
                                                      @if ($errors->has('guru_id'))
                                                            <span class="help-block"></span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Pilih Guru Pengajar !</h5>
                                                </div>
                                          </div>
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
