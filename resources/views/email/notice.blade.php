<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        img {
            width: 250px;
            display: inline-block;
        }
        .header {
            background: #f7f7f7;
            padding: 1.2em;
            text-align: center;
            border-bottom: 1px solid #dadada;
            margin-bottom: 2em
        }
        .section {
            margin: auto;
            max-width: 100%;
        }
        .messege + .messege {
            margin-top: 55px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{$logo}}" alt="RIG" srcset="">
    </div>
    <div class="section">
        @foreach($data AS $k => $v)
        <div class="messege">
            <p>{{$k}}:</p>
            <div>{!! $v !!}</div>
        </div>
        @endforeach
    </div>
</body>
</html>