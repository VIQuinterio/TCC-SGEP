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
    <title>Detalhes Notícia</title>
</head>

<body bgcolor="#F9F6ED">
    @include('layouts.navbar')
    <main class="mt-10">

        <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
            <div class="absolute left-0 bottom-0 w-full h-full z-10" style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
            <img src="{{ asset('storage/'.$news_data->im_capa) }}" class="absolute left-0 top-0 w-full h-full z-0 object-cover" />
            <div class="p-4 absolute bottom-0 left-0 z-20">
                <a href="#" class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2"></a>
                <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                    {{ $news_data->nm_titulo}}
                </h2>
                <div class="flex mt-3">
                    <div>
                        <p class="font-semibold text-gray-400 text-xs">
                            {{ date('d-m-Y', strtotime( $news_data->dt_noticia)) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 lg:px-0 mt-12 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed" >
            {!! $news_data->ds_conteudo !!} 
        </div>
    </main>
</body>
</html>