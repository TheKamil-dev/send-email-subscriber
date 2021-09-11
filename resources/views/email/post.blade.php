<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post | {{$post->title}}</title>
</head>
<body style="font-size: 16px; max-width:670px; padding: 12px;">
    <h2>
        {{$post->title}}
    </h2>
    <div style="padding: 12px 20px;">
        {{$post->description}}
    </div>
    <footer>
        {{config('app.name')}}
    </footer>
</body>
</html>
