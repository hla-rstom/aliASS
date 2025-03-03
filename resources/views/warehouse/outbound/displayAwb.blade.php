<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display AWBs</title>
</head>

<body>
    @foreach($waybillPaths as $waybillPath)
    <div style="page-break-after: always;">

        <iframe src="{{ $waybillPath }}" style="width:100%; height:100vh;" frameborder="0"></iframe>
    </div>
    @endforeach

</body>

</html>