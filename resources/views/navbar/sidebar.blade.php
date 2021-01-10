  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('gambar/logo uin.png')}}" alt="Logo" class="brand-image" >
      <span class="brand-text font-weight-light">Peminjaman Gedung</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @if (Auth::user()->is_admin==1)
                <a href="{{route('admin.index')}}" class="d-block">{{$users = Auth::user()->name}}</a>
            @else
                <a href="{{route('user.index')}}" class="d-block">{{$users = Auth::user()->name}}</a>
            @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (Auth::user()->is_admin==1)
          <li class="nav-item">
            <a href="/admin/peminjaman" class="nav-link {{ strpos(request()->url(),'/admin/peminjaman') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Data Peminjaman</p>
            </a>
          </li>
          @endif

          @if (Auth::user()->is_admin==1)
          <li class="nav-item">
            <a href="/admin/gedung" class="nav-link {{ strpos(request()->url(),'/admin/gedung') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Data Gedung</p>
            </a>
          </li>
          @endif
          {{-- <li class="nav-item">
            <a href="/admin/lembaga" class="nav-link {{ strpos(request()->url(),'/admin/lembaga') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Data Lembaga</p>
            </a>
          </li> --}}
          @if (Auth::user()->is_admin==1)
          <li class="nav-item">
            <a href="/admin/riwayatpeminjaman" class="nav-link {{ strpos(request()->url(),'/admin/riwayatpeminjaman') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Riwayat Peminjaman</p>
            </a>
          </li>
          @endif

        {{-- MENU USER --}}
        {{-- @if (Auth::user()->is_admin==0)
        <li class="nav-item">
            <a href="/user/index" class="nav-link {{ strpos(request()->url(),'index') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Profil</p>
            </a>
          </li>
          @endif --}}
          @if (Auth::user()->is_admin==0)
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Cek Jadwal</p>
            </a>
          </li>
          @endif

          @if (Auth::user()->is_admin==0)
          <li class="nav-item">
            <a href="{{url('/user/peminjaman/create')}}" class="nav-link {{ request()->url() == "http://localhost:8000/user/peminjaman/create" ? "active" : "" }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Ajukan Peminjaman</p>
            </a>
          </li>
          @endif

          @if (Auth::user()->is_admin==0)
          <li class="nav-item">
            <a href="/user/peminjaman" class="nav-link {{ request()->url() == "http://localhost:8000/user/peminjaman" ? "active" : "" }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Data Peminjaman</p>
            </a>
          </li>
          @endif

          {{-- @if (Auth::user()->is_admin==0)
          <li class="nav-item">
            <a href="/admin/peminjaman" class="nav-link {{ strpos(request()->url(),'/admin/peminjaman') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Data Peminjaman</p>
            </a>
          </li>
          @endif --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
