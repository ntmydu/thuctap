<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <!-- Thông báo -->
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <svg style="width: 25px; height: 30px; color:black; fill: #000;"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
                        </svg>
                        @if($newOrders + $newOrdReturn > 0)
                        <span style="background-color:rgb(230, 12, 12) ;"
                            class="indicator">{{ $newOrders +  $newOrdReturn }}</span>
                        @else
                        <span style="background-color: #0c97e6 ;" class="indicator">0</span>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        {{ $newOrders +  $newOrdReturn }} Thông báo mới
                    </div>
                    <div class="list-group">
                        <!-- Đơn hàng mới -->
                        @if($newOrders > 0)
                        <a href="" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-success" data-feather="shopping-cart"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Đơn hàng mới</div>
                                    <div class="text-muted small mt-1">{{$newOrders}} đơn hàng mới</div>
                                    <div class="text-muted small mt-1">Vừa cập nhật</div>
                                </div>
                            </div>
                        </a>
                        @endif

                        <!-- Đơn hàng hoàn trả -->
                        @if($newOrdReturn > 0)
                        <a href="" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="rotate-ccw"></i>
                                </div>
                                <div class="col-10">
                                    <div style="width: 200px;" class="text-dark">Đơn hàng hoàn trả</div>
                                    <div class="text-muted small mt-1">{{$newOrdReturn}} yêu cầu hoàn trả</div>
                                    <div class="text-muted small mt-1">Vừa cập nhật</div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>

                </div>
            </li>

            <!-- Tài khoản -->
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <svg style="width: 25px; height: 30px; color:black; fill: #000;" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" style="width: 20px">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href=""><i class="align-middle me-1" data-feather="user"></i> Hồ sơ</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Cài
                        đặt</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="align-middle me-1"
                            data-feather="log-out"></i> Đăng
                        xuất</a>
                </div>
            </li>
        </ul>
    </div>
</nav>