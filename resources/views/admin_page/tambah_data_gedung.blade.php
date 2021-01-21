@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Gedung</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="/admin/gedung">Data Gedung</a></li>
              <li class="breadcrumb-item active">Tambah Data Gedung</li>
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
            <form method="POST" action="/admin/gedung" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="inputNamaGedung">Nama Gedung / Ruangan</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan Nama Gedung / Ruangan" name="nama_gedung" value="{{old('nama_gedung')}}" autocomplete="off">
                            @error('nama_gedung')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputLuasGedung">Luas Gedung / Ruangan (M2)</label>
                        <input type="number" class="form-control" id="inputLuasGedung"
                            placeholder="Silahkan Masukkan Luas Gedung / Ruangan dalam M2" name="luas" value="{{old('luas')}}" autocomplete="off">
                            @error('luas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKapasitasGedung">Kapasitas Gedung / Ruangan</label>
                        <input type="number" class="form-control" id="inputKapasitasGedung"
                            placeholder="Silahkan Masukkan Kapasitas Gedung / Ruangan" name="kapasitas" value="{{old('kapasitas')}}" autocomplete="off">
                            @error('kapasitas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputFungsiGedung">Fungsi Gedung / Ruangan</label>
                        <input type="text" class="form-control" id="inputFungsiGedung"
                            placeholder="Silahkan Masukkan Fungsi Gedung / Ruangan" name="fungsi" value="{{old('fungsi')}}" autocomplete="off">
                            @error('fungsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputFasilitasRuangan">Fasilitas Gedung / Ruangan</label>
                        <textarea class="form-control" id="inputFasilitasRuangan" style="height: 150px"
                            placeholder="Silahkan Masukkan Fasilitas Ruangan" name="deskripsi">{{old('deskripsi')}}</textarea>
                            @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                  <div class="form-group">
                    <label for="foto_ruangan">Foto Gedung/Ruangan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control-file" id="foto" name="foto">
                            @error('foto')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      </div>
                    </div>
                  </div>
{{-- ---------------------------------------------------------------------------------------------------------------- --}}
                  <div class="form-group">
                    <label for="foto_dalam">Foto Dalam Gedung/Ruangan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control-file" id="foto_dalam" name="foto_dalam[]" multiple>
                            @error('foto_dalam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      </div>
                    </div>
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
