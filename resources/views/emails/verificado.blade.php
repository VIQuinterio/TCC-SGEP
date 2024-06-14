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
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="mb-3 text-green-500 dark:text-emerald-500 text-center font-bold">✅ E-mail Verificado com Sucesso!</h1>
        <p class="mb-3 text-gray-500 dark:text-gray-400 text-center">
            Sua conta foi ativada. Você pode agora fazer login e acessar todos os recursos do sistema.
        </p>
        <a href="{{ url('login') }}" class="block py-2 pl-3 pr-4 text-blue-500 md:p-0" aria-current="page">
            <button type="submit" 
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
            font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ir para o Login</button>
        </a>
        @if (session('error'))
            <div class="bg-red-50 border border-red-500 text-red-900 text-sm rounded-lg p-4 mb-4 dark:bg-gray-800 dark:border-red-700 dark:text-red-400">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
</body>
</html>
