@extends('public::layouts.app')

@section('title', $post->title . ' | Blog')

@push('style')
@endpush

@section('content')
    <div id="main-content" class="blog-page pt-5">
        <div class="container pt-5">
            <div class="row clearfix pt-5">
                <div class="col-lg-8 col-md-12 left-box">
                    <div class="card single_post">
                        <div class="body">
                            @forelse($post->getMedia('images') as $media)
                                <img src="{{ $media->getUrl() }}" alt="Image" class="img-fluid rounded-top">
                            @empty
                                <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Image"
                                    class="img-fluid rounded-top">
                            @endforelse
                            <h2>{{ $post->title }}</h2>
                            <p>Dibuat oleh {{ $post->user->name }} pada
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d F Y') }}
                            </p>
                            <p>
                                @foreach ($categories as $category)
                                    <span class="badge badge-primary">
                                        {{ $category->title }}
                                    </span>
                                @endforeach
                            </p>
                            <p class="pt-3">{!! $post->content !!}</p>
                            <p class="pt-3">
                                @foreach ($tags as $tag)
                                    <span class="badge badge-info">
                                        #{{ $tag->title }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 right-box">
                    <div class="card">
                        <div class="header">
                            <h4>Kategori</h4>
                        </div>
                        <div class="body widget">
                            @if (count($post_categories))
                                @include('public::category-list', [
                                    'post_categories' => $post_categories,
                                    'count' => 0,
                                ])
                            @else
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
                                        <p>Tidak ada kategori yang tersedia.</p>
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
@endpush
