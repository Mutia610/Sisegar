<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <p>Dashboard</p>
            </a>
        </li> 

        @if(Auth::user()->level == "admin")
        
        <li class="nav-header">PESANAN</li> 
            <li class="nav-item">
                <a href="{{ route('pesananMasukAdmin') }}" class="nav-link">
                <i class="fa fa-cart-arrow-down nav-icon"></i>
                <p>Konfirmasi Pesanan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link">
                <i class="fas fa-star nav-icon"></i>
                <p>Pesanan Selesai</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pesananDibatalkanAdmin') }}" class="nav-link">
                <i class="fas fa-times nav-icon"></i>
                <p>Pesanan Dibatalkan</p>
                </a>
            </li>

            <li class="nav-header">DATA MASTER</li> 
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                    <i class="fas fa-cart-arrow-down nav-icon"></i>
                    <p>Kategori</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('unit.index') }}" class="nav-link">
                    <i class="fas fa-balance-scale nav-icon"></i>
                    <p>Satuan</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('slider.index') }}" class="nav-link">
                    <i class="fas fa-puzzle-piece nav-icon"></i>
                    <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('city.index') }}" class="nav-link">
                    <i class="fas fa-map nav-icon"></i>
                    <p>Kota</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.index') }}" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-street-view nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
        
            <li class="nav-header">KEUANGAN</li> 
            <li class="nav-item">
                <a href="{{ route('indexBiayaAdmin') }}" class="nav-link">
                <i class="fa fa-percent nav-icon"></i>
                <p>Biaya Administrasi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bank_account.index') }}" class="nav-link">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>Rekening</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('shop_payment.index') }}" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Pembayaran Toko</p>
                </a>
            </li>

        <!-- <li class="nav-item">
            <a href="{{ route('statusOrder.index') }}" class="nav-link">
            <i class="fas fa-bookmark nav-icon"></i>
            <p>Status Pesanan</p>
            </a>
        </li>  -->
        
        @endif
        

        @if(Auth::user()->level == "seller")
        <!-- <li class="nav-header">DASHBOARD</li> 
        <li class="nav-item">
            <a href="{{ route('homeSeller') }}" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <p>Dashboard</p>
            </a>
        </li>  -->

        <li class="nav-header">PRODUCT</li> 
        <li class="nav-item">
            <a href="{{ route('item.index') }}" class="nav-link">
            <i class="fa fa-list-alt nav-icon"></i>
            <p>Data Produk</p>
            </a>
        </li>

        <li class="nav-header">PESANAN</li>
        <li class="nav-item">
            <a href="{{ route('pesananMasuk') }}" class="nav-link">
            <i class="fa fa-cart-arrow-down nav-icon"></i>
            <p>Pesanan Masuk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pesananDikirim') }}" class="nav-link">
            <i class="fas fa-truck nav-icon"></i>
            <p>Pesanan Dikirim</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pesananDiterima') }}" class="nav-link">
            <i class="fas fa-gift nav-icon"></i>
            <p>Pesanan Diterima</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pesananDibatalkan') }}" class="nav-link">
            <i class="fas fa-times nav-icon"></i>
            <p>Pesanan Dibatalkan</p>
            </a>
        </li>

        <li class="nav-header">Pengiriman</li>
        <li class="nav-item">
            <a href="{{ route('shipping.index') }}" class="nav-link">
            <i class="fas fa-car nav-icon"></i>
            <p>Kurir</p>
            </a>
        </li>

        <li class="nav-header">KEUANGAN</li>
        <li class="nav-item">
            <a href="{{ route('bank_account.index') }}" class="nav-link">
            <i class="fa fa-credit-card nav-icon"></i>
            <p>Rekening</p>
            </a>
        </li>

        <li class="nav-item">
                <a href="{{ route('indexPenjual') }}" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Laporan Transfer</p>
                </a>
            </li>
        </li>

        <!-- <li class="nav-header">KEUANGAN</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-star nav-icon"></i>
            <p>Penghasilan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <p>Laporan Penjualan</p>
            </a>
        </li> -->
        @endif

        <br />
    </ul>
</nav>