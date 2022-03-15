@extends('layouts.template')
@section('sub-judul', 'Edit Materi | E-Learning SKPK')
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
                                    <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                        @method('PATCH')
                                        {{csrf_field()}}
                                          {{-- Mapel --}}
                                          <div class="form-group">
                                                <label>Mata Pelajaran</label>
                                                <select class="form-control" name="mapel_id">
                                                    <option value="0" disabled="true" selected="true">== Pilih Mata Pelajaran ==</option>
                                                        @foreach($mapels as $mapel)
                                                            <option value="{{ $mapel->id }}"
                                                                @if($mapel->id == $materi->mapel_id)
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
                                                                @if ($r->id == $materi->kelas_id)
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

                                          {{-- judul materi --}}
                                          <div class="form-group {{$errors->has('judul_materi') ? ' has-error' : ''}}">
                                                <label>Judul Materi</label>
                                                <input name ="judul_materi" type="text" class="form-control" placeholder="Judul Materi"
                                                value="{{ $materi->judul_materi }}" id="judul_materi">
                                                @if ($errors->has('judul_materi'))
                                                      <span class="help-block">{{ $errors->first('judul_materi') }}</span>
                                                @endif
                                                <h5 style="margin-left: 20px; font-style: italic;">* Judul Materi Harus Diisi !</h5>
                                          </div>

                                          {{-- isi materi --}}
                                          <div class="form-group">
                                                <label for="isi_materi">Isi Materi</label>
                                                <textarea class="form-control" name="isi_materi" id="isi_materi">{{ $materi->isi_materi }}</textarea>
                                          </div>

                                          {{-- file materi --}}
                                          <div class="form-group">
                                                <label for="file">Upload FIle Materi</label>
                                                <input type="file" id="file_materi" name="file_materi[]" multiple>
                                          </div>

                                          {{-- tombol --}}
                                          <div class="modal-footer">
                                                <a href="{{ route('materi.index') }}" class="btn btn-default" style="color: black">Cancel</a>
                                                <button type="submit" class="btn btn-success">Ubah</button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'isi_materi' );
	</script>
@endsection
