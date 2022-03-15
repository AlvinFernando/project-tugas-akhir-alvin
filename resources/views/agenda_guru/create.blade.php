@extends('layouts.template')
@section('sub-judul', 'Buat Agenda | E-Learning SKPK')
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

      @if(count($errors)>0)
            @foreach($errors->all() as $error)
                  <div class="alert alert-danger" role="alert">
                        {{ $error }}
                  </div>
            @endforeach
      @endif

      <div class="row">
            <div class="col-md-12">
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-body">
                                          <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                                {{csrf_field()}}
                                                {{-- kelas --}}
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
                                                </div>

                                                {{-- Judul Agenda --}}
                                                <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                                                      <label for="judul">Judul</label>
                                                      <input name ="judul" type="text" class="form-control"
                                                      id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul">
                                                      @if ($errors->has('judul'))
                                                            <span class="help-block">{{$errors->first('judul')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Judul Agenda wajib diisi !</h5>
                                                </div>

                                                {{-- isi Agenda --}}
                                                <div class="form-group">
                                                      <label for="isi_agenda">Isi Agenda</label>
                                                      <textarea class="form-control" name="isi_agenda" id="isi_agenda"></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                      <a href="{{ route('agenda.index') }}" class="btn btn-default" style="color: black">Cancel</a>
                                                      <button type="submit" class="btn btn-success">Tambah</button>
                                                </div>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'isi_agenda' );
	</script>
@endsection
