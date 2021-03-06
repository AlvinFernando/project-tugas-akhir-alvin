@extends('layouts.template')
@section('sub-judul', 'Buat Pengumuman | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
        </a>
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
                                          <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                                {{csrf_field()}}
                                                {{-- Judul pengumuman --}}
                                                <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                                                      <label for="judul">Judul </label>
                                                      <input name ="judul" type="text" class="form-control"
                                                      id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul">
                                                      @if ($errors->has('judul'))
                                                            <span class="help-block">{{$errors->first('judul')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Judul Pengumuman wajib diisi !</h5>
                                                </div>

                                                {{-- isi pengumuman --}}
                                                <div class="form-group">
                                                      <label for="isi_pengumuman">Isi Pengumuman</label>
                                                      <textarea class="form-control" name="isi_pengumuman" id="isi_pengumuman"></textarea>
                                                </div>

                                                {{-- kepsek --}}
                                                {{-- <div class="form-group {{$errors->has('kepsek') ? ' has-error' : ''}}">
                                                      <label for="exampleInputEmail1">Kepala Sekolah</label>
                                                      <input name ="kepsek" type="text" class="form-control"
                                                      id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kepala Sekolah">
                                                      @if ($errors->has('kepsek'))
                                                            <span class="help-block">{{$errors->first('kepsek')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Kepala Sekolah wajib diisi !</h5>
                                                </div> --}}

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
      </div>
      <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'isi_pengumuman' );
	</script>
@endsection
