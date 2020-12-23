<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ECOMMORCE SHIRT</div>
    </a>
    <li class="nav-item">
        <a class="nav-link" href="admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a class="nav-link" href="order">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Orders</span>
        </a>
        <a class="nav-link" href="customer">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Customers</span>
        </a>
<!--        <a class="nav-link" href="brand">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Brands</span>
        </a>-->
        <a class="nav-link" href="category">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Category</span>
        </a>
        <a class="nav-link" href="product">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Products</span>
        </a>
        <a class="nav-link" href="size">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sizes</span>
        </a>
        <a class="nav-link" href="colors">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Colors</span>
        </a>
        <a class="nav-link" href="banner">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Banners</span>
        </a>
        <?php
            if( $this->session->has_userdata('adminid') ) {
                ?>
        <span class="nav-link logout" data-href="../admin/auth/logout" style="cursor: pointer">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>LOGOUT</span>
        </span>
                <?php
            }
        ?>
    </li>
</ul>
