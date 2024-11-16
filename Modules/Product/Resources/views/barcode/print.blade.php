<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcodes</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
    <style>
        .barcode-container svg {
            width: 100px !important;
            height: 30px !important;
        }

        .col-xs-3 {
            width: 120px !important;
            /* Ukuran fixed width yang lebih kecil */
            padding: 2px !important;
            margin: 0 !important;
            float: left;
        }

        .row {
            margin: 0 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            @foreach ($barcodeData as $data)
                <div class="col-xs-3" style="border: 1px solid #dddddd;border-style: dashed;">
                    <p style="font-size: 10px;color: #000;margin-top: 5px;margin-bottom: 2px;text-align:center;">
                        {{ $data['name'] }}
                    </p>
                    <div class="barcode-container">
                        {{-- {!! $data['barcode'] !!} --}}
                        <img src="{{ $data['barcode'] }}" alt="Barcode"
                            style="width: 100px; height: 30px; margin-left:10px">
                    </div>
                    <p style="font-size: 10px;color: #000;font-weight: bold;text-align:center;">
                        {{ format_currency($data['price']) }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
