@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Gedung</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/index">Beranda</a></li>
              <li class="breadcrumb-item active">Data Gedung</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="/admin/gedung/create">
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-plus"></i>    Tambah Data
                    </button></a>
            </div>
            <div class="card-body">
                {{-- mulai dari sini masukkan data table --}}
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr style="text-align: center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Luas</th>
                    <th>Kapasitas</th>
                    <th>Fungsi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($gedung as $g)
                    <tr>
                    <td scope="row" style="text-align: center">{{$loop->iteration}}</td>
                    <td style="text-align: center">{{ $g->nama_gedung }}</td>
                    <td style="text-align: center">{{ $g->luas }} m2</td>
                    <td style="text-align: center">{{ $g->kapasitas }} orang</td>
                    <td style="text-align: center">{{ $g->fungsi }}</td>
                    <td style="text-align: center">
                        <form method="POST" action="/admin/gedung/{{$g->id}}">
                            @csrf
                            @method('delete')
                            <a href="/admin/gedung/{{ $g->id }}" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Gedung"
                                style="width: 40px"><i class="nav-icon fa fa-info"></i></a>

                            <a href="/admin/gedung/{{ $g->id }}/edit" class="btn btn-warning"
                                data-toggle="tooltip" data-placement="top" title="Edit Data Gedung"
                                style="width: 40px"><i class="nav-icon fa fa-pencil-square-o"></i></a>

                            <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                data-placement="top" title="Hapus Data Gedung" style="width: 40px"
                                onclick="return confirm('Apakah Anda yakin akan menghapus data ?')">
                                <i class="nav-icon fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table></div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
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

