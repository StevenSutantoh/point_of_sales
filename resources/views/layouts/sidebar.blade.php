<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="header">MAIN MENU</li>
        <li>
            <a href="{{ route('admin.kategori') }}">
                <i class="fa fa-cube"></i> <span>Kategori</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.barang') }}">
                <i class="fa fa-cubes"></i> <span>Barang</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.supplier') }}">
                <i class="fa fa-truck"></i> <span>Supplier</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.customer') }}">
                <i class="fa fa-id-card"></i> <span>Customer</span>
            </a>
        </li>
        <li class="header">TRANSAKSI</li>
        <li>
            <a href="{{ route('admin.pengeluaran') }}">
                <i class="fa fa-money"></i> <span>Pengeluaran</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-download"></i> <span>Pembelian</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-upload"></i> <span>Penjualan</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-retweet"></i> <span>Retur Pembelian</span>
            </a>
        </li><li>
            <a href="#">
                <i class="fa fa-exchange"></i> <span>Retur Penjualan</span>
            </a>
        </li>
        <li class="header">REPORT</li>
        <li>
            <a href="#">
                <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
            </a>
        </li>
        <li class="header">SYSTEM</li>
        <li>
            <a href="{{ route('admin.user') }}" class="nav-link">
                <i class="fa fa-user"></i> <span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.settings')}}">
                <i class="fa fa-cog"></i><span>Pengaturan</span>
            </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>