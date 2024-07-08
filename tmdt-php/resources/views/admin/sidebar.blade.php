  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Trang Quản Trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/template/admin/dist/img/avata2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> Quản Lý Cửa Hàng</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
            <a href="#" class="nav-link">
             
              <i class="nav-icon fas fa-store"></i>
              <p>
                Thống Kê
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/main" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thống Kê Cửa Hàng</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
             
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Danh Mục
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/menus/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Danh Mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/menus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Danh Mục</p>
                </a>
              </li>
            </ul>
          </li>

 
          {{-- sản phẩm --}}
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Sản Phẩm </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sản Phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Slider --}}
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-images"></i>
              <p>
                Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/sliders/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Slider </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sliders/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Slider</p>
                </a>
              </li>
            </ul>
          </li> 
          {{-- Cart --}}
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Giỏ Hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/customers" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Đơn Hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/customers/status" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Xử Lý Đơn Hàng</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Khuyến mại --}}
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Khuyến mại
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.promotions.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm khuyến mại</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.promotions.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách khuyến mại</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Liên Hệ --}}
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Liên Hệ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/contacts" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Liên Hệ</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Khách Hàng --}}
                      <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Khách hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Khách Hàng</p>
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
