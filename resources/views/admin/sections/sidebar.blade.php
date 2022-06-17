<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">WebProg.ir</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span> داشبورد </span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    فروشگاه
  </div>

  <!-- Nav Item - Brands -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.brands.index') }}">
      <i class="fas fa-store"></i>
      <span> برندها </span>
    </a>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-cart-plus"></i>
      <span> محصولات </span>
    </a>
    <div id="collapseProducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.products.index')}}">محصولات</a>
        <a class="collapse-item" href="{{ route('admin.categories.index')}}">دسته بندی ها</a>
        <a class="collapse-item" href="{{ route('admin.attributes.index')}}">خصوصیت ها</a>
        <a class="collapse-item" href="{{ route('admin.tags.index')}}">تگ ها</a>
        <a class="collapse-item" href="{{ route('admin.comments.index')}}"> کامنت ها</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    سفارشات
  </div>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span> سفارشات </span>
    </a>
    <div id="collapseOrders" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.orders.index')}}"> سفارشات</a>
        <a class="collapse-item" href="{{ route('admin.transactions.index')}}"> تراکنش ها</a>
        <a class="collapse-item" href="{{ route('admin.coupons.index')}}">کوپن ها</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    بنر ها
  </div>

    <!-- Nav Item - Banners -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('admin.banners.index')}}">
        <i class="fas fa-fw fa-image"></i>
        <span> بنر ها </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>