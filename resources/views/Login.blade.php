<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registre-se - Entrar na conta</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
    <main>
        <figure>
            <picture>
                <img src="{{ asset('img/treinador-de-futebol-ensinando-vista-lateral-para-criancas.jpg') }}" alt="ferramenta esportiva" class="bg-form">
            </picture>
        </figure>
        <div class="headline">
            <h2 class="text-headline">SGEP</h2>
            <h3 class="text-subheadline">Sistema de Gerenciamento Esportivo Público</h2>
        </div>
        <form class="form-content" action="{{ route('auth') }}" method="POST">
            @csrf <!-- Adicione o token CSRF para proteção contra CSRF -->        
            <h1 class="font-pt-serif text-5xl font-bold" style="text-align: center">Login</h1>            
            <span>
                <label for="email" class="text-small-uppercase">Email</label>
                <input class="text-body" id="email" name="email" type="email" required>
            </span>            
            <span>
                <label for="senha" class="text-small-uppercase">Senha</label>
                <input class="text-body" id="senha" name="senha" type="password" required>
            </span>            
            <input class="text-small-uppercase" id="submit" type="submit" value="Entrar">            
            <a href="recuperarSenha.php" class="link font-montserrat">Não consigo iniciar a sessão</a>
        </form>
        
    </main>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>
