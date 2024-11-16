@extends('public::layouts.main')

@section('content')
    <div class="max-w-screen-lg mx-auto">

        <main class="mt-5">
            <!-- featured section -->
            <a href="/#blog"
                class="w-24 flex text-gray-500 hover:text-indigo-600 font-semibold text-sm mb-4 text-orange-500"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block ml-5 md:ml-0 text-orange-500 mb-5"
                    fill="currentColor" viewBox="0 0 512 512">
                    <path
                        d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM116.7 244.7l112-112c4.6-4.6 11.5-5.9 17.4-3.5s9.9 8.3 9.9 14.8l0 64 96 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32l-96 0 0 64c0 6.5-3.9 12.3-9.9 14.8s-12.9 1.1-17.4-3.5l-112-112c-6.2-6.2-6.2-16.4 0-22.6z" />
                </svg>
                <p class="ml-2">Back</p>
            </a>
            <div class="flex flex-wrap md:flex-nowrap space-x-0 md:space-x-6 mb-16">
                <!-- main post -->
                <div class="mb-4 lg:mb-0 p-4 lg:p-0 w-full md:w-2/2 relative rounded block">
                    <img src="{{ $blog->getFirstMediaUrl('images') }}" class="rounded-md object-cover w-full h-auto">
                    <div class="flex items-center space-x-3 w-full mt-3">
                        <span class="text-orange-700 text-sm">
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
                        </span>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-orange-700 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path
                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                            </svg>
                            <span class="text-orange-700 text-sm">
                                {{ $blog->views_count }} views
                            </span>
                        </div>
                        <button id="openModalButton" data-url="{{ url('blog-detail', $blog->slug) }}"
                            class="flex items-center">
                            <svg class="w-4 h-4 text-orange-700 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path
                                    d="M352 224l-46.5 0c-45 0-81.5 36.5-81.5 81.5c0 22.3 10.3 34.3 19.2 40.5c6.8 4.7 12.8 12 12.8 20.3c0 9.8-8 17.8-17.8 17.8l-2.5 0c-2.4 0-4.8-.4-7.1-1.4C210.8 374.8 128 333.4 128 240c0-79.5 64.5-144 144-144l80 0 0-61.3C352 15.5 367.5 0 386.7 0c8.6 0 16.8 3.2 23.2 8.9L548.1 133.3c7.6 6.8 11.9 16.5 11.9 26.7s-4.3 19.9-11.9 26.7l-139 125.1c-5.9 5.3-13.5 8.2-21.4 8.2l-3.7 0c-17.7 0-32-14.3-32-32l0-64zM80 96c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-48c0-17.7 14.3-32 32-32s32 14.3 32 32l0 48c0 44.2-35.8 80-80 80L80 512c-44.2 0-80-35.8-80-80L0 112C0 67.8 35.8 32 80 32l48 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L80 96z" />
                            </svg>
                            <span class="text-orange-700 text-sm">Share</span>
                        </button>

                    </div>
                    <h1 class="text-gray-800 text-lg md:text-2xl font-bold mt-2 mb-2 leading-tight">
                        {{ $blog->title }}
                    </h1>
                    <p class="text-gray-600 mb-4 font-semibold">
                        {{ $blog->description }}
                    </p>
                    <p class="text-gray-800 text-lg md:text-2xl font-bold mb-4leading-tight">
                        {!! $blog->content !!}
                    </p>
                </div>

                <!-- sub-main posts -->
                <div class="w-full md:w-2/3">
                    <!-- post 1 -->
                    @foreach ($lainnya as $item)
                        <div class="rounded w-full flex flex-col md:flex-row mb-10">
                            <img src="{{ $item->getFirstMediaUrl('images') }}"
                                class="block md:hidden lg:block rounded-md h-64 md:h-32 m-4 md:m-0" />
                            <div class="bg-white rounded px-4">
                                <span class="text-green-700 text-sm hidden md:block">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
                                <a href="{{ url('blog-detail', $item->slug) }}">
                                    <div class="md:mt-0 text-gray-800 font-semibold text-sm mb-2">
                                        {{ $blog->title }}
                                    </div>
                                </a>
                                <p class="text-gray-600 mb-4 font-semibold text-sm">
                                    {{ \Illuminate\Support\Str::limit($item->description, 50, '...') }}
                                </p>
                                {{-- <p class="block md:hidden p-2 pl-0 pt-1 text-sm text-gray-600">
                                {!! $item->isi !!}
                            </p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- modal start share --}}
            <div id="shareModal"
                class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
                <!--MODAL ITEM-->
                <div class="bg-gray-100 w-full mx-4 p-4 rounded-xl md:w-1/2 lg:w-1/3">
                    <!--MODAL HEADER-->
                    <div class="flex justify-between items center border-b border-gray-200 py-3">
                        <div class="flex items-center justify-center">
                            <p class="text-xl font-bold text-gray-800">Share</p>
                        </div>

                        <div id="closeModalButton"
                            class="bg-gray-300 hover:bg-gray-500 cursor-pointer hover:text-gray-300 font-sans text-gray-500 w-8 h-8 flex items-center justify-center rounded-full">
                            x
                        </div>
                    </div>

                    <!--MODAL BODY-->
                    <div class="my-4">
                        <p class="text-sm">Share this link via</p>
                        <div class="flex justify-around my-4">
                            <!--FACEBOOK ICON-->
                            <a href="#" target="_blank"
                                class="facebook-share border hover:bg-[#1877f2] w-12 h-12 fill-[#1877f2] hover:fill-white border-blue-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-blue-500/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z">
                                    </path>
                                </svg>
                            </a>
                            <!--TWITTER ICON-->
                            <a href="#" target="_blank"
                                class="twitter-share border hover:bg-[#1d9bf0] w-12 h-12 fill-[#1d9bf0] hover:fill-white border-blue-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-sky-500/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
                                    </path>
                                </svg>
                            </a>
                            <!--INSTAGRAM ICON-->
                            <a href="#" target="_blank"
                                class="instagram-share border hover:bg-[#bc2a8d] w-12 h-12 fill-[#bc2a8d] hover:fill-white border-pink-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-pink-500/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z">
                                    </path>
                                    <circle cx="16.806" cy="7.207" r="1.078"></circle>
                                    <path
                                        d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z">
                                    </path>
                                </svg>
                            </a>

                            <!--WHATSAPP ICON-->
                            <a href="#" target="_blank"
                                class="whatsapp-share border hover:bg-[#25D366] w-12 h-12 fill-[#25D366] hover:fill-white border-green-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-green-500/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                    </path>
                                </svg>
                            </a>

                            <!--TELEGRAM ICON-->
                            <a href="#" target="_blank"
                                class="telegram-share border hover:bg-[#229ED9] w-12 h-12 fill-[#229ED9] hover:fill-white border-sky-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-sky-500/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z">
                                    </path>
                                </svg>
                            </a>
                        </div>

                    </div>

                    <p class="text-sm">Or copy link</p>
                    <!-- BOX LINK -->
                    <div class="border-2 border-gray-200 flex justify-between items-center mt-4 py-2 p-10 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-gray-500 ml-2">
                            <path
                                d="M8.465 11.293c1.133-1.133 3.109-1.133 4.242 0l.707.707 1.414-1.414-.707-.707c-.943-.944-2.199-1.465-3.535-1.465s-2.592.521-3.535 1.465L4.929 12a5.008 5.008 0 0 0 0 7.071 4.983 4.983 0 0 0 3.535 1.462A4.982 4.982 0 0 0 12 19.071l.707-.707-1.414-1.414-.707.707a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.122-2.121z">
                            </path>
                            <path
                                d="m12 4.929-.707.707 1.414 1.414.707-.707a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.122 2.121c-1.133 1.133-3.109 1.133-4.242 0L10.586 12l-1.414 1.414.707.707c.943.944 2.199 1.465 3.535 1.465s2.592-.521 3.535-1.465L19.071 12a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0z">
                            </path>
                        </svg>

                        <input class="border-0 rounded-lg shadow-sm w-1/2" type="text" id="linkToCopy" placeholder="link"
                            value="{{ url('/blog-detail/' . $blog->slug) }}">

                        <button onclick="copyToClipboard()"
                            class="bg-gradient-to-r from-amber-400 to-amber-600 text-white rounded text-sm py-2 px-5 mr-2 hover:bg-indigo-600">
                          copy
                        </button>
                    </div>

                </div>
            </div>
    </div>
    {{-- end modal --}}
    <!-- end featured section -->
    <a href="/#blog"
        class="w-24 md:ml-28 flex text-gray-500 hover:text-indigo-600 font-semibold text-sm mb-4 text-orange-500"><svg
            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block ml-5 md:ml-0 text-orange-500 mb-5"
            fill="currentColor" viewBox="0 0 512 512">
            <path
                d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM116.7 244.7l112-112c4.6-4.6 11.5-5.9 17.4-3.5s9.9 8.3 9.9 14.8l0 64 96 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32l-96 0 0 64c0 6.5-3.9 12.3-9.9 14.8s-12.9 1.1-17.4-3.5l-112-112c-6.2-6.2-6.2-16.4 0-22.6z" />
        </svg>
        <p class="ml-2">Back</p>
    </a>
    </main>
    <!-- main ends here -->

    </div>
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("linkToCopy");
            copyText.select();
            document.execCommand("copy");
            alert("Link copied to clipboard: " + copyText.value);
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openModalButton = document.getElementById('openModalButton');
            const modal = document.getElementById('shareModal');
            const closeModalButton = document.getElementById('closeModalButton');

            // Get sharing elements
            const facebookShare = document.querySelector('.facebook-share');
            const twitterShare = document.querySelector('.twitter-share');
            const whatsappShare = document.querySelector('.whatsapp-share');
            const telegramShare = document.querySelector('.telegram-share');

            openModalButton.addEventListener('click', function() {
                const shareUrl = encodeURIComponent(this.getAttribute('data-url'));
                const shareTitle = encodeURIComponent('{{ $blog->title }}');
                const shareImage = encodeURIComponent('{{ $blog->getFirstMediaUrl('images') }}');

                // Update share URLs with encoded parameters
                facebookShare.href = `https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`;
                twitterShare.href = `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}`;
                whatsappShare.href = `https://api.whatsapp.com/send?text=${shareTitle}%20${shareUrl}`;
                telegramShare.href = `https://telegram.me/share/url?url=${shareUrl}&text=${shareTitle}`;

                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });

        function copyToClipboard() {
            var copyText = document.getElementById("linkToCopy");

            // Create a temporary textarea element to handle copying
            const textarea = document.createElement('textarea');
            textarea.value = copyText.value;
            document.body.appendChild(textarea);
            textarea.select();

            try {
                document.execCommand('copy');
                alert("Link copied to clipboard!");
            } catch (err) {
                console.error('Failed to copy text:', err);
                alert("Failed to copy link");
            }

            document.body.removeChild(textarea);
        }
    </script>
@endsection
