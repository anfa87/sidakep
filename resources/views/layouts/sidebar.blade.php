<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">SIDAKEP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

   

    @can('admin')

    <!-- Divider -->
    <hr class="sidebar-divider">

         <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

   

    <li class="nav-item {{ Request::is('pegawai*') ? 'active' : '' }}">
        <a class="nav-link" href="/pegawai/data-pegawai/">
            <i class="fas fa-fw fa-id-card"></i>
          <span>Data Pegawai</span>
        </a>
       
      </li>
    
    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('jabatan*') ? 'active' : '' }}">
        <a class="nav-link" href="/jabatan">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Data Jabatan</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('gaji*') ? 'active' : '' }}">
        <a class="nav-link" href="/gaji">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Gaji</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="/users">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>

    @endcan

   
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('profil*') ? 'active' : '' }}">
        <a class="nav-link" href="/profil/{{ Auth::user()->pegawai->kd_pegawai }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('pendidikan*') ? 'active' : '' }}">
        <a class="nav-link" href="/pendidikan">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Riwayat Pendidikan</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ Request::is('kegiatan*') ? 'active' : '' }}">
        <a class="nav-link" href="/kegiatan">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Kegiatan</span></a>
    </li>

    
   

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    

</ul>