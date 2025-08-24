<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Drama Bang' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/output.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="flex justify-center min-h-screen overflow-hidden text-light font-montserrat">
<div class="max-w-[760px] pb-24 h-screen w-full bg-primary overflow-y-auto relative">
    {{ $slot }}

    <x-navbar />
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>
