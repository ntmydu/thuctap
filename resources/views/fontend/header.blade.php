<header class="header">

    <div class="alert">
        <div class="container">
            <p class="alert-text">Miễn phí giao hàng toàn quốc với hóa đơn từ 99.000 +</p>
        </div>
    </div>

    <!-- Header desktop -->
    <div>

        <div style="background-color: rgba(254, 251, 244);  " class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <div class="dropdown">
                                <div class="dropdown-btn">
                                    Sản phẩm <span class="dropdown-arrrow"> </span>
                                </div>
                                <ul class="dropdown-menu">
                                    @foreach($menus as $menu)
                                    @if($menu->parent_id == 0)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{route('product.list', $menu->id)}}">{{$menu->name}}
                                            <span class="arrow"> &raquo;</span>
                                        </a>

                                        @if($menus->contains('parent_id', $menu->id))
                                        <!-- Kiểm tra xem có mục nào có parent_id bằng id của menu này không -->
                                        <ul class="dropdown-menu dropdown-submenu">
                                            @foreach($menus as $submenu)
                                            <!-- Lặp qua lại để tìm các sub-menu -->
                                            @if($submenu->parent_id === $menu->id)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{route('product.list', $submenu->id)}}">{{$submenu->name}}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">Bài viết</a>
                        </li>
                        <li>
                            <a href="#">Liên Hệ</a>
                        </li>
                    </ul>
                </div>
                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="{{asset('images/logo.svg')}}" alt="IMG-LOGO">
                </a>


                <div class="header-actions">
                    <?php
                    $totalQuantity = 0;
                    ?>
                    @if(session('cart'))
                    @foreach(session('cart') as $item)
                    <?php
                    $totalQuantity += $item['quantity'];
                    ?>
                    @endforeach
                    @endif
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <form action="{{route('search')}}">
                            @csrf
                            <div style="width:50px; display: flex; align-items: center; gap:10px; flex-direction:row-reverse;"
                                class="search">
                                <div style="width:50px;justify-items: center;"
                                    class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                                    <i style="align-items: center;" class=" zmdi zmdi-search"></i>
                                </div>
                                <input type="text" name="searchInput" class="search_input" id="searchInput"
                                    placeholder="Nhập từ khóa..." style="display: none;" onchange="this.form.submit()">
                            </div>
                        </form>


                        <div class=" icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="{{$totalQuantity}}">
                            <a href="{{ route('cart.index') }}">
                                <i class="zmdi zmdi-shopping-cart" style="color: #000"></i>

                            </a>

                        </div>
                        <div class="dropdown profile">
                            <div class="dropdowm-btn" onclick="handleShowDropdownProfile()" id="dropdown-btn">
                                <button class="header-action-btn" aria-label="favourite item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 20px">
                                        <path
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                                    </svg>
                                    <span class="dropdown-arrrow"></span>
                                </button>

                            </div>

                            <ul class="dropdowm-menu__profile" id="dropdown-info">
                                @if(Auth::check())
                                <li><a style="color: #000;" href="/user/profile" class="dropdowm-item">Thông tin tài
                                        khoản</a></li>
                                <li style="color: #000;"><a style="color: #000;" href="{{route('logout')}}"
                                        class="dropdowm-item">Đăng
                                        xuất</a></li>
                                @else
                                <li style="color: #000;"><a style="color: #000;" href="{{route('view.login')}}"
                                        class="dropdowm-item">Đăng
                                        nhập</a></li>
                                @endif
                            </ul>
                        </div>
                        <div style="align-items: center;" class="credit-cart">
                            <a href="{{route('order.management')}}">
                                <svg style="margin: 10px; margin-top: 13px;" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512">
                                    <path
                                        d="M512 80c8.8 0 16 7.2 16 16l0 32L48 128l0-32c0-8.8 7.2-16 16-16l448 0zm16 144l0 192c0 8.8-7.2 16-16 16L64 432c-8.8 0-16-7.2-16-16l0-192 480 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24l48 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-48 0zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-112 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="{{asset('images/logo.svg')}}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu"><a href="/">Trang Chủ</a> </li>
            <li>
                <a href="contact.html">Liên Hệ</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>


<script>
    const dropdownMenu = document.querySelector(".dropdown-menu")
    const dropdownArrow = document.querySelector('.dropdown-arrrow')
    const dropdown = document.querySelector('.dropdown').addEventListener('click', (e) => {
        if (dropdownMenu.style.display == 'block') {
            dropdownMenu.style.display = 'none'
            dropdownArrow.style.rotate = '90deg'
        } else {
            dropdownMenu.style.display = 'block'
            dropdownArrow.style.rotate = '-90deg'
        }
    })
</script>
<script>
    document.querySelector('.js-show-modal-search').addEventListener('click', function() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput.style.display === 'block') {
            searchInput.style.display = 'none';
        } else {
            searchInput.style.display = 'block';
            searchInput.focus();
        }
    });
</script>

<script>
    const dropdownBtnElement = document.getElementById('dropdown-btn')
    const dropdownInfoElement = document.getElementById('dropdown-info')

    dropdownBtnElement.addEventListener('click', () => {
        if (dropdownInfoElement.style.display === 'flex') {
            dropdownInfoElement.style.display = 'none'
        } else {
            dropdownInfoElement.style.display = 'flex'
        }
    })
</script>