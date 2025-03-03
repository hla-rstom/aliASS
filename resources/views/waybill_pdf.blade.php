<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge PDF Waybill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #333;
        }

        .pdf-viewer {
            margin-top: 20px;
        }

        iframe {
            width: 80%;
            height: 600px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Merge PDF Waybill</h1>
        <div class="pdf-viewer">
            <iframe src="{{ $url }}" frameborder="0"></iframe>
        </div>
    </div>
</body>

</html>
