<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcodes</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .page-container {
            width: 100%;
            padding: 0;
            margin: 0;
        }
        .barcode-container svg {
            width: 80px !important;
            height: 25px !important;
        }
        .col-xs-3 {
            width: 90px !important; /* Sedikit dikecilkan */
            padding: 1px !important;
            margin: 0 !important;
            float: left;
        }
        .row {
            margin: 0 !important;
            padding: 0 !important;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .product-name {
            font-size: 8px !important;
            color: #000;
            margin-top: 3px !important;
            margin-bottom: 1px !important;
            text-align: center;
        }
        .price {
            font-size: 8px !important;
            color: #000;
            font-weight: bold;
            text-align: center;
            margin-top: 1px;
        }
        .barcode-img {
            width: 80px;
            height: 25px;
            margin-left: 4px; /* Dikurangi dari 8px */
        }
    </style>
</head>
<body>
<div class="page-container">
    <div class="row">
        @foreach($barcodeData as $data)
            <div class="col-xs-3" style="border: 1px solid #dddddd;border-style: dashed;">
                <p class="product-name">
                    {{ $data['name'] }}
                </p>
                <div class="barcode-container">
                    <img src="{{ $data['barcode'] }}" alt="Barcode" class="barcode-img">
                </div>
                <p class="price">
                    {{ format_currency($data['price']) }}
                </p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
