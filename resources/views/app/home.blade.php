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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Leaflet 
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA47WQlqotqlPlvoVmeO7xCoIW4NKiC7jw"></script>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">
    <title>Home</title>
</head>

<body>
    @include('layouts.navbar')
    <div>
        <div class="container mx-auto pt-32" style="padding-bottom: 30px">
            <div class="max-w-screen-lg mx-auto flex">
                <!-- Galeria (lado esquerdo) -->
                <div class="w-1/2 pr-8 relative">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        <div class="relative h-50 overflow-hidden md:h-120 rounded-lg">
                            @foreach ($list_news as $index => $news)
                                <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out"
                                    data-carousel-item>
                                    <img src="{{ asset('storage/' . $news->im_capa) }}"
                                        class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="...">
                                    <div
                                        class="absolute inset-0 flex flex-col items-start justify-end text-white z-10 pb-10 pl-5">
                                        <h2 class="md:text-3xl text-3xl font-extrabold text-left uppercase"
                                            style="text-shadow: rgb(0, 0, 0) 1px 0 10px;">{{ $news->nm_titulo }}</h2>
                                        <div class="bg-blue-700 p-1.5">
                                            <p class="text-white text-sm text-left">
                                                {{ \Carbon\Carbon::parse($news->dt_noticia)->translatedFormat('j \d\e F \d\e Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            @foreach ($list_news as $index => $news)
                                <button type="button"
                                    class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-gray-300' }}"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"
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
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
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
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Lista de outras notícias (lado direito) -->
                <div class="w-1/2 pl-8" style="height: 600px;">
                    <h2 class="text-2xl font-bold flex items-center dark:text-white m-10">Outras notícias</h2>
                    <div class="space-y-4" id="news-list">
                        @foreach ($other_news as $index => $noticia)
                            <!-- Exibir apenas as outras notícias (excluindo a primeira) -->
                            @if ($index !== 0 && $index > 2)
                                <div class="border-b border:gray-100  p-4 news-item">
                                    <h3 class="text-lg font-semibold">{{ $noticia->nm_titulo }}</h3>
                                    <div class="calendario">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="#787878"
                                                d="M7 11h2v2H7zm14-6v14c0 1.11-.89 2-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h1V1h2v2h8V1h2v2h1a2 2 0 0 1 2 2M5 7h14V5H5zm14 12V9H5v10zm-4-6v-2h2v2zm-4 0v-2h2v2zm-4 2h2v2H7zm8 2v-2h2v2zm-4 0v-2h2v2z" />
                                        </svg>
                                        <p class="text-gray-500 text-sm">
                                            {{ \Carbon\Carbon::parse($noticia->dt_noticia)->translatedFormat('j \d\e F \d\e Y') }}
                                        </p>
                                    </div>
                                    <!-- Breve descrição ou resumo da notícia -->
                                    <p class="text-gray-700">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($noticia->ds_conteudo), 100) }}
                                    </p>
                                    <!-- Link para a notícia completa -->
                                    <form action="{{ route('app.noticia.detalhes', ['id' => $noticia->id_noticia]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="news_id" value="{{ $noticia->id_noticia }}">
                                        <button type="submit" class="text-blue-600 hover:underline">Ver mais</button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Botões para navegar entre as notícias -->
                    <div class="mt-4">
                        <button id="prev-btn"
                            class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800">Anterior</button>
                        <button id="next-btn"
                            class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800">Próxima</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-1 p-25">
            <div id="eventos" class="flex-1 ml-64 p-2 area">
                <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Eventos da região</h1>
            </div>
            <div id="eventos" class="flex-1 ml-64 p-6 area">
                @foreach ($list_event as $event)
                    <div class="card-event relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <h5 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $event->nm_evento }}
                            </h5>
                            <h6 class="mb-2 block font-sans text-l font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased flex center">
                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#fff" d="M7 11h2v2H7zm14-6v14c0 1.11-.89 2-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h1V1h2v2h8V1h2v2h1a2 2 0 0 1 2 2M5 7h14V5H5zm14 12V9H5v10zm-4-6v-2h2v2zm-4 0v-2h2v2zm-4 2h2v2H7zm8 2v-2h2v2zm-4 0v-2h2v2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($event->dt_evento_inicio)->translatedFormat('j \\d\\e F \\d\\e Y') }}                                                            
                            </h6>
                            <h6 class="mb-2 block font-sans text-l font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased flex center">
                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24">
                                    <path fill="#fff" d="M7 11h2v2H7zm14-6v14c0 1.11-.89 2-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h1V1h2v2h8V1h2v2h1a2 2 0 0 1 2 2M5 7h14V5H5zm14 12V9H5v10zm-4-6v-2h2v2zm-4 0v-2h2v2zm-4 2h2v2H7zm8 2v-2h2v2zm-4 0v-2h2v2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($event->dt_evento_fim)->translatedFormat('j \\d\\e F \\d\\e Y') }}                                                            
                            </h6> 
                            <h6
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Local: {{ $event->nm_unidade }}
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="p-25">
            <div id="modalidades" class="flex-1 ml-64 p-2 area">
                <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Atividades Esportivas</h1>
            </div>
            <div id="modalidades-content" class="flex-1 ml-64 p-6 area">
                @foreach ($list_mod as $index => $mod)
                    <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md modalidade-item {{ $index >= 8 ? 'hidden' : '' }}"
                        style="margin: 5px; flex-basis: calc(17% - 10px);" data-index="{{ $index }}">
                        <div class="p-6">
                            <form action="{{ route('app.modalidade.detalhes', ['id' => $mod->id_modalidade]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $mod->id_modalidade }}">
                                <button type="submit" class="custom-button">
                                    <h5 class="text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                        {{ $mod->nm_modalidade }}
                                    </h5>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($list_mod) > 8)
                <div class="flex justify-center mt-4 ">
                    <button onclick="showMore()" class="custom-button">
                        <div class="flex flex-col items-center justify-center">
                            <h5 class="text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            Veja mais                            
                            </h5>
                            <svg class="w-6 h-6 text-gray-800 dark:text-white pb-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                            </svg>
                        </div>                   
                    </button>
                </div>
            @endif
        </div>
        

        <div class="bg-1 p-25">
            <div id="unidades" class="flex-1 ml-64 p-2 unidade">
                <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">Endereço das Unidades</h1>
            </div>
            <div id="unidades" class="flex-1 ml-64 p-6 unidade">
                <div class="flex flex-wrap card-unidade">
                    @foreach ($list_unid as $unid)
                        <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md" style="margin: 5px">
                            <div class="p-6">
                                <form action="{{ route('app.unidade.detalhes', ['id' => $unid->id_unidade]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="unid_id" value="{{ $unid->id_unidade }}">
                                    <button type="submit" class="custom-button">
                                        <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                            {{ $unid->nm_unidade }}
                                        </h5>
                                        <h6 class="mb-2 block font-sans font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                            {{ $unid->ds_endereco }}
                                        </h6>
                                    </button>
                                </form>
                                
                                <div class="hidden" data-endereco="{{ $unid->ds_endereco }}"
                                    data-municipio="{{ $user_data->nm_usuario }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- <div id="map" class="rounded" style="width: 600px; height: 400px;"></div>-->
            </div>
        </div>
    </div>

    @include('layouts.footer')
    </div>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/newsbtn.js') }}"></script>
    <script>
        let currentIndex = 8;

        function showMore() {
            const items = document.querySelectorAll('.modalidade-item.hidden');
            for (let i = 0; i < 8 && currentIndex < items.length + 8; i++) {
                if (items[i]) {
                    items[i].classList.remove('hidden');
                }
                currentIndex++;
            }
        }
    </script>
</body>

</html>
