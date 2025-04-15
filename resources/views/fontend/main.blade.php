<!DOCTYPE html>
<html lang="en">

<head>
    @include('fontend.head')

    <style>
    body {
        background-color: rgba(254, 251, 244);
    }

    .main-content {
        margin-top: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .carousel {
        width: 100%;
        max-width: 70%;
    }

    .carousel-item img {
        height: 350px;
    }

    .item-wrap {
        background: #ede0cc;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .image {
        width: 40%;
    }

    .button {
        background-color: #c5a25d;
        border: none;
        outline: none;
        color: #fff;
        padding: 10px;
        border-radius: 8px;
    }

    .content {
        width: 60%;
        padding: 0 30px;
    }

    .heading {
        font-weight: bold;
        font-size: 33px;
        line-height: 1.2;
    }

    .button {
        margin-top: 15px;
    }

    .desc {
        margin-top: 12px;
        font-size: 16px;
    }




    .carousel-control-prev,
    .carousel-control-next {
        display: flex;
        justify-content: center;
        align-self: center;
        position: absolute;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        background: #ccc;
    }

    .carousel-control-prev {
        left: -20px;
    }

    .carousel-control-next {
        right: -20px;
    }

    .section {
        position: relative;
        margin-top: 80px;

    }

    .has-scrollbar {
        display: flex;
    }

    .img-holder {
        aspect-ratio: var(--width)/ var(--height);
        background-color: #fff;
    }

    .img-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge {
        max-width: max-content;
        background-color: rgb(88, 143, 92);
        color: var(--white);
        font-weight: var(--fw-700);
        padding-inline: 12px;
        border-radius: var(--radius-3);
    }

    /* Shop */
    .shop .title-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        margin-block-end: 50px;
    }

    .shop .btn-link:is(:hover, :focus) {
        color: var(--hoockers-green);
    }

    .shop-card .card-banner {
        position: relative;
        overflow: hidden;
    }

    .shop-card .badge {
        position: absolute;
        top: 20px;
        left: 20px;
    }

    .card-content .card-actions {
        position: absolute;
        bottom: 0;
        right: 0;
        transform: translate(0, -50%);
        display: grid;
        gap: 10px;
        transition: var(--transition-2);
    }

    .card-content .action-btn {
        background-color: #fff;
        font-size: 24px;
        padding: 12px;
        border-radius: 50%;
        transition: var(--transition-1);
    }

    .card-content .action-btn:is(:hover, :focus) {
        background-color: black;
        color: while;
    }
    </style>
</head>

<body>
    <!--class="animsition" -->

    <!-- Header -->
    @include('fontend.header')

    <!-- Cart -->

    <main class="main-content">
        @yield('fontend-content')
    </main>

    @include('fontend.footer')

</body>

</html>