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

                <h1 class="text-5xl font-semibold mt-8 mb-8">{{ $news_data->nm_titulo }}</h1>

                <h5 class="text-gray">{{$news_data->nm_autor}}</h5>
                <div class="calendario news-data rounded mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#5c5c5c" d="M7 11h2v2H7zm14-6v14c0 1.11-.89 2-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h1V1h2v2h8V1h2v2h1a2 2 0 0 1 2 2M5 7h14V5H5zm14 12V9H5v10zm-4-6v-2h2v2zm-4 0v-2h2v2zm-4 2h2v2H7zm8 2v-2h2v2zm-4 0v-2h2v2z"/></svg>
                    <p class="ml-1 text-gray text-sm news-text">{{ \Carbon\Carbon::parse($news_data->dt_noticia)->translatedFormat('j \d\e F \d\e Y') }}</p>
                </div>
                
                <div class="content-capa">
                    <img src="{{ asset('storage/' . $news_data->im_capa) }}" alt="Capa da notícia" class="capa mb-5 rounded-lg shadow-lg object-cover">
                    <legend>{{$news_data->ds_legenda}}</legend>
                </div>
            
                <div class="truncate pt-5">
                    {!! str_replace('contenteditable="true"', '', $news_data->ds_conteudo) !!}
                </div>
                
            </div>
        </div>
    </main>
    @include('layouts.footer')
</body>
</html>