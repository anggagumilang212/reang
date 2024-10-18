@extends('public::layouts.app')

@section('title', 'ReangNET')

@section('content')
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/reang.png') }}" alt="carousel-img" class="bd-placeholder-img d-block w-100"
                    width="100%" height="100%" focusable="false" role="img" style="object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/reang.png') }}" alt="carousel-img" class="bd-placeholder-img d-block w-100"
                    width="100%" height="100%" focusable="false" role="img" style="object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/reang.png') }}" alt="carousel-img" class="bd-placeholder-img d-block w-100"
                    width="100%" height="100%" focusable="false" role="img" style="object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleFade" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Our Feature</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Build responsive, mobile-first projects on the web
                        with the world's most popular front-end component library.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3">
                                </rect>
                                <path class="uim-primary"
                                    d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Fully Responsive</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3">
                                </rect>
                                <path class="uim-primary"
                                    d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="1em">
                                <path class="uim-quaternary"
                                    d="M15,2c-3.3772,0.00142-6.27155,2.41462-6.88025,5.73651c2.90693-1.59074,6.553-0.52375,8.14374,2.38317c0.98206,1.79462,0.98206,3.96594,0,5.76057c3.8013-0.69634,6.31837-4.3424,5.62202-8.14369C21.27662,4.41261,18.37925,1.99872,15,2z">
                                </path>
                                <circle cx="7" cy="17" r="5" class="uim-primary"></circle>
                                <path class="uim-tertiary"
                                    d="M11,7c-3.08339,0.00031-5.66461,2.33759-5.97,5.40582c2.5358-1.08949,5.47469,0.08297,6.56418,2.61877c0.54113,1.25947,0.54113,2.68593,0,3.94541c3.29729-0.32786,5.7045-3.26663,5.37664-6.56392C16.66569,9.33735,14.08386,6.99972,11,7z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Fresh Layouts</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="1em">
                                <path class="uim-quaternary"
                                    d="M15,2c-3.3772,0.00142-6.27155,2.41462-6.88025,5.73651c2.90693-1.59074,6.553-0.52375,8.14374,2.38317c0.98206,1.79462,0.98206,3.96594,0,5.76057c3.8013-0.69634,6.31837-4.3424,5.62202-8.14369C21.27662,4.41261,18.37925,1.99872,15,2z">
                                </path>
                                <circle cx="7" cy="17" r="5" class="uim-primary"></circle>
                                <path class="uim-tertiary"
                                    d="M11,7c-3.08339,0.00031-5.66461,2.33759-5.97,5.40582c2.5358-1.08949,5.47469,0.08297,6.56418,2.61877c0.54113,1.25947,0.54113,2.68593,0,3.94541c3.29729-0.32786,5.7045-3.26663,5.37664-6.56392C16.66569,9.33735,14.08386,6.99972,11,7z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-quaternary"
                                    d="M6,23H2a.99974.99974,0,0,1-1-1V16a.99974.99974,0,0,1,1-1H6a.99974.99974,0,0,1,1,1v6A.99974.99974,0,0,1,6,23Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M14,23H10a.99974.99974,0,0,1-1-1V10a.99974.99974,0,0,1,1-1h4a.99974.99974,0,0,1,1,1V22A.99974.99974,0,0,1,14,23Z">
                                </path>
                                <path class="uim-primary"
                                    d="M22,23H18a.99974.99974,0,0,1-1-1V2a.99974.99974,0,0,1,1-1h4a.99974.99974,0,0,1,1,1V22A.99974.99974,0,0,1,22,23Z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Minimalism Feast</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-quaternary"
                                    d="M6,23H2a.99974.99974,0,0,1-1-1V16a.99974.99974,0,0,1,1-1H6a.99974.99974,0,0,1,1,1v6A.99974.99974,0,0,1,6,23Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M14,23H10a.99974.99974,0,0,1-1-1V10a.99974.99974,0,0,1,1-1h4a.99974.99974,0,0,1,1,1V22A.99974.99974,0,0,1,14,23Z">
                                </path>
                                <path class="uim-primary"
                                    d="M22,23H18a.99974.99974,0,0,1-1-1V2a.99974.99974,0,0,1,1-1h4a.99974.99974,0,0,1,1,1V22A.99974.99974,0,0,1,22,23Z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-tertiary"
                                    d="M20 11a.99018.99018 0 0 1-.71-.29 1.16044 1.16044 0 0 1-.21-.33008.94107.94107 0 0 1 0-.75976A1.02883 1.02883 0 0 1 19.29 9.29a1.04667 1.04667 0 0 1 1.41992 0 1.14718 1.14718 0 0 1 .21.33008.94107.94107 0 0 1 0 .75976 1.16044 1.16044 0 0 1-.21.33008A.99349.99349 0 0 1 20 11zM19 6.5a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 19 6.5zM20 4a.98979.98979 0 0 1-.91992-1.37988A1.02883 1.02883 0 0 1 19.29 2.29a1.04669 1.04669 0 0 1 1.41992 0 1.02883 1.02883 0 0 1 .21.33008A.98919.98919 0 0 1 20.71 3.71a1.16044 1.16044 0 0 1-.33008.21A.9994.9994 0 0 1 20 4zM7.03027 6.24023a.99364.99364 0 0 1 .7295-1.21h0a.9907.9907 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 8 7H8A.99122.99122 0 0 1 7.03027 6.24023zm4-1a.99364.99364 0 0 1 .7295-1.21h0a.9907.9907 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 12 6h0A1.00294 1.00294 0 0 1 11.03027 5.24023zm4-1a.99816.99816 0 0 1 .7295-1.21h0a1.00272 1.00272 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 16 5h0A.99122.99122 0 0 1 15.03027 4.24023zM4 8A.99042.99042 0 0 1 3 7a.83154.83154 0 0 1 .08008-.37988A1.02883 1.02883 0 0 1 3.29 6.29 1.04669 1.04669 0 0 1 4.71 6.29a1.02883 1.02883 0 0 1 .21.33008A.99013.99013 0 0 1 4 8zM4 11a.99018.99018 0 0 1-.71-.29 1.16044 1.16044 0 0 1-.21-.33008.94107.94107 0 0 1 0-.75976A1.14718 1.14718 0 0 1 3.29 9.29 1.04667 1.04667 0 0 1 4.71 9.29a1.14718 1.14718 0 0 1 .21.33008.94107.94107 0 0 1 0 .75976 1.16044 1.16044 0 0 1-.21.33008A.99349.99349 0 0 1 4 11zM15 10a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 15 10zm-4 0a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 11 10zM7 10A1.0032 1.0032 0 0 1 8 9H8a1.0032 1.0032 0 0 1 1 1H9a1.0032 1.0032 0 0 1-1 1H8A1.0032 1.0032 0 0 1 7 10z">
                                </path>
                                <polygon class="uim-primary" points="20 14 20 21 4 17 4 14 20 14"></polygon>
                                <path class="uim-primary"
                                    d="M20,22a.97427.97427,0,0,1-.24219-.03027l-16-4A.99961.99961,0,0,1,3,17V14a.99943.99943,0,0,1,1-1H20a.99943.99943,0,0,1,1,1v7a1.0005,1.0005,0,0,1-1,1ZM5,16.21875l14,3.5V15H5Z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Modern Workflow</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-tertiary"
                                    d="M20 11a.99018.99018 0 0 1-.71-.29 1.16044 1.16044 0 0 1-.21-.33008.94107.94107 0 0 1 0-.75976A1.02883 1.02883 0 0 1 19.29 9.29a1.04667 1.04667 0 0 1 1.41992 0 1.14718 1.14718 0 0 1 .21.33008.94107.94107 0 0 1 0 .75976 1.16044 1.16044 0 0 1-.21.33008A.99349.99349 0 0 1 20 11zM19 6.5a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 19 6.5zM20 4a.98979.98979 0 0 1-.91992-1.37988A1.02883 1.02883 0 0 1 19.29 2.29a1.04669 1.04669 0 0 1 1.41992 0 1.02883 1.02883 0 0 1 .21.33008A.98919.98919 0 0 1 20.71 3.71a1.16044 1.16044 0 0 1-.33008.21A.9994.9994 0 0 1 20 4zM7.03027 6.24023a.99364.99364 0 0 1 .7295-1.21h0a.9907.9907 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 8 7H8A.99122.99122 0 0 1 7.03027 6.24023zm4-1a.99364.99364 0 0 1 .7295-1.21h0a.9907.9907 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 12 6h0A1.00294 1.00294 0 0 1 11.03027 5.24023zm4-1a.99816.99816 0 0 1 .7295-1.21h0a1.00272 1.00272 0 0 1 1.21.7295h0a.99891.99891 0 0 1-.7295 1.21h0A.96451.96451 0 0 1 16 5h0A.99122.99122 0 0 1 15.03027 4.24023zM4 8A.99042.99042 0 0 1 3 7a.83154.83154 0 0 1 .08008-.37988A1.02883 1.02883 0 0 1 3.29 6.29 1.04669 1.04669 0 0 1 4.71 6.29a1.02883 1.02883 0 0 1 .21.33008A.99013.99013 0 0 1 4 8zM4 11a.99018.99018 0 0 1-.71-.29 1.16044 1.16044 0 0 1-.21-.33008.94107.94107 0 0 1 0-.75976A1.14718 1.14718 0 0 1 3.29 9.29 1.04667 1.04667 0 0 1 4.71 9.29a1.14718 1.14718 0 0 1 .21.33008.94107.94107 0 0 1 0 .75976 1.16044 1.16044 0 0 1-.21.33008A.99349.99349 0 0 1 4 11zM15 10a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 15 10zm-4 0a1.0032 1.0032 0 0 1 1-1h0a1.0032 1.0032 0 0 1 1 1h0a1.0032 1.0032 0 0 1-1 1h0A1.0032 1.0032 0 0 1 11 10zM7 10A1.0032 1.0032 0 0 1 8 9H8a1.0032 1.0032 0 0 1 1 1H9a1.0032 1.0032 0 0 1-1 1H8A1.0032 1.0032 0 0 1 7 10z">
                                </path>
                                <polygon class="uim-primary" points="20 14 20 21 4 17 4 14 20 14"></polygon>
                                <path class="uim-primary"
                                    d="M20,22a.97427.97427,0,0,1-.24219-.03027l-16-4A.99961.99961,0,0,1,3,17V14a.99943.99943,0,0,1,1-1H20a.99943.99943,0,0,1,1,1v7a1.0005,1.0005,0,0,1-1,1ZM5,16.21875l14,3.5V15H5Z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-quaternary"
                                    d="M12,22a.99974.99974,0,0,1-1-1V3a1,1,0,0,1,2,0V21A.99974.99974,0,0,1,12,22Z">
                                </path>
                                <polygon class="uim-primary" points="21 12 16 7 16 17 21 12"></polygon>
                                <path class="uim-primary"
                                    d="M16,18a1,1,0,0,1-1-1V7a.99991.99991,0,0,1,1.707-.707l5,5a.99962.99962,0,0,1,0,1.41406l-5,5A.99893.99893,0,0,1,16,18Zm1-8.58594v5.17188L19.58594,12Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M3 13a.99075.99075 0 0 1-.92041-1.37988A1.14883 1.14883 0 0 1 2.29 11.29a1.04669 1.04669 0 0 1 1.41992 0 1.03724 1.03724 0 0 1 .21.33008A.83792.83792 0 0 1 4 12a.99042.99042 0 0 1-1 1zM4.79 15.21a1.00761 1.00761 0 0 1 0-1.41992h0a1.00671 1.00671 0 0 1 1.41992 0h0a1.0085 1.0085 0 0 1 0 1.41992h0a1.02749 1.02749 0 0 1-.71.29h0A1.02577 1.02577 0 0 1 4.79 15.21zM8 18a.99183.99183 0 0 1-.71-.29 1.16213 1.16213 0 0 1-.21045-.33008A.99906.99906 0 0 1 7 17a1.05 1.05 0 0 1 .29-.71 1.0387 1.0387 0 0 1 1.08984-.21 1.15384 1.15384 0 0 1 .33008.21A1.05232 1.05232 0 0 1 9 17a.9994.9994 0 0 1-.08008.37988 1.17124 1.17124 0 0 1-.21.33008A.99183.99183 0 0 1 8 18zM7 13.66992a.996.996 0 0 1 1-1H8a.99632.99632 0 0 1 1 1H9a1.00319 1.00319 0 0 1-1 1H8A1.00288 1.00288 0 0 1 7 13.66992zm0-3.33984a1.00288 1.00288 0 0 1 1-1H8a1.00319 1.00319 0 0 1 1 1H9a.99693.99693 0 0 1-1 1H8A.99663.99663 0 0 1 7 10.33008zM8 8a.99075.99075 0 0 1-.92041-1.37988A1.03011 1.03011 0 0 1 7.29 6.29a.98544.98544 0 0 1 1.62988.33008A.99013.99013 0 0 1 8 8zM4.79 10.21A1.00761 1.00761 0 0 1 4.79 8.79h0A1.00671 1.00671 0 0 1 6.21 8.79h0a1.0085 1.0085 0 0 1 0 1.41992h0a1.02749 1.02749 0 0 1-.71.29h0A1.02577 1.02577 0 0 1 4.79 10.21z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Unique Features</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-quaternary"
                                    d="M12,22a.99974.99974,0,0,1-1-1V3a1,1,0,0,1,2,0V21A.99974.99974,0,0,1,12,22Z">
                                </path>
                                <polygon class="uim-primary" points="21 12 16 7 16 17 21 12"></polygon>
                                <path class="uim-primary"
                                    d="M16,18a1,1,0,0,1-1-1V7a.99991.99991,0,0,1,1.707-.707l5,5a.99962.99962,0,0,1,0,1.41406l-5,5A.99893.99893,0,0,1,16,18Zm1-8.58594v5.17188L19.58594,12Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M3 13a.99075.99075 0 0 1-.92041-1.37988A1.14883 1.14883 0 0 1 2.29 11.29a1.04669 1.04669 0 0 1 1.41992 0 1.03724 1.03724 0 0 1 .21.33008A.83792.83792 0 0 1 4 12a.99042.99042 0 0 1-1 1zM4.79 15.21a1.00761 1.00761 0 0 1 0-1.41992h0a1.00671 1.00671 0 0 1 1.41992 0h0a1.0085 1.0085 0 0 1 0 1.41992h0a1.02749 1.02749 0 0 1-.71.29h0A1.02577 1.02577 0 0 1 4.79 15.21zM8 18a.99183.99183 0 0 1-.71-.29 1.16213 1.16213 0 0 1-.21045-.33008A.99906.99906 0 0 1 7 17a1.05 1.05 0 0 1 .29-.71 1.0387 1.0387 0 0 1 1.08984-.21 1.15384 1.15384 0 0 1 .33008.21A1.05232 1.05232 0 0 1 9 17a.9994.9994 0 0 1-.08008.37988 1.17124 1.17124 0 0 1-.21.33008A.99183.99183 0 0 1 8 18zM7 13.66992a.996.996 0 0 1 1-1H8a.99632.99632 0 0 1 1 1H9a1.00319 1.00319 0 0 1-1 1H8A1.00288 1.00288 0 0 1 7 13.66992zm0-3.33984a1.00288 1.00288 0 0 1 1-1H8a1.00319 1.00319 0 0 1 1 1H9a.99693.99693 0 0 1-1 1H8A.99663.99663 0 0 1 7 10.33008zM8 8a.99075.99075 0 0 1-.92041-1.37988A1.03011 1.03011 0 0 1 7.29 6.29a.98544.98544 0 0 1 1.62988.33008A.99013.99013 0 0 1 8 8zM4.79 10.21A1.00761 1.00761 0 0 1 4.79 8.79h0A1.00671 1.00671 0 0 1 6.21 8.79h0a1.0085 1.0085 0 0 1 0 1.41992h0a1.02749 1.02749 0 0 1-.71.29h0A1.02577 1.02577 0 0 1 4.79 10.21z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card service-wrapper rounded border-0 shadow p-4">
                    <div class="icon text-center text-custom h1 shadow rounded bg-white">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-primary"
                                    d="M12,6a.99974.99974,0,0,1,1,1v4.42249l2.09766,1.2113a1.00016,1.00016,0,0,1-1,1.73242l-2.59766-1.5A1.00455,1.00455,0,0,1,11,12V7A.99974.99974,0,0,1,12,6Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M2,12A10,10,0,1,0,12,2,10,10,0,0,0,2,12Zm9-5a1,1,0,0,1,2,0v4.42249l2.09766,1.2113a1.00016,1.00016,0,0,1-1,1.73242l-2.59766-1.5A1.00455,1.00455,0,0,1,11,12Z">
                                </path>
                            </svg></span>
                    </div>
                    <div class="content mt-4">
                        <h5 class="title">Support 24/7</h5>
                        <p class="text-muted mt-3 mb-0">It is a long established fact that a reader will be distracted
                            by the when looking at its layout.</p>
                        <div class="mt-3">
                            <a href="javascript:void(0)" class="text-custom">Read More <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="big-icon h1 text-custom">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="1em">
                                <path class="uim-primary"
                                    d="M12,6a.99974.99974,0,0,1,1,1v4.42249l2.09766,1.2113a1.00016,1.00016,0,0,1-1,1.73242l-2.59766-1.5A1.00455,1.00455,0,0,1,11,12V7A.99974.99974,0,0,1,12,6Z">
                                </path>
                                <path class="uim-tertiary"
                                    d="M2,12A10,10,0,1,0,12,2,10,10,0,0,0,2,12Zm9-5a1,1,0,0,1,2,0v4.42249l2.09766,1.2113a1.00016,1.00016,0,0,1-1,1.73242l-2.59766-1.5A1.00455,1.00455,0,0,1,11,12Z">
                                </path>
                            </svg></span>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>

    <hr class="featurette-divider">

    <div class="container">
        <section class="section" id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-box text-center">
                            <h3 class="title-heading mt-4">Paket Wi-fi Rumahan</h3>
                            <p class="text-muted f-17 mt-3">Kami juga menyediakan layanan wifi untuk rumah, toko ataupun
                                cafe anda.
                                <br> Berikut ini adalah layanan dan biaya paket wi-fi yang bisa anda pilih.
                            </p>
                            <img src="images/home-border.png" height="15" class="mt-3" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="pricing-box mt-4">
                            <i class="mdi mdi-account h1"></i>
                            <h4 class="f-20">Starter</h4>
                            <div class="mt-4 pt-2">
                                <p class="mb-2 f-18">Layanan Fitur</p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>Speed Up
                                    to <b>3Mbps</b></p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Free</b>
                                    Maintenance</p>
                                {{-- <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i>No <b>FUP</b>
                                    </p> --}}
                                <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>No
                                    <b>FUP</b>
                                </p>
                            </div>
                            <p class="mt-4 pt-2 text-muted">Biaya pemasangan gratis, survei langsung ke lokasi anda.
                            </p>
                            <div class="pricing-plan mt-4 pt-2">
                                <h4 class="text-muted"><s> Rp.140.000</s><br><span class="plan pl-3 text-dark">Rp. 110.000
                                    </span>
                                </h4>
                                <p class="text-muted mb-0">Per Bulan</p>
                            </div>
                            <div class="mt-4 pt-3">
                                <a href="https://wa.me/+6287828496000" class="btn btn-primary btn-rounded"
                                    target="_blank">Pasang
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="pricing-box mt-4">
                            <div class="pricing-badge">
                                <span class="badge">Paling Laris</span>
                            </div>
                            <i class="mdi mdi-account-multiple h1 text-primary"></i>
                            <h4 class="f-20 text-primary">Personal</h4>
                            <div class="mt-4 pt-2">
                                <p class="mb-2 f-18">Layanan Fitur</p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>Speed Up
                                    to <b>5Mbps</b></p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Free</b>
                                    Maintenance</p>
                                <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>No
                                    <b>FUP</b>
                                </p>
                            </div>
                            <p class="mt-4 pt-2 text-muted">Biaya pemasangan gratis, survei langsung ke lokasi anda.
                            </p>
                            <div class="pricing-plan mt-4 pt-2">
                                <h4 class="text-muted"><s> Rp.180.000</s><br><span class="plan pl-3 text-dark">Rp.165.000
                                    </span>
                                </h4>
                                <p class="text-muted mb-0">Per Bulan</p>
                            </div>
                            <div class="mt-4 pt-3">
                                <a href="https://wa.me/+6287828496000" class="btn btn-primary btn-rounded"
                                    target="_blank">Pasang
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="pricing-box mt-4">
                            <i class="mdi mdi-account-multiple-plus h1"></i>
                            <h4 class="f-20">Ultimate</h4>
                            <div class="mt-4 pt-2">
                                <p class="mb-2 f-18">Layanan Fitur</p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>Speed Up
                                    to <b>10Mbps</b></p>
                                <p class="mb-2"><i
                                        class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Free</b>
                                    Maintenance</p>
                                <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>No
                                    <b>FUP</b>
                                </p>
                            </div>
                            <p class="mt-4 pt-2 text-muted">Biaya pemasangan gratis, survei langsung ke lokasi anda.
                            </p>
                            <div class="pricing-plan mt-4 pt-2">
                                <h4 class="text-muted"><s> Rp.250.000</s><br><span class="plan pl-3 text-dark">Rp.200.000
                                    </span>
                                </h4>
                                <p class="text-muted mb-0">Per Bulan</p>
                            </div>
                            <div class="mt-4 pt-3">
                                <a href="https://wa.me/+6287828496000" class="btn btn-primary btn-rounded"
                                    target="_blank">Pasang
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <hr class="featurette-divider">

    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Apa Kata Mereka?</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Beberapa tanggapan dari para pelanggan yang telah
                        merasakan pelayanan dari kami.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-12">
                <div class="card-columns">
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Barang-barang lumayan lengkap, pelayanannya cepat dan buka sampai malam.
                                </p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Budi Ari
                                        <cite class="font-weight-bold">Ara Cell</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Lokasinya mudah di ingat dan strategis di depan kecamatan
                                    sindang. Dekat juga dengan tempat jajanan dan makanan. </p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Adi Permata
                                        <cite class="font-weight-bold">TB Adi Permata</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Lokasinya yang mudah diingat, pelayanan memuaskan, dan barang yang disediakan
                                    cukup lengkap. Saya sering menggunakan layananan di Reang.Net</p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Johan Tabarok
                                        <cite class="font-weight-bold">Peternak Lele</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Reang.NET juga ternyata menyediakan layanan wi-fi, saya baru memasang 1 bulan
                                    rasanya sangat memuaskan. Pokoknya saya merasa senang dengan adanya Reang.NET.
                                </p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Nur Kholif
                                        <cite class="font-weight-bold">Warung Sembako Nur</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Rekomendasi banget buat print kebutuhan sekolah guyss. </p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Ica Natalie
                                        <cite class="font-weight-bold">Siswa SMA</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <blockquote class=" ">
                                <i class="fa fa-quote-right fa-2x text-muted pull-right mt-3 mb-3" aria-hidden="true"></i>
                                <p class=" m-0 text-muted ">
                                    Pelayanannya sangat memuaskan apalagi untuk aku yang gaada waktu untuk
                                    keluar rumah, jadi tinggal hubungi admin kalau mau print tugas sekolah
                                    dan tinggal ambil ke toko nya. </p>
                                <footer class="blockquote-footer small p-1">
                                    <span class="small">Aria Cantika
                                        <cite class="font-weight-bold">Mahasiswa</cite>
                                    </span>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Blog &amp; Berita Terbaru</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Blog &amp; Berita terbaru dari kami untuk dinikmati para
                        pelanggan
                        dimanapun dan kapanpun</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-lg-4 col-md-6 mt-4 pt-2">
                    <div class="blog-post rounded border">
                        <div class="blog-img d-block overflow-hidden position-relative">
                            @forelse($post->getMedia('images') as $media)
                                <img src="{{ $media->getUrl() }}" alt="Image" class="img-fluid rounded-top">
                            @empty
                                <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Image"
                                    class="img-fluid rounded-top">
                            @endforelse
                            <div class="overlay rounded-top bg-dark"></div>
                            <div class="post-meta">
                                <a href="javascript:void(0)" class="text-light d-block text-right like"><i
                                        class="fa fa-heart"></i> 33</a>
                                <a href="{{ route('public.blog-detail', ['post' => $post]) }}"
                                    class="text-light read-more">Read More <i class="mdi mdi-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="content p-3">
                            <small class="text-muted p float-right">{{ $post->created_at->format('d M Y') }}</small>
                            @foreach ($post->categories->take(3) as $category)
                                <small class="d-inline-block mb-2 text-primary mr-2">{{ $category->title }}</small>
                            @endforeach
                            {{-- <small><a href="javascript:void(0)" class="text-primary">Marketing</a></small> --}}
                            <h4 class="mt-2"><a href="{{ route('public.blog-detail', ['post' => $post]) }}"
                                    class="text-dark title">{{ Str::limit($post->title, 25) }}</a></h4>
                            <p class="text-muted mt-2">{{ Str::limit($post->description, 120) }}</p>
                            <div class="pt-3 mt-3 border-top d-flex">
                                <img src="{{ asset('images/reangnet.png') }}"
                                    class="img-fluid avatar avatar-ex-sm rounded-pill mr-3 shadow" alt="">
                                <div class="author mt-2">
                                    <h6 class="mb-0 text-dark name">Editor Reang</h6>
                                </div>
                            </div>
                        </div>
                    </div><!--end blog post-->
                </div><!--end col-->
            @empty
                <div class="container text-center">
                    <p class="pt-4">Tidak ada post terbaru</p>
                </div>
            @endforelse
        </div><!--end row-->
    </div>

    <hr class="featurette-divider">

    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Katalog Terbaru</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Stok barang terbaru yang tersedia di toko kami, untuk
                        seluruh barang bisa dilihat
                        pada menu store.
                    </p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>

    <div class="schedules-area pd-top-110 pd-bottom-120">
        <div class="container">
            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade active show" id="ex1-tabs-1" role="tabpanel">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="single-schedules-inner lunch-schedules text-center">
                                    <div class="lunch-schedules-inner align-self-center">
                                        <div class="icons">
                                            @forelse($product->getMedia('images') as $media)
                                                <img src="{{ $media->getUrl() }}" alt="Product Image"
                                                    class="img-fluid img-thumbnail mb-2"
                                                    style="width: 200px; height: 200px; object-fit: cover;">
                                            @empty
                                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image"
                                                    class="img-fluid img-thumbnail mb-2">
                                            @endforelse
                                        </div>
                                        <h5 class="shop-thumb__title">
                                            {{ $product->product_name }}
                                        </h5>
                                        <div class="shop-thumb__price">
                                            {{ format_currency($product->product_price) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="container text-center">
                                <p class="pt-4">Tidak ada produk terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
