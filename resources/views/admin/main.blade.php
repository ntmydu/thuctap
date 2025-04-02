@include('admin.header')

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            @include('admin.navbar')
            <main class="content">
                @include('admin.alert')
                @yield('content')
            </main>
            @include('admin.footer')
        </div>
    </div>
</body>