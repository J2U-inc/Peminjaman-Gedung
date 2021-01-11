@extends('layouts.appTemplate')

@section('main')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Profil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item"><a href="/user/index">Profil</a></li>
              <li class="breadcrumb-item active">Edit Profil</li>
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
                  <form method="POST" action="/user/index/{{$user['id']}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="card-body">

                        <div class="form-group">
                            <label for="showNama">Nama</label>
                            <input type="text" class="form-control" id="showNama"
                                placeholder="Silahkan Masukkan Nama Anda" name="name"
                                    value="{{old('title') ? old('title') : $users = Auth::user()->name}}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="showNIM">NIM</label>
                            <input type="text" class="form-control" id="showNIM"
                                placeholder="Silahkan Masukkan NIM Anda" name="nim"
                                    value="{{old('title') ? old('title') : $users = Auth::user()->nim}}">
                                @error('nim')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="showEmail">Email</label>
                            <input type="text" class="form-control" id="showEmail"
                                placeholder="Silahkan Masukkan Email Anda" name="email"
                                    value="{{old('title') ? old('title') : $users = Auth::user()->email}}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="showNoHP">Nomor HP</label>
                            <input type="text" class="form-control" id="showNoHP"
                                placeholder="Silahkan Masukkan Nomor HP Anda" name="nohp"
                                    value="{{old('title') ? old('title') : $users = Auth::user()->nohp}}">
                                @error('nohp')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div><br>


                        <div class="form-group" style="background-color: white">
                            <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Apakah Anda yakin akan mengubah data ?')">Simpan</button>
                          </div>
                      </div>
                      <!-- /.card-body -->
                  </form>
              </div>
            </div>
          </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
