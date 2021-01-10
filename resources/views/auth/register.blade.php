@extends('layouts.loginskeleton')

@section('loginn')
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
                    <img src="{{ ('gambar/logo.png') }}" alt="Logo" style="width: 10%" class="mb-2">
					<span class="login100-form-title-1">
						Sistem Peminjaman Gedung <br>UIN SUSKA Riau
					</span>
				</div>

                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
					<div class="wrap-input100 validate-input m-b-26" data-validate="Silahkan Masukkan Nama Anda">
						<span class="label-input100">Nama</span>
                        <input class="input100  @error('name') is-invalid @enderror" type="text" name="name" placeholder="Silahkan Masukkan Nama Anda" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Silahkan Masukkan NIM Anda">
						<span class="label-input100">NIM</span>
                        <input class="input100  @error('nim') is-invalid @enderror" type="number" name="nim" placeholder="Silahkan Masukkan NIM Anda" value="{{ old('nim') }}" required autocomplete="nim">
                        @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Silahkan Masukkan Email Anda">
						<span class="label-input100">Email</span>
                        <input class="input100  @error('email') is-invalid @enderror" type="email" name="email" placeholder="Silahkan Masukkan Email Students Anda" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Silahkan Masukkan No HP Anda">
						<span class="label-input100">Nomor HP</span>
                        <input class="input100  @error('nohp') is-invalid @enderror" type="number" name="nohp" placeholder="Silahkan Masukkan Nomor HP Anda" value="{{ old('nohp') }}" required autocomplete="nohp">
                        @error('nohp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Silhkan Masukkan Kata Sandi">
						<span class="label-input100">Password</span>
                        <input id="password" class="input100  @error('password') is-invalid @enderror" type="password"
                            name="password" placeholder="Silahkan Masukkan Password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Silhkan Masukkan Kata Sandi">
						<span class="label-input100">Konfirmasi Password</span>
                        <input id="password" class="input100  @error('password') is-invalid @enderror" type="password"
                            name="password_confirmation" placeholder="Silahkan Masukkan Konfirmasi Password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                    </div>


					<div class="flex-sb-m w-full p-b-30">
						<div>
                            {{-- <input type="checkbox" onclick="myFunction()"> Lihat Kata Sandi</div> --}}

						<div>
							{{-- <a href="#" class="txt1">
								Lupa Kata Sandi ?
                            </a> --}}
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</body>
@endsection

@push('scriptlogin')
<script>
    $(function() {

        @if (session('warning'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            Height: 1500,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'warning',
            title: '{{session('warning')}}'
        })
        @endif
    });


</script>
@endpush
