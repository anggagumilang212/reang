@extends('public::layouts.app')

@section('title', 'About')

@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
@endpush

@section('content')
    <div class="container pt-5">
        <div class="container pt-5">
            <div class="row align-items-center pt-5">
                <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                    <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                        <img src="{{ asset('images/about.png') }}" class="img-fluid" alt="Image" />
                                        <div class="img-overlay bg-dark"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                {{-- <div class="col-12">
                                    <div class="mt-4 pt-2 text-right">
                                        <a href="javascript:void(0)" class="btn btn-info">Read More <i
                                                class="mdi mdi-chevron-right"></i></a>
                                    </div>
                                </div> --}}
                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                        <img src="{{ asset('images/aboutt.png') }}" class="img-fluid" alt="Image" />
                                        <div class="img-overlay bg-dark"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                    <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                        <img src="{{ asset('images/abouttt.png') }}" class="img-fluid" alt="Image" />
                                        <div class="img-overlay bg-dark"></div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
                <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
                    <div class="section-title ml-lg-5">
                        <h5 class="text-custom font-weight-normal mb-3">/About Us</h5>
                        <h4 class="title mb-4">
                            ReangNET
                        </h4>
                        <p class="text-muted mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit quod debitis
                            praesentium pariatur temporibus ipsa, cum quidem obcaecati sunt?</p>
                        <div class="row">
                            <div class="col-lg-6 mt-4 pt-2">
                                <div class="media align-items-center rounded shadow p-3">
                                    <i class="fa fa-play h4 mb-0 text-custom"></i>
                                    <h6 class="ml-3 mb-0"><a href="javascript:void(0)" class="text-dark">IT Consultant</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4 pt-2">
                                <div class="media align-items-center rounded shadow p-3">
                                    <i class="fa fa-file-download h4 mb-0 text-custom"></i>
                                    <h6 class="ml-3 mb-0"><a href="javascript:void(0)" class="text-dark">Percetakan</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4 pt-2">
                                <div class="media align-items-center rounded shadow p-3">
                                    <i class="fa fa-user h4 mb-0 text-custom"></i>
                                    <h6 class="ml-3 mb-0"><a href="javascript:void(0)" class="text-dark">Networking</a></h6>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4 pt-2">
                                <div class="media align-items-center rounded shadow p-3">
                                    <i class="fa fa-image h4 mb-0 text-custom"></i>
                                    <h6 class="ml-3 mb-0"><a href="javascript:void(0)" class="text-dark">Development</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--enr row-->
        </div>
    </div>

    <hr class="featurette-divider">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title pt-5 mb-4">Lokasi Kami</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Jl. MT Haryono, Sindang, Kec. Sindang, Kabupaten Indramayu,
                        Jawa Barat 45222.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="google-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.8418888369364!2d108.31824782151348!3d-6.333076085344994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9599846003b%3A0x7ecc6be9c46f85de!2sReang%20Computer!5e0!3m2!1sen!2sid!4v1699514420091!5m2!1sen!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <hr class="featurette-divider">
    <div class="container">
        <div class="registration-form">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title pt-5 mb-4">Beri kami masukan!</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Kami dengan senang hati mendengar masukan dan kritik
                            yang membangun dari anda.</p>
                    </div>
                </div><!--end col-->
            </div>
            <form>
                {{-- <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div> --}}
                <div class="form-group">
                    <input type="text" class="form-control item" id="name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control item" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <textarea name="text" class="form-control item" id="message" placeholder="Pesan" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Kirim
                    </button>
                </div>
            </form>
            {{-- <div class="social-media">
                <h5>Sign up with social media</h5>
                <div class="social-icons">
                    <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                    <a href="#"><i class="icon-social-google" title="Google"></i></a>
                    <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
    </script>
    <script src="assets/js/script.js"></script> --}}
@endpush
