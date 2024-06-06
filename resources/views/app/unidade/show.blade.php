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
        
                    <!-- Localização no Mapa -->
                    <div class="p-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14581.661438729845!2d-46.3000647!3d-23.9811055!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce023de24d95ab%3A0xcd45b652cdd33981!2sComplexo%20Esportivo%20e%20Recreativo%20Rebou%C3%A7as!5e0!3m2!1spt-BR!2sbr!4v1715549784784!5m2!1spt-BR!2sbr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        
        
        @include('layouts.footer')
    </main>    
    
</body>
</html>