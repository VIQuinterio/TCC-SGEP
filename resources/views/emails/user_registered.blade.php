<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao SGEP</title>
    <style>
         body {
            font-family: system-ui;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #007BFF;
            color: #ffffff; 
            padding: 20px;
            text-align: center;
        }
        .content {
            background-color: #ffffff; 
            padding: 20px;
        }
        .footer {
            background-color: #ffffff;
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }
        .card {            
            border-radius: 8px;
            max-width: 350px;
            margin: 20px;
        }

        .card .email {            
            font-size: 16px;
            margin-bottom: 10px;
        }

        .card .pass {
           font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo ao SGEP</h1>
        </div>
        <div class="content">
            <p>Olá,</p>
            <p>Estamos muito felizes por você ter se juntado a nós.</p>
            <p>Seu cadastro em nosso site foi realizado com sucesso! Abaixo segue seu acesso a plataforma:</p>
            <div class="card">
                <p class="email"><strong>Email:</strong> {{ $userData['email'] ?? 'E-mail não disponível' }}<hr/></p>
                <p class="pass"><strong>Senha:</strong> {{ $userData['senha'] ?? 'Senha não disponível' }}</p>                
            </div>
            <a href="{{ route('verificar.email', ['id' => $userData['cd_usuario']]) }}">Verificar Email</a>
            <p>Obrigado por escolher utilizar a plataforma SGEP.</p>
            <p>Se você tiver alguma dúvida, não hesite em nos contatar.</p>
        </div>
        <div class="footer">
            <p><b>© 2024 SGEP</b>. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
