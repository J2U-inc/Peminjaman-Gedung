@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/index">Home</a></li>
              <li class="breadcrumb-item "><a href="/admin/peminjaman">Data Peminjaman</a></li>
              <li class="breadcrumb-item active">Tambah Data Peminjaman</li>
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
            <form method="POST" action="{{route('peminjaman.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <input type="hidden" value="{{$users = Auth::user()->id}}" name="user_id">
                    </div>

                    <div class="form-group">
                        <label for="inputNamaGedung">Nama Peminjam</label>
                        <input type="text" class="form-control" id="inputNamaGedung"
                            placeholder="Silahkan Masukkan Nama Peminjam" name="nama_peminjam" value="{{ Auth::user()->name }}"
                            readonly
                            >
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    {{-- Data User----------------------------------------------------------------------------- --}}
                    @if (Auth::user()->is_admin==0)
                    <div class="form-group">
                        <label for="inputNIMPeminjam">NIM Peminjam</label>
                        <input type="text" class="form-control" id="inputNIMPeminjam"
                            placeholder="Silahkan Masukkan NIM Peminjam" name="nim" value="<?php if(Auth::user()->is_admin!=1){ echo Auth::user()->nim;} else { echo old('nama_peminjam'); } ?>"
                            @if (Auth::user()->is_admin==0) readonly @endif
                            >
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    @endif

                    @if (Auth::user()->is_admin==0)
                    <div class="form-group">
                        <label for="inputNIMPeminjam">Email Peminjam</label>
                        <input type="text" class="form-control" id="inputNIMPeminjam"
                            placeholder="Silahkan Masukkan NIM Peminjam" name="nim" value="<?php if(Auth::user()->is_admin!=1){ echo Auth::user()->email;} else { echo old('nama_peminjam'); } ?>"
                            @if (Auth::user()->is_admin==0) readonly @endif
                            >
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    @endif

                    @if (Auth::user()->is_admin==0)
                    <div class="form-group">
                        <label for="inputNoHpPeminjam">Nomor HP Peminjam</label>
                        <input type="text" class="form-control" id="inputNoHpPeminjam"
                            placeholder="Silahkan Masukkan NIM Peminjam" name="nohp" value="<?php if(Auth::user()->is_admin!=1){ echo Auth::user()->nohp;} else { echo old('nama_peminjam'); } ?>"
                            @if (Auth::user()->is_admin==0) readonly @endif
                            >
                            @error('nama_peminjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    @endif
                    {{--end Data User --------------------------------------------------------------------------- --}}

                    <div class="form-group">
                        <label for="inputKeperluan">Nama Organisasi/Lembaga</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Nama Organisasi / Lembaga" name="lembaga" value="{{old('lembaga')}}">
                            @error('lembaga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKapasitasLembaga">Gedung</label>
                        <select name="gedung_id" class="form-control" id="gedung_id">
                            @foreach ($gedung as $g)
                            <option value="{{$g->id}}">{{$g->nama_gedung}}</option>
                            @endforeach
                        </select>
                            @error('gedung_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputKeperluan">Keperluan</label>
                        <input type="text" class="form-control" id="inputKeperluan"
                            placeholder="Silahkan Masukkan Keperluan / Keterangan" name="keperluan" value="{{old('keperluan')}}">
                            @error('keperluan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputAwalPinjam">Awal dan Akhir Pinjam</label>
                        <input type="text" name="datetimes" class="form-control" id="inputAwalPinjam"
                            placeholder="Silahkan Masukkan Tanggal Awal dan Akhir Peminjaman"  value="{{old('awal_pinjam')}}">
                            @error('awal_pinjam')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>


                    <div class="form-group">
                        <label for="surat_peminjaman">Surat Peminjaman</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="form-control-file" id="surat_peminjaman" name="surat_peminjaman">
                                @error('surat_peminjaman')
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

@push('script')
<script>
    $(function() {
        $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'), timePicker24Hour: true,
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                format: 'YY-MM-DD HH:mm:ss'
                }
        });
    });
</script>
@endpush
