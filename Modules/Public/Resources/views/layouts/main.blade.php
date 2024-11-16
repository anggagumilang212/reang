<!doctype html>
<html>
{{-- @php
    $blog = Modules\Blog\Entities\Post::first();
@endphp --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title dan Meta Description untuk SEO -->
    <title>Reang Net | Solusi Internet Terbaik untuk Rumah & Bisnis</title>
    <meta name="description"
        content="Layanan wifi berkualitas tinggi untuk rumah, toko, dan cafe dengan harga terjangkau. Dapatkan koneksi internet cepat, stabil, dan customer service 24/7.">

    <!-- Meta tags untuk Social Media (Open Graph) -->
    <meta property="og:title" content="Reang Net | Solusi Internet Terbaik">
    <meta property="og:description"
        content="Layanan wifi berkualitas untuk rumah, toko & cafe. Koneksi cepat, harga terjangkau, support 24/7.">
    <meta property="og:image" content="https://reang.net/images/og-image.jpg">
    <meta property="og:url" content="https://reang.net">
    <meta property="og:type" content="website">

    {{-- Add OpenGraph Meta Tags for Rich Social Sharing --}}
    {{-- <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:description" content="{{ $blog->description }}" />
    <meta property="og:image" content="{{ $blog->getFirstMediaUrl('images') }}" />
    <meta property="og:url" content="{{ url('blog-detail', $blog->slug) }}" />
    <meta property="og:type" content="website" /> --}}

    <!-- Meta tags untuk Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Reang Net | Solusi Internet Terbaik">
    <meta name="twitter:description"
        content="Layanan wifi berkualitas untuk rumah, toko & cafe. Koneksi cepat, harga terjangkau.">
    <meta name="twitter:image" content="https://reang.net/images/apple-touch-icon.png">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">

    <!-- Additional SEO tags -->
    <meta name="keywords"
        content="wifi rumah, internet cafe, internet toko, layanan internet, wifi murah, internet cepat,Cctv,Pembuatan Website,Reang Net,Reang,Reang Komputer,Reang Internet">
    <meta name="author" content="Reang Net">
    <link rel="canonical" href="https://reang.net">

    <!-- Stylesheet links -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>

    {{-- live chat crisp --}}
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "3333a6f1-2487-42ab-ba78-c00fbb4e8d2c";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    {{-- fonts awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Optional: Tambahkan Sweet Alert untuk notifikasi yang lebih baik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- WhatsApp specific meta tags --}}
    <meta property="og:site_name" content="Your Site Name">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
</head>

<body class="bg-[#F1F4F5] font-['Poppins'] overflow-x-hidden">
    <nav class="navbar max-w-6xl mx-auto py-10 px-5 md:px-8 xl:px-0">
        <div class="flex flex-row items-center justify-between">
            <a href="/"> <img src="/images/logo-dark.png" class="h-[42px]" alt=""></a>
            <ul class=" flex-row gap-x-8 lg:flex hidden">
                <li><a href="/" class="text-indigo-950 hover:text-amber-300">Home</a></li>
                <li><a href="#product" class="text-indigo-950 hover:text-amber-300">Products</a></li>
                <li><a href="#service" class="text-indigo-950 hover:text-amber-300">Services</a></li>
                <li><a href="#pricing" class="text-indigo-950 hover:text-amber-300">Pricing</a></li>
                <li><a href="#testimoni" class="text-indigo-950 hover:text-amber-300">Testimonials</a></li>
                <li><a href="#blog" class="text-indigo-950 hover:text-amber-300">Blog</a></li>
            </ul>
            <div class="flex flex-row gap-x-4">
                {{-- <div class="bg-white flex items-center p-[10px] rounded-full">
                    <a href="#">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 7.67001V6.70001C8 4.45001 9.81 2.24001 12.06 2.03001C14.74 1.77001 17 3.88001 17 6.51001V7.89001"
                                stroke="#080C2E" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M9.50001 22H15.5C19.52 22 20.24 20.39 20.45 18.43L21.2 12.43C21.47 9.99 20.77 8 16.5 8H8.50001C4.23001 8 3.53001 9.99 3.80001 12.43L4.55001 18.43C4.76001 20.39 5.48001 22 9.50001 22Z"
                                stroke="#080C2E" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15.9955 12H16.0045" stroke="#080C2E" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8.99451 12H9.00349" stroke="#080C2E" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="19.5" cy="7" r="4" fill="#FF3232" />
                        </svg>

                    </a>

                </div> --}}
                <a href="/gate"
                    class="md:block hidden py-3 bg-gradient-to-r from-amber-400 to-amber-600 text-white text-base px-5 rounded-full hover:bg-violet-700 transition duration-500">
                    Sign In
                </a>
                <div id="btn-dropdown" class="lg:hidden bg-white flex items-center p-[10px] rounded-full">
                    <a href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 7H21" stroke="#080C2E" stroke-width="2" stroke-linecap="round" />
                            <path d="M3 12H21" stroke="#080C2E" stroke-width="2" stroke-linecap="round" />
                            <path d="M3 17H21" stroke="#080C2E" stroke-width="2" stroke-linecap="round" />
                        </svg>

                    </a>
                </div>

            </div>
        </div>
    </nav>
    <!-- mega menu floating dropdown -->
    <div id="dropdown-menu"
        class="megamenu absolute z-50 top-28 justify-center flex flex-col hidden px-5 lg:hidden md:px-10 w-full">
        <div class="flex flex-col bg-white p-5 md:p-8 rounded-2xl gap-y-5">
            <ul class="flex flex-col gap-y-5">
                <li><a href="/" class="text-indigo-950 hover:text-violet-700">Home</a></li>
                <li><a href="#product" class="text-indigo-950 hover:text-violet-700">Products</a></li>
                <li><a href="#service" class="tex  t-indigo-950 hover:text-violet-700">Services</a></li>
                <li><a href="#pricing" class="text-indigo-950 hover:text-violet-700">Pricing</a></li>
                <li><a href="#testimoni" class="text-indigo-950 hover:text-violet-700">Testimonials</a></li>
                <li><a href="#blog" class="text-indigo-950 hover:text-violet-700">Blog</a></li>
            </ul>
            <div class="justify-center flex">
                <a href="/gate"
                    class="md:hidden py-3  bg-gradient-to-r from-amber-400 to-amber-600  text-white text-base px-5 text-center w-40 text-center justify-center rounded-full">
                    Sign In
                </a>
            </div>
        </div>

    </div>
    <!-- end mega menu floating dropdown -->
    @yield('content')

    {{-- footer --}}
    <section class="max-w-6xl mx-auto ">
        <div
            class="promotion mx-4 md:mx-8 xl:mx-0 rounded-3xl bg-gradient-to-r from-amber-400 to-amber-600 mt-20 md:relative z-20  py-12 md:px-8 px-4 xl:px-10">
            <div class="grid lg:grid-cols-2 gap-x-8 gap-y-10 items-center">
                <div class="flex flex-col gap-y-10">
                    <div class="flex py-2 flex-row small-badge items-center bg-white rounded-full gap-x-2 px-3 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                            fill="none">
                            <path
                                d="M12.5 22.5C18.0228 22.5 22.5 18.0228 22.5 12.5C22.5 6.97715 18.0228 2.5 12.5 2.5C6.97715 2.5 2.5 6.97715 2.5 12.5C2.5 18.0228 6.97715 22.5 12.5 22.5Z"
                                stroke="#080C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.50001 3.5H9.50001C7.55001 9.34 7.55001 15.66 9.50001 21.5H8.50001"
                                stroke="#080C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5 3.5C17.45 9.34 17.45 15.66 15.5 21.5" stroke="#080C2E" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.5 16.5V15.5C9.34 17.45 15.66 17.45 21.5 15.5V16.5" stroke="#080C2E"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.5 9.50001C9.34 7.55001 15.66 7.55001 21.5 9.50001" stroke="#080C2E"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="lg:text-base text-sm font-semibold text-indigo-950">
                            Koneksi kuat, prestasi melonjak
                        </p>
                    </div>
                    <div>
                        <h3
                            class="leading-tight md:leading-lg text-[34px] lg:text-5xl text-white font-['Clash_Display'] font-bold mb-5">
                            Rumah pintar dimulai dari internet cerdas
                        </h3>
                        <p class="text-base leading-loose text-white">
                            Buka potensi rumah Anda dengan internet kami
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-x-5 items-center gap-y-5">
                        <a href="https://wa.me/6287828496000" target="_blank"
                            class="w-full sm:w-fit text-center transition-all ease-in-out duration-500 hover:text-white hover:bg-amber-500 bg-[#FFD15A] px-10 py-4 rounded-full text-indigo-950 text-lg font-semibold">
                            Pasang Sekarang
                        </a>
                        {{-- <a href="#" class="font-semibold text-white flex gap-x-2">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.5 12.2V13.9C20.5 17.05 18.7 18.4 16 18.4H7C4.3 18.4 2.5 17.05 2.5 13.9V8.5C2.5 5.35 4.3 4 7 4H9.7C9.57 4.38 9.5 4.8 9.5 5.25V9.15002C9.5 10.12 9.82 10.94 10.39 11.51C10.96 12.08 11.78 12.4 12.75 12.4V13.79C12.75 14.3 13.33 14.61 13.76 14.33L16.65 12.4H19.25C19.7 12.4 20.12 12.33 20.5 12.2Z"
                                    stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M22.5 5.25V9.15002C22.5 10.64 21.74 11.76 20.5 12.2C20.12 12.33 19.7 12.4 19.25 12.4H16.65L13.76 14.33C13.33 14.61 12.75 14.3 12.75 13.79V12.4C11.78 12.4 10.96 12.08 10.39 11.51C9.82 10.94 9.5 10.12 9.5 9.15002V5.25C9.5 4.8 9.57 4.38 9.7 4C10.14 2.76 11.26 2 12.75 2H19.25C21.2 2 22.5 3.3 22.5 5.25Z"
                                    stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.89999 22H15.1" stroke="white" stroke-width="2" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.5 18.3999V21.9999" stroke="white" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M18.9955 7.25H19.0045" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.1957 7.25H16.2047" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.3954 7.25H13.4044" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            Schedule a Demo
                        </a> --}}
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 sm:grid-cols-2 gap-x-5 gap-y-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.572898635295!2d108.31571437355608!3d-6.3330968619634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9599846003b%3A0x7ecc6be9c46f85de!2sReang%20Computer!5e1!3m2!1sid!2sid!4v1727404400717!5m2!1sid!2sid"
                        class="md:w-[500px] md:h-[400px] w-[300px] h-[300px] rounded-lg" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>
    </section>
    <section class="footer w-screen bg-amber-950 lg:-z-10 lg:-mt-[230px] lg:pt-[230px] h-fit">
        <div class="max-w-6xl mx-auto mt-[100px] px-5 py-10 lg:py-0 xl:px-0">
            <div class="grid lg:grid-cols-5 gap-x-10 gap-y-8 grid-cols-1 sm:grid-cols-2">
                <div class="lg:col-span-2 flex flex-col gap-y-8">
                    <img src="/images/logo-dark.png" alt="" class="w-fit h-[42px]">
                    <p class="text-base text-gray-400 leading-relaxed">
                        Buka potensi rumah Anda dengan internet kami
                    </p>
                    <div class="flex flex-row gap-x-4">
                        <div class="bg-white flex items-center p-[10px] rounded-full">
                            <a href="mailto:csreangnet@gmail.com">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z"
                                        stroke="#640EF1" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#640EF1"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>

                        </div>
                        <div class="bg-white flex items-center p-[10px] rounded-full">
                            <a href="https://reang.net/">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                        stroke="#640EF1" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8.00001 3H9.00001C7.05001 8.84 7.05001 15.16 9.00001 21H8.00001"
                                        stroke="#640EF1" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M15 3C16.95 8.84 16.95 15.16 15 21" stroke="#640EF1" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16" stroke="#640EF1"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001" stroke="#640EF1"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </a>

                        </div>
                        <div class="bg-white flex items-center p-[10px] rounded-full">
                            <a href="https://wa.me/6287828496000">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z"
                                        stroke="#640EF1" stroke-width="2" stroke-miterlimit="10" />
                                </svg>

                            </a>

                        </div>
                        {{-- <div class="bg-white flex items-center p-[10px] rounded-full">
                            <a href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15Z"
                                        stroke="#640EF1" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M2.51999 7.11011H21.48" stroke="#640EF1" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.51999 2.11011V6.97011" stroke="#640EF1" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.48 2.11011V6.52011" stroke="#640EF1" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M9.75 14.4501V13.2501C9.75 11.7101 10.84 11.0801 12.17 11.8501L13.21 12.4501L14.25 13.0501C15.58 13.8201 15.58 15.0801 14.25 15.8501L13.21 16.4501L12.17 17.0501C10.84 17.8201 9.75 17.1901 9.75 15.6501V14.4501V14.4501Z"
                                        stroke="#640EF1" stroke-width="2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </a>

                        </div> --}}
                    </div>
                </div>
                <div class="flex flex-col gap-y-8">
                    <h3 class="text-white font-semibold text-lg">
                        Services
                    </h3>
                    <ul class="gap-y-4 flex flex-col">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Internet Rumahan</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Foto Copy</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Printing</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Cetak Foto</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Membuat Undangan</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col gap-y-8">
                    <h3 class="text-white font-semibold text-lg">
                        Resources
                    </h3>
                    <ul class="gap-y-4 flex flex-col">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Support 24/7</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Help Center</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">How-to Instructions</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Blog & Tips</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">About Us</a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col gap-y-8">
                    <h3 class="text-white font-semibold text-lg">
                        Company
                    </h3>
                    <ul class="gap-y-4 flex flex-col">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Privacy and Policy</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Investor Relations</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Join With Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-violet-300">Our Statistics</a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="py-20 text-center text-base text-gray-400">
                All Rights Reserved • Copyright Weserve by <a href="#" class="hover:text-violet-300">
                    Reang.NET
                </a> 2024 in Indramayu
            </p>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btndropdown = document.getElementById('btn-dropdown');
            const dropdownmenu = document.getElementById('dropdown-menu');

            btndropdown.addEventListener("click", function() {
                dropdownmenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!btndropdown.contains(event.target) && !dropdownmenu.contains(event.target)) {
                    dropdownmenu.classList.add("hidden");
                }
            });

            const shaynakitAccordions = document.querySelectorAll('.shaynakit-accordion');

            shaynakitAccordions.forEach(function(shaynakitAccordion) {

                const btnAccordion = shaynakitAccordion.querySelector('.btn-accordion');
                const accordionContent = shaynakitAccordion.querySelector('.accordion-content');

                btnAccordion.addEventListener("click", function(event) {
                    event.preventDefault();
                    accordionContent.classList.toggle("hidden");
                });
            });
        });
    </script>

</body>

</html>
