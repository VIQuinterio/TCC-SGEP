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
    <title>Notícias</title>
</head>

<body>
    @include('layouts.navbar')
    <div class="flex-1 ml-50 p-8 pt-32">
        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
            <form action="{{ route('app.noticia.buscar') }}" method="GET" class="flex items-center">
                <label for="buscar" class="sr-only">Buscar</label>
                <div class="relative w-full">
                    <label for="buscar" class="sr-only">Buscar</label>
                    <div
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="buscar" id="buscar" style="width: 300px;"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Procurar notícia. Exemplo: 2024-07-12" required>
                </div>
            </form>
            <button type="button" data-modal-target="abrir-modal" data-modal-toggle="abrir-modal"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Adicionar Notícia
            </button>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr style="background-color: #0B3142; color:aliceblue;">
                    <th scope="col" class="px-6 py-3 text-l">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Título
                        <a href="{{ route('app.noticia.index', ['sort' => 'titulo', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="titulo" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.noticia.index', ['sort' => 'titulo', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="titulo" data-direction="desc">&#8595;</span>
                        </a>                                                
                    </th>                    
                    <th scope="col" class="px-6 py-3">
                        Conteúdo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data
                        <a href="{{ route('app.noticia.index', ['sort' => 'data', 'direction' => 'asc']) }}"class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="data" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.noticia.index', ['sort' => 'data', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="data" data-direction="desc">&#8595;</span>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($resultados_busca) && count($resultados_busca) > 0)
                        @foreach ($resultados_busca as $news)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $news->nm_titulo }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <div class="noticia">
                                        <h2>{{ $news->nm_titulo }}</h2>
                                        <div class="conteudo">
                                            {!! substr(strip_tags($news->ds_conteudo), 0, 200) !!}
                                            <!-- Exibe apenas os primeiros 200 caracteres sem tags HTML -->
                                            @if (strlen(strip_tags($news->ds_conteudo)) > 200)
                                                ...
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $news->dt_noticia }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <button type="button" data-modal-target="edit-modal{{ $news->id_noticia }}"
                                            data-modal-toggle="edit-modal{{ $news->id_noticia }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="#2563EB"
                                                    d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z" />
                                            </svg>
                                        </button>

                                        <form action="{{ route('app.noticia.excluir', ['id' => $news->id_noticia]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $news->id_noticia }}">

                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="#DC262E"
                                                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                </svg></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($list_news as $news)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $news->nm_titulo }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <div class="noticia">
                                        <h2>{{ $news->nm_titulo }}</h2>
                                        <div class="conteudo">
                                            {!! substr(strip_tags($news->ds_conteudo), 0, 200) !!}
                                            <!-- Exibe apenas os primeiros 200 caracteres sem tags HTML -->
                                            @if (strlen(strip_tags($news->ds_conteudo)) > 200)
                                                ...
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ date('d-m-Y', strtotime($news->dt_noticia)) }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <button type="button" data-modal-target="edit-modal{{$news->id_noticia}}" data-modal-toggle="edit-modal{{$news->id_noticia}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/>
                                            </svg>
                                        </button>

                                        <form action="{{ route('app.noticia.excluir', ['id' => $news->id_noticia]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="news_id" value="{{ $news->id_noticia }}">

                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#DC262E"
                                                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('app.noticia.detalhes', ['id' => $news->id_noticia]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="news_id" value="{{ $news->id_noticia }}">

                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#41af53"
                                                        d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (isset($resultados_busca) && count($resultados_busca) > 0)
                {{ $resultados_busca->appends(['sort' => request()->input('sort'), 'direction' => request()->input('direction')])->links('layouts.custom-pagination') }}
            @else
                {{ $list_news->appends(['sort' => request()->input('sort'), 'direction' => request()->input('direction')])->links('layouts.custom-pagination') }}
            @endif
        </div>
    </div>
    <!--@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif-->
    @if (isset($resultados_busca) && count($resultados_busca) > 0)
        @foreach ($resultados_busca as $news)
            @include('app.noticia.editar')
        @endforeach
    @else
        @foreach ($list_news as $news)
            @include('app.noticia.editar')
        @endforeach
    @endif

    <!-- Main modal -->
    <div id="abrir-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full" style="max-width: 76rem;">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @yield('titulo')
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="abrir-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">@yield('titulo')</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('app.noticia.cadastro') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="titulo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                                <input type="text" name="titulo" id="titulo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="data"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                                <input type="date" name="data" id="data"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>

                            <div class="col-span-2">
                                <label for="imagem"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capa</label>
                                <input id="imagem" name="imagem" type="file"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                    dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="imagem" required>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="img">Formatos suportados: SVG, PNG,
                                    JPG ou JPEG</p>
                            </div>

                            <div class="col-span-2" style="margin-bottom: auto;">
                                <div id="toolbar-cadastro"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                    dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    style="border-bottom-right-radius: 0; border-bottom-left-radius: 0;">
                                    <span class="ql-formats">
                                        <select class="ql-font">
                                            <option class="ql-font-arial" value="arial" selected>Arial</option>
                                            <option class="ql-font-helvetica" value="helvetica">Helvetica</option>
                                            <option class="ql-font-impact" value="impact">Impact</option>
                                            <option value="monospace">Monospace</option>
                                            <option class="ql-font-roboto-mono" value="roboto-mono">Roboto Mono</option>
                                            <option value="sans-serif">Sans Serif</option>
                                            <option value="serif">Serif</option>
                                            <option class="ql-font-verdana" value="verdana">Verdana</option>
                                        </select>
                                        <select class="ql-size" style="width: 76px">
                                            <option value="small">Pequeno</option>
                                            <option selected></option>
                                            <option value="large">Grande</option>
                                            <option value="huge">Enorme</option>
                                        </select>
                                        <select class="ql-header" style="width: 76px">
                                            <option value="1">Título 1</option>
                                            <option value="2">Título 2</option>
                                            <option value="3">Título 3</option>
                                            <option value="4">Título 4</option>
                                            <option value="5">Título 5</option>
                                            <option value="6">Título 6</option>
                                            <option selected></option>
                                        </select>
                                    </span>

                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                        <button class="ql-blockquote"></button>
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                        <button class="ql-clean"></button>
                                    </span>

                                    <span class="ql-formats">
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-indent" value="-1"></button>
                                        <button class="ql-indent" value="+1"></button>
                                        <button class="ql-direction" value="rtl"></button>
                                        <button class="ql-align" value=""></button>
                                        <button class="ql-align" value="center"></button>
                                        <button class="ql-align" value="right"></button>
                                        <button class="ql-align" value="justify"></button>
                                    </span>

                                    <span class="ql-formats">
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        <button class="ql-video"></button>
                                    </span>
                                </div>

                                <div id="editor-cadastro"
                                    class="block w-full px-0 text-sm text-gray-800 px-4 py-2 bg-white rounded-b-lg 
                                        border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400">
                                </div>

                                <textarea th:field="*{content}" class="form-control" name="conteudo" style="display:none"
                                    id="hiddenTextarea-cadastro"></textarea>

                            </div>
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar</button>
                                <button data-modal-hide="abrir-modal" type="button"
                                    class="ml-5 ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                            </div>
                        </div>
                        <script src="{{ asset('js/quill.js') }}"></script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(event) {
            var modals = document.querySelectorAll('[id^="edit-modal"]');
            modals.forEach(function(modal) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        @foreach ($list_news as $news)
            var quill_{{ $news->id_noticia }} = new Quill('#editor-edicao-{{ $news->id_noticia }}', {
                modules: {
                    toolbar: '#toolbar-edicao-{{ $news->id_noticia }}'
                },
                placeholder: 'Escrever o conteúdo da notícia...',
                theme: 'snow'
            });                        
        @endforeach  
        
        document.addEventListener('DOMContentLoaded', function () {
            const sortArrows = document.querySelectorAll('.sort-arrow');

            sortArrows.forEach(arrow => {
                arrow.addEventListener('click', function (event) {
                    event.preventDefault();
                    const sortAttribute = this.dataset.sort;
                    let direction = this.dataset.direction;

                    // Alterna entre asc e desc
                    direction = direction === 'asc' ? 'desc' : 'asc';

                    // Atualiza a direção no dataset
                    this.dataset.direction = direction;

                    // Redireciona para a URL com os parâmetros atualizados
                    window.location.href = `{{ route('app.noticia.index') }}?sort=${sortAttribute}&direction=${direction}`;
                });
            });
        });

    </script>
    <script src="{{ asset('js/sort.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
