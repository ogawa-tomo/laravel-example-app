<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Message Sample</title>
</head>
<body>
    <main>
        <h1>メッセージ</h1>
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message->body }}</li>
            @endforeach
        </ul>
    </main>
</body>
</html>