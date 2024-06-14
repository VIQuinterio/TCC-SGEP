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
<body bgcolor="#F5F5F5">
    <div class="pt-24 flex justify-center">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" method="POST" action="{{ route('redefinir_senha.post') }}">
                @csrf
                <h1 class="text-2xl text-center font-medium text-gray-900 dark:text-white">Redefinir Senha</h1>
                <div>
                    <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nova Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>
                <div>
                    <label for="senha_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Senha:</label>
                    <input type="password" name="senha_confirmation" id="senha_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    <p id="error-message" class="text-sm mt-1" style="display: none;">As senhas não coincidem. Por favor, verifique e tente novamente.</p>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var passwordField = document.getElementById("senha");
            var confirmPasswordField = document.getElementById("senha_confirmation");
            var errorMessage = document.getElementById("error-message");

            function validatePassword() {
                var password = passwordField.value;
                var confirmPassword = confirmPasswordField.value;

                if (password !== confirmPassword) {
                    confirmPasswordField.classList.add("bg-red-50", "border", "border-red-500", "text-red-900", "placeholder-red-700", "focus:ring-red-500", "dark:bg-gray-700", "focus:border-red-500", "dark:text-red-500", "dark:placeholder-red-500", "dark:border-red-500");
                    errorMessage.style.display = "block";
                } else {
                    confirmPasswordField.classList.remove("bg-red-50", "border", "border-red-500", "text-red-900", "placeholder-red-700", "focus:ring-red-500", "dark:bg-gray-700", "focus:border-red-500", "dark:text-red-500", "dark:placeholder-red-500", "dark:border-red-500");
                    errorMessage.style.display = "none";
                }
            }

            confirmPasswordField.addEventListener('blur', validatePassword);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.1/flowbite.min.js"></script>
</body>
</html>
