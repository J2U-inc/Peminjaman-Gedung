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
              <li class="breadcrumb-item"><a href="/admin/index">Beranda</a></li>
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
            @if (Auth::user()->is_admin==1)
            <div class="card-body" style="margin-bottom: -40px">
                {{-- persetujuan --}}
                @if($peminjaman->status===null)
                <div style="float: right">
                    <form action="/admin/persetujuan/{{$peminjaman->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="1" name="status">
                        <button type="submit" class="btn btn-success ml-2" style="width: 100px; float: right"
                        onclick="return confirm('Apakah Anda yakin akan menyetujui peminjaman ?')">
                        <i class="fa fa-check" aria-hidden="true"></i>    Terima
                        </button>
                    </form>
                </div>
                <div>
                    <form action="/admin/penolakan/{{$peminjaman->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="0" name="status">
                        <button type="submit" class="btn btn-danger" style="width: 100px;float: right"
                        onclick="return confirm('Apakah Anda yakin akan menolak peminjaman ?')">
                        <i class="fa fa-times" aria-hidden="true"></i>    Tolak
                        </button>
                    </form>
                </div>
                @elseif($peminjaman->status===1)
                <div>
                    <form action="/admin/penyelesaian/{{$peminjaman->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="2" name="status">
                        <button type="submit" class="btn btn-primary" style="width: 100px;float: right"
                        onclick="return confirm('Apakah Anda yakin akan menyelesaikan peminjaman ?')">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>    Selesai
                        </button>
                    </form>
                </div>
                <br><br>
                <hr style="border: 1px solid black;">
                @endif
        </div>
        @endif
            {{-- konten --}}
            <form method="GET" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @php
                    $datetimes=array($peminjaman->awal_pinjam, $peminjaman->akhir_pinjam);
                    $tanggal=implode("-",$datetimes);
                    @endphp

                    <div class="form-group">
                        <label for="inputNamaGedung">Nama Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan Nama Peminjam" name="nama_peminjam" value="{{$peminjaman->user->name}}" readonly>
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputNamaGedung">NIM Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan NIM Peminjam" name="nama_peminjam" value="{{$peminjaman->user->nim == 0 ? '-' : $peminjaman->user->nim}}" readonly>
                            @error('nim')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>


                    <div class="form-group">
                        <label for="inputNamaGedung">Email Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan NIM Peminjam" name="nama_peminjam" value="{{$peminjaman->user->email}}" readonly>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputNamaGedung">Nomor HP Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan No HP Peminjam" name="nohp" value="{{strlen($peminjaman->user->nohp) > 0 ? $peminjaman->user->nohp : '-'}}" readonly>
                            @error('nohp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label>Fakultas</label>
                        <input type="text" class="form-control"
                            placeholder="Silahkan Masukkan Nama Fakultas" name="fakultas" value="{{strlen($peminjaman->user->fakultas) > 0 ? $peminjaman->user->fakultas : '-'}}" readonly>
                            @error('fakultas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control"
                            placeholder="Silahkan Masukkan Nama Jurusan" name="jurusan" value="{{strlen($peminjaman->user->jurusan) > 0 ? $peminjaman->user->jurusan : '-'}}" readonly>
                            @error('jurusan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKeperluan">Nama Organisasi/Lembaga</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="lembaga" value="{{$peminjaman->lembaga}}" readonly>
                            @error('lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="inputKapasitasLembaga">Gedung</label>
                        <select name="gedung_id" class="form-control" id="gedung_id">
                            @foreach ($gedung as $g)
                            <option value="{{$g->id}}">{{$peminjaman->nama_gedung}}</option>
                            @endforeach
                        </select>
                            @error('gedung_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="inputKeperluan">Nama Gedung</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="lembaga" value="{{$peminjaman->gedung->nama_gedung}}" readonly>
                            @error('lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKeperluan">Keperluan</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan" name="keperluan" value="{{$peminjaman->keperluan}}" readonly>
                            @error('keperluan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputAwalPinjam">Awal dan Akhir Pinjam</label>
                        <input type="text" name="datetimes" class="form-control" id="inputAwalPinjam"
                            placeholder="Silahkan Masukkan Tanggal Awal dan Akhir Peminjaman"  value="{{$tanggal}}" readonly>
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
                            @if ($peminjaman->surat_peminjaman)
                                <a href="/gambar/{{$peminjaman->surat_peminjaman}}" alt="surat" width="300" target="_blank" class="btn btn-info">Surat Peminjaman</a>
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
