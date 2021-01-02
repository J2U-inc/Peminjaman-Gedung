@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Lembaga</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="/admin/lembaga">Data Lembaga</a></li>
              <li class="breadcrumb-item active">Tambah Data Lembaga</li>
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
            {{-- konten --}}
            <form method="POST" action="/admin/lembaga" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="inputNamalembaga">Nama lembaga / Ruangan</label>
                        <input type="text" class="form-control" id="inputNamalembaga"
                            placeholder="Silahkan Masukkan Nama Lembaga / Ruangan" name="nama_lembaga" value="{{old('nama_lembaga')}}">
                            @error('nama_lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputTanggalBerdiri">Tanggal Berdiri</label>
                        <input type="date" class="form-control" id="inputTanggalBerdiri"
                            placeholder="Silahkan Masukkan Tanggal Berdiri Lembaga" name="tanggal_berdiri" value="{{old('tanggal_berdiri')}}">
                            @error('tanggal_berdiri')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKapasitasLembaga">Level</label>
                        <select name="level" class="form-control" id="level">
                            <option value="universitas">universitas</option>
                            <option value="fakultas">fakultas</option>
                            <option value="jurusan">jurusan</option>
                          </select>
                            @error('level')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="background-color: white">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
