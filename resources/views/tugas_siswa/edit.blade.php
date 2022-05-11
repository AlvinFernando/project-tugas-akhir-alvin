@extends('layouts.template')
@section('sub-judul', 'Edit Tugas Siswa | E-Learning SKPK')
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
                    <form action="{{ route('tugas_siswa.update', $tugas_siswa->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                        @method('PATCH')
                        {{csrf_field()}}
                        {{-- Mapel --}}
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="mapel_id">
                                <option value="0" disabled="true" selected="true">== Pilih Mata Pelajaran ==</option>
                                @foreach($mapels as $mapel)
                                    <option value="{{ $mapel->id }}"
                                        @if($mapel->id == $tugas_siswa->mapel_id)
                                            selected
                                        @endif
                                    >{{ $mapel->nama_mapel }} - {{ $mapel->kelas['nama_kelas'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- kelas --}}
                        <div class="form-group {{$errors->has('kelas_id') ? ' has-error' : ''}}">
                            <label>Kelas</label>
                            <select name ="kelas_id" class="form-control" id="exampleFormControlSelect1">
                                <option value="0" disabled="true" selected="true">== Pilih Kelas ==</option>
                                @foreach($kelas as $r)
                                    <option value="{{ $r->id }}"
                                        @if ($r->id == $tugas_siswa->kelas_id)
                                            selected
                                        @endif
                                    >{{ $r->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kelas_id'))
                                <span class="help-block"></span>
                            @endif
                            <h5 style="margin-left: 20px; font-style: italic;">* Pilih sesuai kelas berdasarkan pilihan Mata Pelajaran yang diajarkan !</h5>
                        </div>

                        {{-- judul tugas --}}
                        <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                            <label>Judul Tugas</label>
                            <input name ="judul" type="text" class="form-control" placeholder="Judul tugas_siswa"
                            value="{{ $tugas_siswa->judul }}" id="judul">
                                @if ($errors->has('judul'))
                                    <span class="help-block">{{ $errors->first('judul') }}</span>
                                @endif
                            <h5 style="margin-left: 20px; font-style: italic;">* Judul Tugas Harus Diisi !</h5>
                        </div>

                        {{-- isi tugas --}}
                        <div class="form-group">
                            <label for="isi_tugas">Isi tugas</label>
                            <textarea class="form-control" name="isi_tugas" id="isi_tugas">{!! $tugas_siswa->isi_tugas !!}</textarea>
                        </div>

                        {{-- tanggal deadline --}}
                        <div class="form-group">
                            <label>Tanggal Deadline</label>
                            <input name ="end_date" type="text" class="dates form-control" value="{{ $tugas_siswa->end_date }}" placeholder="yyyy/mm/dd" id="end_date">
                        </div>

                        {{-- tombol --}}
                        <div class="modal-footer">
                            <a href="{{ route('tugas_siswa.index') }}" class="btn btn-default" style="color: black">Cancel</a>
                            <button type="submit" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'isi_tugas' );
	</script>
@endsection
