@extends('layouts.template')
@section('sub-judul', 'Tambah Data Kelas | E-Learning SKPK')
@section('panel-heading')
      <div class="panel-heading">
            <h3 class="panel-title">@yield('sub-judul')</h3>
      </div>
@stop
@section('content')

      <div class="row">
            <div class="col-md-12">
                        <div class="card">
                              <div class="card-body">
                                    <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                          {{csrf_field()}}
                                          <div class="row">
                                                <div class="col-sm-6">
                                                      <div class="form-group {{$errors->has('nama_kelas') ? ' has-error' : ''}}">
                                                            <label>Nama Kelas</label>
                                                            <input name ="nama_kelas" type="text" class="form-control"
                                                            id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Kelas" value="{{ old('nama_kelas') }}">
                                                            @if ($errors->has('nama_kelas'))
                                                                  <span class="help-block">{{$errors->first('nama_kelas')}}</span>
                                                            @endif
                                                            <h5 style="margin-left: 20px; font-style: italic;">* Isi Kelas dengan Benar !</h5>
                                                      </div>
                                                </div>
                                                <div class="col-sm-6">
                                                      <div class="form-group {{$errors->has('tahun_ajaran_id') ? ' has-error' : ''}}">
                                                            <label>Tahun Ajaran</label>
                                                            <select name ="tahun_ajaran_id" class="form-control" id="exampleFormControlSelect1">
                                                                  <option value="0" disabled="true" selected="true">== Pilih Tahun Ajaran ==</option>
                                                                  @foreach($tahun_ajaran as $result)
                                                                        <option value="{{ $result->id }}">{{ $result->thn_ajaran }}</option>
                                                                  @endforeach
                                                            </select>
                                                            @if ($errors->has('tahun_ajaran_id'))
                                                                  <span class="help-block"></span>
                                                            @endif
                                                            <h5 style="margin-left: 20px; font-style: italic;">* Tahun Ajaran Wajib Dipilih !</h5>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                                <a href="{{ url()->previous() }}" class="btn btn-default" style="color: black">Cancel</a>
                                                <button type="submit" class="btn btn-success">Tambah</button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection
