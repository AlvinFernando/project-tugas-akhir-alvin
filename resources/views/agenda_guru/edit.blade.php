@extends('layouts.template')
@section('sub-judul', 'Ubah Agenda | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="{{ route('agenda.index') }}" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Halaman Agenda
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
                                          <form action="{{ route('agenda.update') }}" method="POST" enctype="multipart/form-data"> <!-- memanggil controller create-->
                                                @method('PATCH')
                                                {{csrf_field()}}
                                                {{-- Judul Agenda --}}
                                                <div class="form-group {{$errors->has('judul') ? ' has-error' : ''}}">
                                                      <label for="judul">Judul</label>
                                                      <input name ="judul" type="text" class="form-control"
                                                      id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $agenda->judul }}">
                                                      @if ($errors->has('judul'))
                                                            <span class="help-block">{{$errors->first('judul')}}</span>
                                                      @endif
                                                      <h5 style="margin-left: 20px; font-style: italic;">* Judul Agenda wajib diisi !</h5>
                                                </div>

                                                {{-- isi Agenda --}}
                                                <div class="form-group">
                                                      <label for="isi_agenda">Isi Agenda</label>
                                                      <textarea class="form-control" name="isi_agenda" id="isi_agenda">{{ $agenda->isi_agenda }}</textarea>
                                                </div>

                                                <div class="modal-footer">
                                                      <a href="{{ route('agenda.index') }}" class="btn btn-default" style="color: black">Cancel</a>
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
		CKEDITOR.replace( 'isi_agenda' );
	</script>
@endsection
