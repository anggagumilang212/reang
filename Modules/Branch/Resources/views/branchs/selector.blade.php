@extends('layouts.app')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://api.fontshare.com/v2/css?f[]=clash-display@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet">
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Pilih Cabang Toko</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($branches as $branch)
            <div class="relative">
                <div class="border-2 border-transparent hover:border-blue-500 rounded-lg shadow-lg transition-all duration-300 bg-white p-6 cursor-pointer h-full flex flex-col items-center">
                    <div class="flex justify-center items-center mb-4">
                        <i class="c-sidebar-nav-icon bi bi-shop-window text-5xl text-blue-500 mb-4" style="line-height: 1;"></i>
                    </div>

                    <div class="text-center mb-16">
                        <h3 class="text-lg font-semibold mb-2">{{ $branch->name }}</h3>
                        <p class="text-gray-600">{{ $branch->address }}</p>
                    </div>

                    <form action="{{ route('branch.set') }}" method="POST" class="absolute bottom-6 left-0 right-0 px-6">
                        @csrf
                        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">
                            Pilih
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <style>
        .branch-card {
            transition: transform 0.3s ease;
        }

        .branch-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection
