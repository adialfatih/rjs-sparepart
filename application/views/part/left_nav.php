<!-- Header -->
    <header>
        <div class="logo">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span class="material-icons">menu</span>
            </button>
            <span class="material-icons logo-icon">warehouse</span>
            <h1>Warehouse RJS</h1>
        </div>
        <div class="header-actions">
            <button class="theme-toggle" id="themeToggle">
                <span class="material-icons">brightness_4</span>
            </button>
            <!-- <div class="user-profile">
                <div class="user-avatar">AD</div>
                <span class="material-icons">arrow_drop_down</span>
            </div> -->
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li class="menu-title">Main</li>
                <li class="menu-item">
                    <a href="<?=base_url('dashboard');?>" class="menu-link <?=$navigasi=='dashboard' ? 'active':'';?>">
                        <span class="material-icons menu-icon">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-title">Management</li>
                <li class="menu-item">
                    <div class="menu-link">
                        <span class="material-icons menu-icon">inventory_2</span>
                        <span>Sparepart</span>
                        <span class="material-icons submenu-arrow">chevron_right</span>
                    </div>
                    <ul class="submenu <?=$navigasi=='sparepart' ? 'show':'';?>">
                        <li class="menu-item">
                            <a href="<?=base_url('sparepart/pembelian');?>" class="menu-link <?=$navigasi2=='pembelian' ? 'active':'';?>">Pembelian</a>
                        </li>
                        <li class="menu-item">
                            <a href="<?=base_url('tarik/ke/spinning');?>" class="menu-link <?=$navigasi2=='tariksp' ? 'active':'';?><?=$navigasi2=='rtariksp' ? 'active':'';?>">Tarik Ke Spinning</a>
                        </li>
                        <li class="menu-item">
                            <a href="<?=base_url('tarik/ke/weaving');?>" class="menu-link <?=$navigasi2=='tarikwv' ? 'active':'';?><?=$navigasi2=='rtarikwv' ? 'active':'';?>">Tarik Ke Weaving</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <div class="menu-link">
                        <span class="material-icons menu-icon">warehouse</span>
                        <span>Gudang</span>
                        <span class="material-icons submenu-arrow">chevron_right</span>
                    </div>
                    <ul class="submenu <?=$navigasi=='gudang' ? 'show':'';?>">
                        <li class="menu-item">
                            <a href="<?=base_url('gudang/stok/spinning');?>" class="menu-link <?=$navigasi2=='stoksp' ? 'active':'';?>">Gudang Spinning</a>
                        </li>
                        <li class="menu-item">
                            <a href="<?=base_url('gudang/stok/weaving');?>" class="menu-link <?=$navigasi2=='stokwv' ? 'active':'';?>">Gudang Weaving</a>
                        </li>
                        
                    </ul>
                </li>
                
                <li class="menu-item">
                    <a href="<?=base_url('pemakaian-sparepart');?>" class="menu-link">
                        <span class="material-icons menu-icon">receipt_long</span>
                        <span>Pemakaian</span>
                    </a>
                </li>
                <li class="menu-item">
                    <div class="menu-link">
                        <span class="material-icons menu-icon">assessment</span>
                        <span>Laporan</span>
                        <span class="material-icons submenu-arrow">chevron_right</span>
                    </div>
                    <ul class="submenu">
                        <li class="menu-item">
                            <a href="#" class="menu-link">Laporan Bulanan</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">Laporan Tahunan</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">Laporan Sparepart</a>
                        </li>
                    </ul>
                </li>
                
                <li class="menu-title">System</li>
                <li class="menu-item">
                    <a href="<?=base_url('user-login');?>" class="menu-link <?=$navigasi=='user-login' ? 'active':'';?>">
                        <span class="material-icons menu-icon">people</span>
                        <span>Pengguna</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link ">
                        <span class="material-icons menu-icon">settings</span>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link" id="idLogout">
                        <span class="material-icons menu-icon">logout</span>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
        </nav>