@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lihat Data Gedung</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/user/index">Beranda</a></li>
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
            <div class="card-header">
                <a href="/user/cektanggal/{{$gedung->id}}" class="btn btn-primary" style="float: right"><i class="fa fa-calendar"></i>    Cek Jadwal {{$gedung->nama_gedung}}</a>
            </div>
            {{-- konten --}}
            <form method="GET" action="/user/gedung/{id}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="showNamaGedung">Nama Gedung / Ruangan</label>
                        <input type="text" class="form-control" id="showNamaGedung"
                            placeholder="Silahkan Masukkan Nama Ruangan" name="nama_gedung"
                                value="{{old('title') ? old('title') : $gedung->nama_gedung}}" readonly>
                            @error('nama_gedung')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="showLuasGedung">Luas Gedung / Ruangan (M2)</label>
                        <input type="text" class="form-control" id="showLuasGedung"
                            placeholder="Silahkan Masukkan Nama Ruangan" name="luas"
                                value="{{old('title') ? old('title') : $gedung->luas}} m2" readonly>
                            @error('luas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="showKapasitasGedung">Kapasitas Gedung / Ruangan</label>
                        <input type="text" class="form-control" id="showKapasitasGedung"
                            placeholder="Silahkan Masukkan Nama Ruangan" name="kapasitas"
                                value="{{old('title') ? old('title') : $gedung->kapasitas}} orang" readonly>
                            @error('kapasitas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputFungsiGedung">Fungsi Gedung / Ruangan</label>
                        <input type="text" class="form-control" id="inputFungsiGedung"
                            placeholder="Silahkan Masukkan Nama Ruangan" name="fungsi"
                                value="{{old('title') ? old('title') : $gedung->fungsi}}" readonly>
                            @error('fungsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="showDeskripsiRuangan">Fasilitas Gedung / Ruangan</label>
                        <textarea class="form-control" id="showDeskripsiRuangan" style="height: 150px" readonly
                            placeholder="Silahkan Masukkan Deskripsi Ruangan" name="deskripsi">{{old('deskripsi') ? old('deskripsi') : $gedung->deskripsi}}</textarea>
                            @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      </div>

                    <div class="form-group">
                        <label for="foto_ruangan">Foto Gedung/Ruangan</label><br>
                            @if ($gedung->foto)
                                <img src="/gambar/{{$gedung->foto}}" width="300">
                            @else
                                <p>Belum ada foto ruangan</p>
                            @endif
                        <div class="input-group">
                        </div>
                    </div>

                    @php
                        $foto_dalam = json_decode ($gedung->foto_dalam);
                    @endphp
                    <div class="form-group">
                        <label for="foto_ruangan">Foto Dalam Gedung/Ruangan</label><br>
                        @if ($gedung->foto_dalam)
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 300px">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="/gambar/{{$foto_dalam[0]}}" alt="First slide">
                              </div>
                              @foreach ($foto_dalam as $fd)
                              <div class="carousel-item">
                                <img class="d-block w-100" src="/gambar/{{$fd}}" alt="Second slide">
                              </div>
                              @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                          @else
                                <p>Belum ada foto dalam ruangan</p>
                          @endif
                    </div>

                    {{-- <div class="card-footer">
                        <a href="/admin/gedung" class="btn btn-warning">kembali</a>
                    </div> --}}
                </div>
                <!-- /.card-body -->
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
