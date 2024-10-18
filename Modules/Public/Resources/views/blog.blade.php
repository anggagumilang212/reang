@extends('public::layouts.app')

@section('title', 'Blog')

@push('style')
@endpush

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title pt-5 mb-4 pb-2">
                    <h4 class="title pt-5 mb-4">Blog &amp; Berita</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Semua blog &amp; berita untuk dapat dinikmati oleh para
                        pelanggan, tersedia juga informasi dari pelayanan kami.
                    </p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
    <div id="main-content" class="blog-page">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 left-box">
                    @forelse ($posts as $post)
                        <?php
                        $randomLikes = rand(1, 100);
                        $randomComments = rand(1, 100);
                        ?>
                        <div class="card single_post">
                            <div class="body">
                                <div class="img-post">
                                    @forelse($post->getMedia('images') as $media)
                                        <img src="{{ $media->getUrl() }}" alt="Image" class="img-fluid rounded-top">
                                    @empty
                                        <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Image"
                                            class="img-fluid rounded-top">
                                    @endforelse
                                </div>
                                <h3><a href="{{ route('public.blog-detail', ['post' => $post]) }}">{{ $post->title }}</a>
                                </h3>
                                <p>{{ Str::limit($post->description, 300) }}</p>
                            </div>
                            <div class="footer">
                                <div class="actions">
                                    <a href="{{ route('public.blog-detail', ['post' => $post]) }}"
                                        class="btn btn-outline-secondary">Lanjutkan
                                        Membaca</a>
                                </div>
                                <ul class="stats">
                                    @foreach ($post->categories->take(2) as $category)
                                        <li><a href="javascript:void(0);">{{ $category->title }}</a></li>
                                    @endforeach
                                    <li><a href="javascript:void(0);" class="fa fa-heart">{{ $randomLikes }}</a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-comment">{{ $randomComments }}</a></li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="col text-center m-5 p-5">
                            <i class="fa fa-times-circle-o" style="font-size:52px;color:red"></i>
                            <h5 class="pt-3">Tidak ada data blog!</h5>
                        </div>
                    @endforelse
                    @if ($posts->count() > 0)
                        <ul class="pagination pagination-primary">
                            <li class="page-item{{ $posts->onFirstPage() ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $posts->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                <li class="page-item{{ $page === $posts->currentPage() ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item{{ $posts->hasMorePages() ? '' : ' disabled' }}">
                                <a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    @else
                    @endif
                </div>
                <div class="col-lg-4 col-md-12 right-box">
                    <form action="" method="GET" class="form-inline form-row">
                        <div class="card">
                            <div class="body search">
                                <div class="input-group m-b-0">
                                    <input type="search" value="{{ request()->get('keyword') }}" name="keyword"
                                        class="form-control" placeholder="Search...">
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div> --}}
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card">
                        <div class="header">
                            <h4>Kategori</h4>
                        </div>
                        <div class="body widget">
                            @if ($post_categories && count($post_categories) > 0)
                                @include('public::category-list', [
                                    'post_categories' => $post_categories,
                                    'count' => 0,
                                ])
                            @else
                                <p>Tidak ada kategori yang tersedia.</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h4>Berita Populer</h4>
                        </div>
                        <div class="body widget popular-post">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($popularPosts && count($popularPosts) > 0)
                                        @foreach ($popularPosts as $popular)
                                            <div class="single_post">
                                                @forelse($post->getMedia('images') as $media)
                                                    <div class="img-post"
                                                        style="width: 280px; height: 280px; overflow: hidden;">
                                                        <img src="{{ $media->getUrl() }}"
                                                            class="d-block img-fluid rounded-top" alt="img"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                @empty
                                                    <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Image"
                                                        class="img-fluid rounded-top">
                                                @endforelse
                                                <h5 class="" style="font-weight: 600;"><a
                                                        style="text-decoration: none;"
                                                        href="{{ route('public.blog-detail', ['post' => $popular]) }}">{{ $popular->title }}</a>
                                                </h5>
                                                </p>
                                                <p>Dibuat oleh {{ $popular->user->name }}<br>pada
                                                    {{ \Carbon\Carbon::parse($popular->created_at)->format('d F Y') }}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Tidak ada data blog!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h4>Galeri</h4>
                        </div>
                        <div class="body widget">
                            <ul class="list-unstyled instagram-plugin m-b-0">
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                                <li><a href="javascript:void(0);"><img
                                            src="https://www.bootdey.com/image/100x100/87CEFA/000000"
                                            alt="image description"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h4>Email Newsletter</h4>
                            <p>Get our products/news earlier than others, let’s get in
                                touch.</p>
                        </div>
                        <div class="body widget newsletter">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Email">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function filterByCategory() {
            var selectedCategory = document.getElementById('categoryFilter').value;
            window.location.href = '?category=' + selectedCategory;
        }
    </script>
@endpush
