@extends('auths.template')
@section('content')

	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box">
					<div class="left">
						<div class="contentx">
							<div class="header">
								<div class="logo text-center mb3"><img src="{{ asset('assets/img/logo-skpk.png') }}" style="width: 15%" alt="Klorofil Logo"></div>
								<div class="logo text-center fnt mt-2">E-LEARNING SKPK</div>
								<h6>SILAHKAN LOGIN TERLEBIH DAHULU</h6>
								@if ($message = Session::get('error'))
									<div class="alert alert-danger alert-block btn-sm">
										<strong >{{ $message }}</strong>
									</div>
								@endif
								@if ($errors->has('email') && $errors->has('password'))
									<div class="alert alert-danger alert-block btn-sm">
										<strong >Masukkan Data Anda Dengan Benar !!</strong>
									</div>
								@endif
							</div>
							<form class="form-auth-small" action="{{ route('postlogin') }}" method="POST">
							{{csrf_field()}}
								<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ @old('email') }}" required autofocus>
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input name="email" type="email" class="form-control" id="signin-email" placeholder="Email">
									@if ($errors->has('email'))
										<span class="help-block">
											<strong></strong>
										</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input name="password" type="password" class="form-control" id="signin-password" placeholder="Password">
									@if ($errors->has('password'))
										<span class="help-block">
											<strong></strong>
										</span>
								  	@endif
								</div>
								<div class="form-group clearfix">
									
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>

							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading" style="font-size:xx-large; ">SELAMAT DATANG DI </h1>
							<h2 style="font-size:xx-large; margin-top:-5px;">E-LEARNING SKPK</h2>
							<p>Child Today, Leader Tomorrow</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>


@endsection
