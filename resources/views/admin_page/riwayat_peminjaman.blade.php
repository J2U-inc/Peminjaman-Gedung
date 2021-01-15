@extends('layouts.appTemplate')
@section('main')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Riwayat Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/index">Beranda</a></li>
              <li class="breadcrumb-item active">Riwayat Peminjaman</li>
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
                {{-- mulai dari sini masukkan data table --}}
                <table id="datapeminjaman" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr style="text-align: center">
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Peminjam</th>
                    <th>Gedung</th>
                    <th>Awal Pinjam</th>
                    <th>Akhir Pinjam</th>
                    <th>Status</th>
                    {{-- <th>Lembaga</th> --}}
                    {{-- @if (Auth::user()->is_admin==1) --}}
                    <th>Aksi</th>
                    {{-- @endif --}}
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($peminjaman as $p)
                    <tr>
                    <td scope="row" style="text-align: center">{{$loop->iteration}}</td>
                    @php
                        $tanggal_pengajuan = date('d F Y ,  H:i', strtotime($p->created_at));
                        $awal_pinjam = date('d F Y ,  H:i', strtotime($p->awal_pinjam));
                        $akhir_pinjam = date('d F Y ,  H:i', strtotime($p->akhir_pinjam));
                    @endphp
                    <td style="text-align: center">{{ $tanggal_pengajuan }}</td>
                    <td style="text-align: center">{{ $p->user->name}}</td>
                    <td style="text-align: center">{{ $p->gedung->nama_gedung}}</td>
                    <td style="text-align: center">{{ $awal_pinjam }}</td>
                    <td style="text-align: center">{{ $akhir_pinjam }}</td>
                    <td style="text-align: center">
                        {{-- <span class="badge bg-{{$p->status===1 ? 'success' : ($p->status===0 ? 'danger' : 'warning')}}">
                            {{ $p->status===1 ? 'diterima' : ($p->status===0 ? 'ditolak' : 'diproses')}}
                        </span> --}}
                        <span class="badge
                            @if($p->status===1)bg-success
                                @elseif($p->status===0)bg-danger
                                @elseif($p->status===2)bg-primary
                                @elseif($p->status==null)bg-secondary
                            @endif
                            ">
                            @if($p->status===1)Diterima
                                @elseif($p->status===0)Ditolak
                                @elseif($p->status===2)Selesai
                                @elseif($p->status==null)Diproses
                            @endif
                        </span>
                    </td>
                    {{-- <td style="text-align: center">{{$p->nama_lembaga}}</td> --}}
                    {{-- <td style="text-align: center">{{ $p->nama_lembaga }}</td> --}}

                    <td style="text-align: center">
                        <form method="POST" action="/admin/peminjaman/{{$p->id}}">
                            @csrf
                            @method('delete')

                            <a href="/admin/lihatriwayat/{{ $p->id }}" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Peminjaman"
                                style="width: 40px"><i class="nav-icon fa fa-info"></i></a>
                            {{-- @if (Auth::user()->is_admin==1)
                            <a href="/admin/peminjaman/{{ $p->id }}/edit" class="btn btn-warning" style="width: 70px">Edit</a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Antum yakin menghapus data ?')">
                                Hapus
                            </button>
                            @endif --}}
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
        $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'), timePicker24Hour: true,
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                format: 'YY-MM-DD HH:mm:ss'
                }
        });

        @if (session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
                icon: 'success',
                title: '{{session('success')}}'
            })
        });
        @endif

        @if (session('status'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
                icon: 'warning',
                title: '{{session('status')}}'
            })
        });
        @endif

</script>
@endpush
