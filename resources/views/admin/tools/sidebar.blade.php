<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('administrator') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('program.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Program
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('gallery.index') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('event.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Event
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('artikel.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Artikel
              </p>
            </a>
          </li>
          <li class="nav-header">Laporan</li>
          <li class="nav-item">
            <a href="{{ route('laporan.transaksi') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Laporan Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('laporan.user')}}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Laporan User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('laporan.program')}}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Laporan Program
              </p>
            </a>
          </li>
          <li class="nav-header">Pengaturan</li>
          <li class="nav-item">
            <a href="{{route('profiladmin.index')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('adminlogout')}}" class="nav-link">
                <span class=""></span>
              <i class="nav-icon far fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
