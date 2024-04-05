<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <!--<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <title>Home</title>
</head>

<body>
    @include('layouts.navbar')
    <div>
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden md:h-96">
                @foreach ($list_news as $index => $news)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/' . $news->im_capa) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                @endforeach
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                @foreach ($list_news as $index => $news)
                    <button type="button" class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-gray-300' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
                        data-carousel-slide-to="{{ $index }}"></button>
                @endforeach
            </div>
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>


        <div>
            <div id="modalidades" class="flex-1 ml-64 p-2"
                style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
                <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Eventos da região</h1>
            </div>
            <div id="modalidades" class="flex-1 ml-64 p-6"
                style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
                @foreach ($list_event as $event)
                    <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md"
                        style="margin: 5px; flex-basis: calc(17% - 10px);">
                        <div class="p-6">
                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $event->nm_evento }}
                            </h5>
                            <h6
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $event->dt_evento }}
                            </h6>
                            <h6
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $event->nm_unidade }}
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bg-noticias">
            <div id="modalidades" class="flex-1 ml-64 p-2"
                style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
                <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Conheça nossas Atividades
                    Esportivas</h1>
            </div>
            <div id="modalidades" class="flex-1 ml-64 p-6"
                style="display: flex; flex-direction: row; margin: 5px; flex-wrap: wrap; justify-content:center;">
                @foreach ($list_mod as $mod)
                    <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md"
                        style="margin: 5px; flex-basis: calc(17% - 10px);">
                        <div class="p-6">
                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $mod->nm_modalidade }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="unidades" class="flex-1 ml-64 p-20" style="background: #737373; display: flex; flex-direction: row; margin: 5px; overflow: hidden; justify-content:center">
            <div class="flex flex-wrap" style="margin-right: 5px; max-height: 400px; overflow-y: auto; flex-direction: row; width: 441px;">
                @foreach ($list_unid as $unid)
                    <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md m-5">
                        <div class="p-6">
                            <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $unid->nm_unidade }}
                            </h5>
                            <h6 class="mb-2 block font-sans  font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $unid->ds_endereco }}
                            </h6>                            
                            <div class="hidden" data-endereco="{{ $unid->ds_endereco }}" data-municipio="{{ $user_data->nm_usuario }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="map" style="width: 600px; height: 400px;"></div>            
        </div>
        @include('layouts.footer')
    </div>
    <script src="{{ asset('js/map.js') }}"></script>
</body>

</html>
