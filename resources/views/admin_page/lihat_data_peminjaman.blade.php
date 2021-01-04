@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lihat Data Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="/admin/peminjaman">Data Peminjaman</a></li>
              <li class="breadcrumb-item active">Lihat Data Peminjaman</li>
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
                {{-- persetujuan --}}
                <div style="float: right">
                    <form action="/admin/persetujuan/{{$peminjaman[0]->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="1" name="status">
                        <button type="submit" class="btn btn-success ml-2" style="width: 80px; float: right">
                            Terima
                        </button>
                    </form>
                </div>
                <div>
                    <form action="/admin/penolakan/{{$peminjaman[0]->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="0" name="status">
                        <button type="submit" class="btn btn-danger" style="width: 80px;float: right">
                            Tolak
                        </button>
                    </form>
                </div>
        </div>
            {{-- konten --}}
            <form method="GET" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @php
                    $datetimes=array($peminjaman[0]->awal_pinjam, $peminjaman[0]->akhir_pinjam);
                    $tanggal=implode("-",$datetimes);
                    @endphp
                    <div class="form-group">
                        <label for="inputNamaGedung">Nama Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan Nama Peminjam" name="nama_peminjam" value="{{old('title') ? old('title') : $peminjaman[0]->nama_peminjam}}" readonly>
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKeperluan">Nama Organisasi/Lembaga</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="lembaga" value="{{old('title') ? old('title') : $peminjaman[0]->lembaga}}" readonly>
                            @error('lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="inputKapasitasLembaga">Gedung</label>
                        <select name="gedung_id" class="form-control" id="gedung_id">
                            @foreach ($gedung as $g)
                            <option value="{{$g->id}}">{{old('title') ? old('title') : $peminjaman->nama_gedung}}</option>
                            @endforeach
                        </select>
                            @error('gedung_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="inputKeperluan">Nama Gedung</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="lembaga" value="{{old('title') ? old('title') : $peminjaman[0]->nama_gedung}}" readonly>
                            @error('lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKeperluan">Keperluan</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="keperluan" value="{{old('title') ? old('title') : $peminjaman[0]->keperluan}}" readonly>
                            @error('keperluan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputAwalPinjam">Awal dan Akhir Pinjam</label>
                        <input type="text" name="datetimes" class="form-control" id="inputAwalPinjam"
                            placeholder="Silahkan Masukkan Tanggal Awal dan Akhir Peminjaman"  value="{{old('title') ? old('title') : $tanggal}}" readonly>
                            @error('awal_pinjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>


                    {{-- <div class="form-group">
                        <label for="surat_peminjaman">Surat Peminjaman</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="form-control-file" id="surat_peminjaman" name="surat_peminjaman">
                                @error('surat_peminjaman')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                          </div>
                        </div>
                      </div> --}}

                    <div class="form-group">
                        <label for="surat_peminjaman">Surat Peminjaman</label><br>
                            @if ($peminjaman[0]->surat_peminjaman)
                                <a href="/gambar/{{$peminjaman[0]->surat_peminjaman}}" alt="surat" width="300" target="_blank" class="btn btn-info">Surat Peminjaman</a>
                            @else
                                <p>Belum ada surat</p>
                            @endif
                        <div class="input-group">
                        </div>
                    </div>
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
