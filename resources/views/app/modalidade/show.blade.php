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
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">
    <title>Esportes</title>
</head>
<body class="flex flex-col min-h-screen">
        @include('layouts.navbar')
        <main class="flex-1 pt-32">
            <div class="container mx-auto mb-10">
                <div class="max-w-screen-lg mx-auto">
                    <div id="modalidades" class="flex-1 p-3 area text-center">
                        <h1 class="flex items-center justify-center text-5xl font-extrabold dark:text-white m-10">ESPORTES</h1>                       
                    </div>
                    
                    <div class="container mx-auto pt-10">
                        <div class="max-w-screen-lg mx-auto">
                            <div class="flex">
                                <div class="w-1/3 text-center">
                                    @foreach ($list_mod as $mod)
                                        <form action="{{ route('app.modalidade.detalhes', ['id' => $mod->id_modalidade]) }}" method="POST" class="flex items-center justify-center mb-2">
                                            @csrf
                                            <input type="hidden" name="mod_id" value="{{ $mod->id_modalidade }}">
                                            <button type="submit" class="w-full">
                                                <div class="p-4 flex items-center" style="min-width: 250px;">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <h5 class="text-xl {{ $mod->id_modalidade == $mod_data->id_modalidade ? 'text-blue-900 font-bold' : 'text-gray-600 font-semibold' }} whitespace-nowrap">
                                                            {{ $mod->nm_modalidade }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                                <div class="ms-8 mr-8 divisao"></div>
                                <div class="w-2/3 container mx-auto">
                                    <div class="max-w-screen-lg mx-auto">
                                        <!--<h4 class="mb-4 text-2xl font-semibold text-center text-blue-900">Unidades que oferecem {{ $mod_data->nm_modalidade }}</h4>-->
                                        @foreach ($unidades as $nm_unidade => $detalhes)
                                            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                                                <h5 class="text-xl font-bold pb-2">{{ $nm_unidade }}</h5>
                                                @if (count($detalhes) > 0)
                                                    <p class="text-gray-700 mb-2">Endereço: {{ $detalhes[0]->ds_endereco }}</p>
                                                    <p class="text-gray-700 mb-4">Contato: {{ $detalhes[0]->ds_contato }}</p>
                                                @endif
                                                <div class="grid grid-cols-2 gap-4 border-t pt-4">
                                                    @foreach ($detalhes as $detalhe)
                                                        <div>
                                                            <p class="font-medium">Dia da Semana: <span class="text-gray-600">{{ $detalhe->ds_dia_semana }}</span></p>
                                                            <p class="font-medium">Horário: <span class="text-gray-600">{{ $detalhe->ds_horario }}</span></p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                                            
                </div>
            </div>  
        </main>
        <div class="navbar">
            <footer class="py-12  xl:pt-24">
                <div class="w-full px-4 mx-auto max-w-8xl">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                            <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">SGEP</span>
                        </a>
                        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0 dark:text-gray-400">
                            <li>
                                <a href="{{ route('app.noticia.index')}}" class="hover:underline me-4 md:me-6 mr-2">Notícias</a>
                            </li>
                            <li>
                                <a href="{{ route('app.modalidade.index')}}" class="hover:underline me-4 md:me-6 mr-2">Modalidades</a>
                            </li>
                            <li>
                                <a href="{{ route('app.evento.index')}}" class="hover:underline me-4 md:me-6">Eventos</a>
                            </li>
                            <li>
                                <a href="{{ route('app.unidade.index')}}" class="hover:underline me-4 md:me-6">Unidades</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                    <span class="block text-sm text-white sm:text-center dark:text-gray-400">© 2023 <a href="{{ route('app.home')}}" class="hover:underline">{{ $user_data->nm_usuario }}</a>.Todos os direitos reservados.</span>
                    <span class="block text-sm text-white sm:text-center dark:text-gray-400">Desenvolvido por  <a href="{{ route('home')}}" class="hover:underline">Fatecanos</a></span>
                </div>
            </footer>
        </div>
</body>
</html>