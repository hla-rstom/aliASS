<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Barcodes</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .barcode-container {
            margin-top: 50px;
        }

        .barcode {
            display: inline-block;
            margin: 0 auto;
            padding: 10px;
        }

        .barcode img {
            width: 100%;
            height: auto;
            margin-top: 5px;
        }

        .product-name {
            font-size: 12px;
            font-weight: bold;
            word-wrap: break-word;
            margin: 0 auto;
            text-align: center;
            max-width: 220px;
        }

        .product-sku {
            font-size: 10px;
            font-family: monospace;
            display: block;
            letter-spacing: 12px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
</head>

<body>
    @foreach ($barcodes as $barcodeData)
    <div class="barcode-container">
        <div class="product-name">{{ $barcodeData['name'] }}</div> <!-- Product name above barcode -->
        <div class="barcode">
            {!! $barcodeData['barcode'] !!}
        </div>
        <div class="product-sku">{{ $barcodeData['sku'] }}</div> <!-- Product SKU below barcode -->
    </div>
    @endforeach
</body>

</html>