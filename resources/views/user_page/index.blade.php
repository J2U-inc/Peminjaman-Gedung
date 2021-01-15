@extends('layouts.appTemplate')

@section('main')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1 class="m-0">INI INDEX</h1> --}}
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              {{-- <li class="breadcrumb-item active">Profil</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
              {{-- <div class="card"> --}}
                  <div class="row">
                    @foreach ($gedung as $g)
                      <div class="col-sm-4">
                          <div class="card">
                            <div class="card-body" >
                                <h4 class="card-header" style="text-align: center"><strong>{{$g->nama_gedung}}</strong></h4>
                                <img class="card-img-top" src="/gambar/{{$g->foto}}" alt="Foto Gedung" style="max-width: 100%; height: auto;">
                                <div class="card-body">
                                {{-- <p class="card-text">{{$g->fungsi}}</p> --}}
                                <div style="text-align: center">
                                    <a href="/user/gedung/{{ $g->id }}" class="btn btn-primary" style="float: bottom">Detail Gedung</a>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      @endforeach

                  </div>



              {{-- </div> --}}
            </div>
          </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('script')
<script>
    $(function() {
        @if (session('success'))
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
            icon: 'success',
            title: '{{session('success')}}'
        })
        @endif
    });

</script>
@endpush

