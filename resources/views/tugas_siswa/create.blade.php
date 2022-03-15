@extends('layouts.template')
@section('sub-judul', 'Tambah Tugas | E-Learning SKPK')
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
                    <form action="{{ route('tugas_siswa.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                        {{csrf_field()}}
                        {{-- Mapel --}}
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="mapel_id">
                                <option value="0" disabled="true" selected="true">== Pilih Mata Pelajaran ==</option>
                                @foreach($mapels as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }} - {{ $mapel->kelas['nama_kelas'] }}</option>
                                @endforeach
                            </select>
                        </div>

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
                            <h5 style="margin-left: 20px; font-style: italic;">* Pilih sesuai kelas berdasarkan pilihan Mata Pelajaran yang diajarkan !</h5>
                        </div>

                        {{-- judul materi --}}
                        <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                            <label>Judul Materi</label>
                            <input name ="judul" type="text" class="form-control" placeholder="Judul Materi"
                            value="{{ old('judul') }}" id="judul">
                            @if ($errors->has('judul'))
                                <span class="help-block">{{ $errors->first('judul') }}</span>
                            @endif
                        </div>

                        {{-- isi materi --}}
                        <div class="form-group">
                            <label for="isi_tugas">Isi Tugas</label>
                            <textarea class="form-control" name="isi_tugas" id="isi_tugas"></textarea>
                        </div>

                        {{-- tombol --}}
                        <div class="modal-footer">
                        <a href="{{ route('tugas_siswa.index') }}" class="btn btn-default" style="color: black">Cancel</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'isi_tugas' );
	</script>
@endsection
