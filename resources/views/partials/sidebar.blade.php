<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/admin">SISPAM</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/admin">SP</a>
        </div>
        @if (auth()->user()->role === 'Admin')
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li><a class="nav-link" href="/admin"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

                <li class="menu-header">Master</li>
                <li class="{{ !empty($nav_title) && $nav_title == 'harga' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/harga"><i class="fas fa-wallet"></i> <span>Harga</span></a></li>
                <li class="{{ !empty($nav_title) && $nav_title == 'pemakaian' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/pemakaian"><i class="fas fa-clipboard-list"></i> <span>Pemakaian</span></a></li>
                <li class="{{ !empty($nav_title) && $nav_title == 'transaksi' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/transaksi"><i class="fas fa-clipboard-list"></i> <span>Transaksi</span></a></li>

                <li class="menu-header">Data</li>
                {{-- <li class="{{ !empty($nav_title) && $nav_title == 'mesin' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/mesin"><i class="fas fa-address-card"></i> <span>Mesin</span></a></li> --}}
                <li class="{{ !empty($nav_title) && $nav_title == 'petugas' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/petugas"><i class="fas fa-address-card"></i> <span>Petugas</span></a></li>
                <li class="{{ !empty($nav_title) && $nav_title == 'pelanggan' ? 'active' : '' }}"><a class="nav-link"
                        href="/admin/pelanggan"><i class="fas fa-address-book"></i> <span>Pelanggan</span></a></li>
            </ul>
        @else
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="{{ !empty($nav_title) && $nav_title == 'dashboard' ? 'active' : '' }}"><a class="nav-link"
                        href="/petugas"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

                <li class="menu-header">Master</li>
                <li class="{{ !empty($nav_title) && $nav_title == 'transaksi' ? 'active' : '' }}"><a class="nav-link"
                        href="/petugas/transaksi"><i class="fas fa-clipboard-list"></i> <span>Transaksi</span></a></li>

                <li class="menu-header">Data</li>
                <li class="{{ !empty($nav_title) && $nav_title == 'pelanggan' ? 'active' : '' }}"><a class="nav-link"
                        href="/petugas/pelanggan"><i class="fas fa-address-book"></i> <span>Pelanggan</span></a></li>
            </ul>
        @endif

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="/admin" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
