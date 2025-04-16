<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/admin/dashboard">
            <span class="align-middle">AdminCocoon</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header" style="font-size: 20px;">
                Quản lý cửa hàng
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-expanded="false" aria-controls="menu">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Danh mục sản phẩm
                    </span>
                </a>
                <ul id="menu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/menu/list" class="sidebar-link">Danh sách danh mục</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/menu/add" class="sidebar-link">Thêm danh mục</a>
                    </li>
                </ul>

            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#product" aria-expanded="false" aria-controls="product">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Sản phẩm
                    </span>
                </a>
                <ul id="product" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="\admin\product\list" class="sidebar-link">Danh sách sản phẩm</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="\admin\product\soldout" class="sidebar-link">Danh sách sản phẩm sắp hết</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="\admin\product\add" class="sidebar-link">Thêm sản phẩm</a>
                    </li>
                </ul>

            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#order" aria-expanded="false" aria-controls="order">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Đơn hàng
                    </span>
                </a>
                <ul id="order" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/order/list" class="sidebar-link">Danh sách đơn hàng</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/return/order" class="sidebar-link">Đơn hàng đổi trả</a>
                    </li>

                </ul>
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#discount" aria-expanded="false" aria-controls="discount">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Mã giảm giá
                    </span>
                </a>
                <ul id="discount" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/discount/list" class="sidebar-link">Danh sách mã giảm</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/discount/add" class="sidebar-link">Thêm mã giảm</a>
                    </li>

                </ul>
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#slide" aria-expanded="false" aria-controls="slide">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Mẫu quảng cáo
                    </span>
                </a>
                <ul id="slide" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/slide/list" class="sidebar-link">Danh sách mẫu quảng cáo</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/slide/add" class="sidebar-link">Thêm mẫu</a>
                    </li>
                </ul>

            </li>
        </ul>

        <ul class="sidebar-nav">
            <li class="sidebar-header" style="font-size: 20px;">
                Quản lý người dùng
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link has-dropdown collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#user"
                    aria-expanded="false" aria-controls="user">
                    <i class=" align-middle" data-feather="sliders"></i>
                    <span class="align-middle">
                        Hồ sơ người dùng
                    </span>
                </a>
                <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/admin/user/list" class="sidebar-link">Danh sách khách hàng</a>
                    </li>

                </ul>



            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li>
        </ul>
        <div class="sidebar--footer">
            <a href="{{route('admin.logout')}}" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span style="font-size: 20px;">Đăng xuất</span>
            </a>
        </div>


    </div>
</nav>