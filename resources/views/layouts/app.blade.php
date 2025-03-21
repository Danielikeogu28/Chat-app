<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    {{-- contact on click --}}
    <meta name="selected_contact" content="">
    {{-- broadcasting --}}
    <meta name="auth_id" content="{{ auth()->user()?->id }}">
    <meta name="base_url" content="{{ url('/') }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>



    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>

    {{ $slot }}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/wobble.js"></script>

    {{ $scripts ?? '' }}
</body>

</html>
