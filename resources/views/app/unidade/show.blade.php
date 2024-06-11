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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA47WQlqotqlPlvoVmeO7xCoIW4NKiC7jw"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel.css') }}">
    <title>{{ $unid_data->nm_unidade}}</title>
</head>

<body class="flex flex-col min-h-screen">
    @include('layouts.navbar')
    <main class="flex-1 pt-32">
        <div class="container mx-auto mb-10">
            <div class="max-w-screen-lg mx-auto">
                <h1 class="flex text-5xl font-extrabold dark:text-white m-10">{{ $unid_data->nm_unidade }}</h1>
                <div class="mb-8 mt-3">
                    <h5 class="text-xl text-gray-700">Endereço: {{ $unid_data->ds_endereco }}</h5>
                    <h5 class="text-xl text-gray-700">Contato: {{ $unid_data->ds_contato }}</h5>
                    <h5 class="text-xl text-gray-700">Secretária: {{ $unid_data->ds_secretaria }}</h5>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Detalhes das Modalidades -->
                    <div class="p-6">
                        @foreach ($groupedModalidades as $nomeModalidade => $modalidades)
                            <div class="mb-4">
                                <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $nomeModalidade }}</h3>
                                @foreach ($modalidades as $modalidade)
                                    <div class="text-gray-700 mb-2">
                                        <p>Dia: {{ $modalidade->ds_dia_semana }}</p>
                                        <p>Horário: {{ $modalidade->ds_horario }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="hidden" id="endereco" data-endereco="{{ $unid_data->ds_endereco }}" data-municipio="{{ $user_data->nm_usuario }}"></div>
                    <!-- Localização no Mapa -->
                    <div class="p-6">
                        <div id="map" class="rounded" style="width: 600px; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>              
        @include('layouts.footer')
    </main>    
    <script src="{{ asset('js/mapUnid.js') }}"></script>
</body>
</html>