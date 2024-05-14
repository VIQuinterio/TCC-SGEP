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
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">
    <title>Modalidades</title>
</head>

<body>
    @include('layouts.navbar')
    <div class="flex-1 ml-50 p-8 pt-32">
        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
            <form action="{{ route('app.modalidade.buscar') }}" method="GET" class="flex items-center">
                <label for="buscar" class="sr-only">Buscar</label>
                <div class="relative w-full">
                    <label for="buscar" class="sr-only">Buscar</label>
                        <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                    <input type="text" name="buscar" id="buscar" style="width: 300px;"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Procurar modalidade. Exemplo: Futsal" required>
                </div>                
            </form>
            <button type="button" data-modal-target="abrir-modal" data-modal-toggle="abrir-modal"
            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Adicionar Modalidade
            </button>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr style="background-color: #0B3142; color:aliceblue;">
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nome
                        <a href="{{ route('app.modalidade.index', ['sort' => 'nome', 'direction' => 'asc']) }}" class="sort-link">
                                <span class="sort-arrow sorts asc" data-sort="nome" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.modalidade.index', ['sort' => 'nome', 'direction' => 'desc']) }}" class="sort-link">
                                <span class="sort-arrow sorts desc" data-sort="nome" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                        <a href="{{ route('app.modalidade.index', ['sort' => 'descricao', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="descricao" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.modalidade.index', ['sort' => 'descricao', 'direction' => 'desc']) }}" class="sort-link">
                                <span class="sort-arrow sorts desc" data-sort="descricao" data-direction="desc">&#8595;</span>
                        </a> 
                    </th><!--
                    <th scope="col" class="px-6 py-3">
                        Unidade
                        <a href="{{ route('app.modalidade.index', ['sort' => 'unidade', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="unidade" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.modalidade.index', ['sort' => 'unidade', 'direction' => 'desc']) }}" class="sort-link">
                                <span class="sort-arrow sorts desc" data-sort="unidade" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>-->
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($resultados_busca) && count($resultados_busca) > 0)
                        @foreach ($resultados_busca as $mod)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $mod->nm_modalidade }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $mod->ds_modalidade }}
                                </td>
                                <!--<td class="px-6 py-4 w-auto">
                                    { $mod->nm_unidade }}
                                </td>-->
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <button type="button" data-modal-target="edit-modal{{$mod->id_modalidade}}" data-modal-toggle="edit-modal{{$mod->id_modalidade}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/>
                                            </svg>
                                        </button>

                                        <form
                                            action="{{ route('app.modalidade.excluir', ['id' => $mod->id_modalidade]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="mod_id" value="{{ $mod->id_modalidade }}">

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
                        @foreach ($list_mods as $mod)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $mod->nm_modalidade }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $mod->ds_modalidade }}
                                </td>
                                <!--<td class="px-6 py-4 w-auto">
                                    { $mod->nm_unidade }}
                                </td>-->
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">                                                                                
                                        <button type="button" data-modal-target="edit-modal{{$mod->id_modalidade}}" data-modal-toggle="edit-modal{{$mod->id_modalidade}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/>
                                            </svg>
                                        </button>
                                                                                                                                                            
                                        <form action="{{ route('app.modalidade.excluir', ['id' => $mod->id_modalidade]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="mod_id" value="{{ $mod->id_modalidade }}">

                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="#DC262E" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
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
                {{ $list_mods->appends(['sort' => request()->input('sort'), 'direction' => request()->input('direction')])->links('layouts.custom-pagination') }}
            @endif
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($resultados_busca) && count($resultados_busca) > 0)
        @foreach ($resultados_busca as $mod)
        @include('app.modalidade.editar')
        @endforeach
    @else
        @foreach ($list_mods as $mod)
        @include('app.modalidade.editar')
        @endforeach
    @endif



    <!-- Main modal -->
    @extends('layouts.modal')
    @section('titulo', 'Cadastrar Modalidade')
        @section('form')
            <form class="space-y-4" action="{{ route('app.modalidade.cadastro') }}" method="POST">
                @csrf
                <div>
                    <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                    <input type="text" name="nome" id="nome"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="descricao"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                    <input type="text" name="descricao" id="descricao"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <!--<div>
                    <label for="unidade"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unidade</label>
                        <select id="unidade" name="id_unidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            foreach ($list_unidades as $unidade)
                                <option value="{ $unidade->id_unidade }}">{ $unidade->nm_unidade }}</option>
                            endforeach
                        </select>
                </div>
                 Rodapé do Modal -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar</button>
                    <button data-modal-hide="abrir-modal" type="button"
                        class="ml-5 ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                </div>
            </form>
        @endsection

        <script>
            document.addEventListener('click', function(event) {
                var modals = document.querySelectorAll('[id^="edit-modal"]');
                modals.forEach(function(modal) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        </script>
        <script src="{{asset('js/modal.js')}}"></script>

        <script src="{{asset('js/form.js')}}"></script>
</body>

</html>