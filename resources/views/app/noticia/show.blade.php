<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <!--<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    
    <!-- Quill -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.3/dist/quill.snow.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">
    <title>{{ $news_data->nm_titulo}}</title>
</head>

<body>
    @include('layouts.navbar')
    <main class="pt-32">

        <div class="container mx-auto">
            <div class="max-w-screen-lg mx-auto">
                <!-- Capa da notícia -->
                <img src="{{ asset('storage/' . $news_data->im_capa) }}" alt="Capa da notícia" class="w-full mb-8 rounded-lg shadow-lg">
    
                <!-- Data da notícia -->
                <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($news_data->dt_noticia)->translatedFormat('j \d\e F \d\e Y') }}</p>
    
                <!-- Título da notícia -->
                <h1 class="text-3xl font-semibold mt-4 mb-8">{{ $news_data->nm_titulo }}</h1>
    
                <!-- Conteúdo da notícia -->
                <div class="prose prose-lg">
                    {!! $news_data->ds_conteudo !!}
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footer')
</body>
</html>