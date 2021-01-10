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

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="wrap-input100 validate-input m-b-26" data-validate="Silahkan Masukkan Email">
						<span class="label-input100">Email</span>
                        <input class="input100  @error('email') is-invalid @enderror" type="email" name="email" placeholder="Silahkan Masukkan Email Anda" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Silhkan Masukkan Password">
						<span class="label-input100">Password</span>
                        <input id="password" class="input100  @error('password') is-invalid @enderror" type="password"
                            name="password" placeholder="Silahkan Masukkan Password Anda" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                    </div>


					<div class="flex-sb-m w-full p-b-30">
						<div>
                            <input type="checkbox" onclick="myFunction()"> Lihat Kata Sandi</div>

						<div>
							{{-- <a href="#" class="txt1">
								Lupa Kata Sandi ?
                            </a> --}}
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
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
            position: 'center',
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
