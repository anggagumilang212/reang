@extends('public::layouts.main')
@section('content')
<style>
    .swiper-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet,
    .swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {
        width: 16px !important;
        height: 4px !important;
        border-radius: 5px !important;
        margin: 0 6px !important;
    }

    .swiper-pagination {
        bottom: 2px !important;
    }

    .swiper-wrapper {
        height: max-content !important;
        width: max-content !important;
        padding-bottom: 64px;
    }

    .swiper-pagination-bullet-active {
        background: #4F46E5 !important;
    }

    .swiper-slide.swiper-slide-active>.slide_active\:border-indigo-600 {
        --tw-border-opacity: 1;
        border-color: rgb(79 70 229 / var(--tw-border-opacity));
    }

    .swiper-slide.swiper-slide-active>.group .slide_active\:text-gray-800 {
        ---tw-text-opacity: 1;
        color: rgb(31 41 55 / var(--tw-text-opacity));
    }
</style>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<section class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 ">
            <span class="text-sm text-gray-500 font-medium text-center block mb-2">TESTIMONIAL</span>
            <h2 class="text-4xl text-center font-bold text-gray-900 ">What our happy user says!</h2>
        </div>
        <!--Slider wrapper-->

        <div class="swiper mySwiper">
            <div class="swiper-wrapper w-max">
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-indigo-600 hover:shadow-sm slide_active:border-indigo-600">
                        <div class="">
                            <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-base font-semibold text-indigo-600">4.9</span>
                            </div>
                            <p
                                class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                                Pagedone has made it possible for me to stay on top of my portfolio and make
                                informed
                                decisions
                                quickly and easily.
                            </p>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5">
                            <img class="rounded-full h-10 w-10 object-cover" src="https://pagedone.io/asset/uploads/1696229969.png"
                                alt="avatar" />
                            <div class="block">
                                <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">Jane D</h5>
                                <span class="text-sm leading-4 text-gray-500">CEO </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 flex justify-between flex-col rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-indigo-600 slide_active:border-indigo-600 hover:shadow-sm">
                        <div class="">
                            <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-base font-semibold text-indigo-600">4.9</span>
                            </div>
                            <p
                                class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                                Thanks to pagedone, I feel more informed and confident about my investment decisions
                                than
                                ever
                                before.
                            </p>
                        </div>
                        <div class="flex items-center gap-5 pt-5 border-t border-solid border-gray-200">
                            <img class="rounded-full h-10 w-10 object-cover" src="https://pagedone.io/asset/uploads/1696229994.png"
                                alt="avatar" />
                            <div class="block">
                                <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">Harsh P.
                                </h5>
                                <span class="text-sm leading-4 text-gray-500">Product Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class=" flex justify-between flex-col lg:w-full group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto slide_active:border-indigo-600 hover:border-indigo-600 hover:shadow-sm">
                        <div class="">
                            <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-base font-semibold text-indigo-600">4.9</span>
                            </div>
                            <p
                                class="text-base text-gray-600 leading-6  transition-all duration-500  pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                                The customer service team at pagedone went above and beyond to help me resolve a
                                billing
                                issue.
                            </p>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5">
                            <img class="rounded-full h-10 w-10 object-cover" src="	https://pagedone.io/asset/uploads/1696230027.png"
                                alt="avatar" />
                            <div class="block">
                                <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">Alex K.</h5>
                                <span class="text-sm leading-4 text-gray-500">Design Lead</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto slide_active:border-indigo-600 hover:border-indigo-600 hover:shadow-sm">
                        <div class="">
                            <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-base font-semibold text-indigo-600">4.9</span>
                            </div>
                            <p
                                class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                                Pagedone has made it possible for me to stay on top of my portfolio and make
                                informed
                                decisions
                                quickly and easily.
                            </p>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5">
                            <img class="rounded-full h-10 w-10 object-cover" src="https://pagedone.io/asset/uploads/1696229969.png"
                                alt="avatar" />
                            <div class="block">
                                <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">Jane D</h5>
                                <span class="text-sm leading-4 text-gray-500">CEO </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 flex justify-between flex-col rounded-xl p-6 transition-all duration-500  w-full mx-auto slide_active:border-indigo-600 hover:border-indigo-600 hover:shadow-sm ">
                        <div class="">
                            <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-base font-semibold text-indigo-600">4.9</span>
                            </div>
                            <p
                                class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                                Thanks to pagedone, I feel more informed and confident about my investment decisions
                                than
                                ever
                                before.
                            </p>
                        </div>
                        <div class="flex items-center gap-5 pt-5 border-t border-solid border-gray-200">
                            <img class="rounded-full h-10 w-10 object-cover" src="https://pagedone.io/asset/uploads/1696229994.png"
                                alt="avatar" />
                            <div class="block">
                                <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">Harsh P.
                                </h5>
                                <span class="text-sm leading-4 text-gray-500">Product Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 32,
    loop: true,
    centeredSlides: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,

    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 32,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 32,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});
</script>


@endsection
