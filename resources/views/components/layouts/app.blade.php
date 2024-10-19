<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c393acf5ae.js" crossorigin="anonymous"></script>
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>

</body>
@livewire('nav')
<main>
    {{ $slot }}
</main>
<x-footer />

</html>
