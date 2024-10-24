<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>


<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
        <div class="text-center mb-6">
            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h1 class="text-2xl font-bold text-gray-800">Pembayaran Berhasil!</h1>
        </div>

        <div class="border-t border-b border-gray-200 py-4 mb-4">
            <div class="mb-3">
                <p class="text-gray-600">Kode Transaksi:</p>
                <p class="font-semibold">{{ $transaction->transaction_code }}</p>
            </div>

            <div class="mb-3">
                <p class="text-gray-600">Produk:</p>
                <p class="font-semibold">{{ $transaction->product->product_name }}</p>
            </div>

            <div class="mb-3">
                <p class="text-gray-600">Total Pembayaran:</p>
                <p class="font-semibold">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
            </div>

            <div class="mb-3">
                <p class="text-gray-600">Ambil Di Cabang:</p>
                <p class="font-semibold">{{ $transaction->branch->name }}</p>
            </div>
        </div>

        {{-- <div class="text-center">
            <button onclick="window.print()" class="bg-gradient-to-r from-orange-300 to-orange-400 text-white px-4 py-2 rounded hover:bg-blue-600">
                Cetak Bukti Pembayaran
            </button>
        </div> --}}
    </div>
</div>
</body>
<script>
    window.print();
</script>
</html>
