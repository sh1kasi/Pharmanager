<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link">
        <span class="brand-text font-weight-light">PharManager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('index') }}"
                        class="nav-link {{ Route::currentRouteName() === "index" ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <button class=" btn nav-link d-flex align-items-center shadow-none">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </button>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}"
                                class="nav-link {{ Route::currentRouteName() === "customer.index" ? 'active' : '' }}">
                                <i class="far fa-user nav-icon"></i>
                                <p>Kustomer</p>
                            </a>
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ Route::currentRouteName() === "category.index" ? 'active' : '' }}">
                                <i class="far fa-credit-card nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ Route::currentRouteName() === "product.index" ? 'active' : '' }}">
                                <i class="far fa-shopping-basket nav-icon"></i>
                                <p>Produk</p>
                            </a>
                            <a href="{{ route('supplier.index') }}"
                                class="nav-link {{ Route::currentRouteName() === "supplier.index" ? 'active' : '' }}">
                                <i class="far fa-shopping nav-icon"></i>
                                <p>Supplier</p>
                            </a>

                        </li>

                    </ul>
                </li>
                <li class="nav-item menu-pen">
                    <button class=" btn nav-link d-flex align-items-center shadow-none">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </button>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cashier.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Kasir</p>
                            </a>
                            <a href="{{ route('order.log.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>Log Transaksi</p>
                            </a>
                            <a href="{{ route('penjualan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Rekap Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
