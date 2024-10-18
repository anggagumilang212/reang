@extends('public::layouts.main')
@section('content')

<div class="font-sans bg-gray-100">
    <div class="min-h-screen flex justify-center items-center">
        <div class="">
            <div class="text-center font-semibold">
                <h1 class="text-3xl">
                    <span>Paket Wi-fi Rumahan</span>
                </h1>
                <p class="pt-6 text-md text-gray-400 font-normal w-full px-8 md:w-full">
                    Kami juga menyediakan layanan wifi untuk rumah, toko ataupun cafe anda.
                    Berikut ini adalah layanan dan biaya paket wi-fi yang bisa anda pilih.
                </p>
            </div>
            <div class="pt-24 flex flex-row">
                <!-- Basic Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pr-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Starter</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">Rp. </span>
                        <span class="text-3xl font-semibold">110.000</span>
                        <span class="text-gray-400 font-medium">/ bulan</span>
                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Get started with <span class="text-black">3 Mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Free <span class="text-black">Maintenance</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">No</span> FUP
                            </span>
                        </p>

                        <a href="https://wa.me/6287828496000" target="_blank" class="">
                            <p class="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                  Pasang Sekarang
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
                <!-- StartUp Card -->
                <div class="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform scale-125">
                    <h1 class="text-white font-semibold text-2xl">Personal</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">Rp. </span>
                        <span class="text-3xl font-semibold">165.000</span>
                        <span class="text-gray-400 font-medium">/ bulan</span>
                    </p>
                    <hr class="mt-4 border-1 border-gray-600">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                All features in <span class="text-white">5 Mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Free <span class="text-white">Maintenance</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">No</span> FUP
                            </span>
                        </p>

                        <a href="https://wa.me/6287828496000" target="_blank" class="">
                            <p class="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                  Pasang Sekarang
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                    <div class="absolute top-4 right-4">
                        <p class="bg-blue-700 font-semibold px-4 py-1 rounded-full uppercase text-xs">Popular</p>
                    </div>
                </div>
                <!-- Enterprise Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pl-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Ultimate</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">Rp. </span>
                        <span class="text-3xl font-semibold">200.000</span>
                        <span class="text-gray-400 font-medium">/ bulan</span>
                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                All features in <span class="text-black">10 Mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Free <span class="text-black">Maintenance</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">No</span> FUP
                            </span>
                        </p>


                        <a href="https://wa.me/6287828496000" target="_blank" class="">
                            <p class="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                  Pasang Sekarang
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
