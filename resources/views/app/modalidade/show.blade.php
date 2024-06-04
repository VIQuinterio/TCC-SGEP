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
<body>
    @include('layouts.navbar')
    <main class="pt-32">
        <div class="container mx-auto mb-10">
            <div class="max-w-screen-lg mx-auto">
                <div id="modalidades" class="flex-1 ml-64 p-2 area">
                    <h1 class="flex items-center text-5xl font-extrabold dark:text-white m-10">ESPORTES</h1>
                </div>
                <div style="display: grid;
                grid-template-rows: 1fr;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 0px;
                height: 100%;">
                    <div id="mod-horario">                
                        @foreach ($list_mod as $mod)
                            <form action="{{ route('app.modalidade.detalhes', ['id' => $mod->id_modalidade]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $mod->id_modalidade }}">
                                <button type="submit">
                                    <h5 class="text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal antialiased {{ $mod->id_modalidade == $mod_data->id_modalidade ? 'text-bold' : 'text-gray-400' }}">
                                        {{ $mod->nm_modalidade }}
                                    </h5>
                                </button>
                            </form>
                        @endforeach
                    </div>
                    <div style="border-left: 8px rgb(0, 110, 255) solid;"></div>
                    <div id="unid-mapa">               
                        <!-- Adicionar a lista de unidades que oferecem a modalidade selecionada -->
                        @if(isset($unidades) && count($unidades) > 0)
                            <div id="unidades-modalidade">
                                <h4 class="text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Unidades que oferecem {{ $mod_data->nm_modalidade }}</h4>
                                @foreach ($unidades as $nm_unidade => $detalhes)
                                    <div class="unidade-item mb-4">
                                        <h5 class="text-lg font-bold">{{ $nm_unidade }}</h5>
                                        @foreach ($detalhes as $detalhe)
                                            <p>Dia da Semana: {{ $detalhe->ds_dia_semana }}</p>
                                            <p>Horário: {{ $detalhe->ds_horario }}</p>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>                          
            </div>
        </div>
        @include('layouts.footer')       
    </main>    
</body>
</html>