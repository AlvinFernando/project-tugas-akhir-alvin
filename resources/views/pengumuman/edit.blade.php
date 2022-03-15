@extends('layouts.template')
@section('sub-judul', 'Ubah Pengumuman | E-Learning SKPK')
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
                            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                @method('PUT')
                                {{csrf_field()}}
                                {{-- Judul pengumuman --}}
                                <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                                    <label for="judul">Judul </label>
                                    <input name ="judul" type="text" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul" value="{{ $pengumuman->judul }}">
                                    @if ($errors->has('judul'))
                                        <span class="help-block">{{$errors->first('judul')}}</span>
                                    @endif
                                </div>

                                {{-- isi pengumuman --}}
                                <div class="form-group">
                                    <label for="isi_pengumuman">Isi Pengumuman</label>
                                    <textarea class="form-control" name="isi_pengumuman" id="isi_pengumuman">{{ $pengumuman->isi_pengumuman }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ url()->previous() }}" class="btn btn-default" style="color: black">Cancel</a>
                                    <button type="submit" class="btn btn-warning">Ubah</button>
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
