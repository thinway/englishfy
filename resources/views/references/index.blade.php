<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learnglish</title>
</head>
<body>
    <h1>New References</h1>

    <ul>
        @forelse($references as $reference)
            <li><a href="{{ $reference->path() }}">{{ $reference['term'] }}</a></li>
        @empty
            <li>No references yet.</li>
        @endforelse
    </ul>
</body>
</html>