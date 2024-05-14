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
    <title>Unidades</title>
</head>

<body>
    @include('layouts.navbar')
    <div class="flex-1 ml-50 p-8 pt-32">
        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
            <form action="{{ route('app.unidade.buscar') }}" method="GET" class="flex items-center">
                <label for="buscar" class="sr-only">Buscar</label>
                <div class="relative w-full">
                    <label for="buscar" class="sr-only">Buscar</label>
                        <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                    <input type="text" name="buscar" id="buscar" style="width: 300px;"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Procurar unidade. Exemplo: Ginásio Sol" required>
                </div>                
            </form>
            <button type="button" data-modal-target="abrir-modal" data-modal-toggle="abrir-modal"
            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Adicionar Unidade
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
                        <a href="{{ route('app.unidade.index', ['sort' => 'unidade', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="unidade" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.unidade.index', ['sort' => 'unidade', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="unidade" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telefone
                        <a href="{{ route('app.unidade.index', ['sort' => 'contato', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="contato" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.unidade.index', ['sort' => 'contato', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="contato" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Endereço
                        <a href="{{ route('app.unidade.index', ['sort' => 'endereco', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="endereco" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.unidade.index', ['sort' => 'endereco', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="endereco" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modalidade
                        <a href="{{ route('app.unidade.index', ['sort' => 'endereco', 'direction' => 'asc']) }}" class="sort-link">
                            <span class="sort-arrow sorts asc" data-sort="endereco" data-direction="asc">&#8593;</span>
                        </a>
                        <a href="{{ route('app.unidade.index', ['sort' => 'endereco', 'direction' => 'desc']) }}" class="sort-link">
                            <span class="sort-arrow sorts desc" data-sort="endereco" data-direction="desc">&#8595;</span>
                        </a> 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($resultados_busca) && count($resultados_busca) > 0)
                        @foreach ($resultados_busca as $unid)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->nm_unidade }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->ds_contato }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->ds_endereco }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <button type="button" data-modal-target="edit-modal{{$unid->id_unidade}}" data-modal-toggle="edit-modal{{$unid->id_unidade}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/>
                                            </svg>
                                        </button>

                                        <form
                                            action="{{ route('app.unidade.excluir', ['id' => $unid->id_unidade]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="unid_id" value="{{ $unid->id_unidade }}">

                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="#DC262E"
                                                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                </svg></button>
                                        </form>

                                        <form action="{{ route('app.unidade.detalhes', ['id' => $unid->id_unidade]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="unid_id" value="{{ $unid->id_unidade }}">

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
                    @else
                        @foreach ($list_unid as $unid)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->nm_unidade }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->ds_contato }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $unid->ds_endereco }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    @foreach ($unid->modalidades as $modalidade)
                                    {{ $modalidade->nm_modalidade }}
                                @endforeach
                                </td>

                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">                                                                                
                                        <button type="button" data-modal-target="edit-modal{{$unid->id_unidade}}" data-modal-toggle="edit-modal{{$unid->id_unidade}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="event.stopPropagation()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/>
                                            </svg>
                                        </button>
                                                                                                                                                            
                                        <form action="{{ route('app.unidade.excluir', ['id' => $unid->id_unidade]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="unid_id" value="{{ $unid->id_unidade }}">

                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="#DC262E" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('app.unidade.detalhes', ['id' => $unid->id_unidade]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="unid_id" value="{{ $unid->id_unidade }}">

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
                {{ $list_unid->appends(['sort' => request()->input('sort'), 'direction' => request()->input('direction')])->links('layouts.custom-pagination') }}
            @endif
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($resultados_busca) && count($resultados_busca) > 0)
        @foreach ($resultados_busca as $unid)
            @include('app.unidade.editar')
        @endforeach
    @else
        @foreach ($list_unid as $unid)
            @include('app.unidade.editar')
        @endforeach
    @endif



    <!-- Main modal -->
    @extends('layouts.modal')
    @section('titulo', 'Cadastrar Unidade')
        @section('form')
            <form class="space-y-4" action="{{ route('app.unidade.cadastro') }}" method="POST">
                @csrf
                <div>
                    <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                    <input type="text" name="nome" id="nome"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="endereco"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Endereço</label>
                    <input type="text" name="endereco" id="endereco"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="contato"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                    <input type="tel" name="contato" id="contato"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <p>Selecione as modalidades e insira o horário de aula para cada uma:</p>
                    @foreach ($list_modalidades as $modalidade)
                        <div class="flex items-center me-4">
                            <input id="modalidade_{{ $modalidade->id_modalidade }}" type="checkbox" name="modalidades[]" value="{{ $modalidade->id_modalidade }}" 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 
                            dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox-trigger">
                            <label for="modalidade_{{ $modalidade->id_modalidade }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $modalidade->nm_modalidade }}</label>
                            <!-- Campo de entrada para o horário de aula (inicialmente oculto) -->
                            <input type="text" name="horario_{{ $modalidade->id_modalidade }}" placeholder="Horário de aula" 
                            class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                            focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 
                            dark:placeholder-gray-400 dark:text-white hidden hora-input">
                        </div>
                    @endforeach

                </div>

                <!-- Rodapé do Modal -->
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

            document.addEventListener('click', function(event) {
                var checkboxes = document.querySelectorAll('.checkbox-trigger');
                checkboxes.forEach(function(checkbox) {
                    if (event.target.id === checkbox.id || event.target.htmlFor === checkbox.id) {
                        var horarioInput = checkbox.nextElementSibling.nextElementSibling;
                        if (checkbox.checked) {
                            horarioInput.classList.remove('hidden');
                        } else {
                            horarioInput.classList.add('hidden');
                        }
                    }
                });
            });

        </script>
        <script src="{{asset('js/modal.js')}}"></script>

        
</body>

</html>