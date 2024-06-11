<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="openSidebar()">
        <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
    </span>
    <div class="flex">
        <div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 sidebar-container">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <h1 class="font-bold text-gray-200 text-[15px] ml-3">SGEP</h1>
                    <i class="bi bi-x cursor-pointer ml-28 lg:hidden" onclick="openSidebar()"></i>
                </div>
                <div class="my-2 bg-gray-600 h-[1px]"></div>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer text-white">
                <i class="bi bi-person-circle"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">{{ $user_data->nm_usuario }}</span>
            </div>
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-house-door-fill"></i>
                <a href="{{ route('admin.dashboard') }}"><span
                        class="text-[15px] ml-4 text-gray-200 font-bold">Home</span></a>
            </div>
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-file-earmark-text-fill"></i>
                <a href="{{ route('admin.cadastrar') }}"><span
                        class="text-[15px] ml-4 text-gray-200 font-bold">Cadastro</span></a>
            </div>
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
                style="position: absolute; bottom: 0; left: 14;">
                <i class="bi bi-box-arrow-in-right"></i>
                <a href="{{ route('admin.logout') }}"><span
                        class="text-[15px] ml-4 text-gray-200 font-bold">Sair</span></a>
            </div>
        </div>
    </div>
    <div class="flex-1 ml-64 p-8">
        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
            <form action="{{ route('admin.buscar') }}" method="get" class="flex items-center">
                <label for="voice-search" class="sr-only">Buscar</label>
                <div class="relative w-full">
                    <input type="text" name="nome" id="voice-search" style="width: 220px;"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Procurar cliente ou código" required>
                </div>
                <button type="submit"
                    class="ml-2 inline-flex items-center text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 custom-button">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>Buscar
                </button>
            </form>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr style="background-color: #0B3142; color:aliceblue;">
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">                        
                            <!-- Tipo-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16.5 12A2.5 2.5 0 0 0 19 9.5A2.5 2.5 0 0 0 16.5 7A2.5 2.5 0 0 0 14 9.5a2.5 2.5 0 0 0 2.5 2.5M9 11a3 3 0 0 0 3-3a3 3 0 0 0-3-3a3 3 0 0 0-3 3a3 3 0 0 0 3 3m7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75M9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13"/></svg>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('admin.dashboard', ['sort' => 'nm_usuario', 'direction' => 'asc']) }}">
                            <div class="flex items-center">
                                <!--Cliente-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 19.2c-2.5 0-4.71-1.28-6-3.2c.03-2 4-3.1 6-3.1s5.97 1.1 6 3.1a7.232 7.232 0 0 1-6 3.2M12 5a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-3A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10c0-5.53-4.5-10-10-10"/></svg>
                                
                                    <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg>
                                
                            </div>
                            </a>
                        </th>                                             
                        <th scope="col" class="px-6 py-3">
                            <!--Código-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2 3h20c1.05 0 2 .95 2 2v14c0 1.05-.95 2-2 2H2c-1.05 0-2-.95-2-2V5c0-1.05.95-2 2-2m12 3v1h8V6zm0 2v1h8V8zm0 2v1h7v-1zm-6 3.91C6 13.91 2 15 2 17v1h12v-1c0-2-4-3.09-6-3.09M8 6a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <!--Ação-->
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($resultados_busca) && count($resultados_busca) > 0)
                        @foreach ($resultados_busca as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 w-auto font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->sg_tipo }}
                                    </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->nm_usuario }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->cd_usuario }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <form action="{{ route('admin.editar', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                                            <button type="submit"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/></svg></button>
                                        </form>
                                        <form action="{{ route('admin.excluir', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#DC262E" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg></button>
                                        </form>
                                    </div>     
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($list_users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-auto">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->sg_tipo }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->nm_usuario }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    {{ $user->cd_usuario }}
                                </td>
                                <td class="px-6 py-4 w-auto">
                                    <!-- Modal Editar -->
                                    <div class="flex items-center">
                                        <form action="{{ route('admin.editar', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2563EB" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/></svg></button>
                                        </form>
                                        <form action="{{ route('admin.excluir', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#DC262E" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg></button>
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
                {{ $list_users->appends(['sort' => request()->input('sort'), 'direction' => request()->input('direction')])->links('layouts.custom-pagination') }}
            @endif
        </div>
    </div>
</body>

</html>
