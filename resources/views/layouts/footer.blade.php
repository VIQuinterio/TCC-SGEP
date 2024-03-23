<div class="border-top-color">
    <footer class="bg-white m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">SGEP</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="{{ route('app.noticia.index')}}" class="hover:underline me-4 md:me-6 mr-2">Notícias</a>
                    </li>
                    <li>
                        <a href="{{ route('app.modalidade.index')}}" class="hover:underline me-4 md:me-6 mr-2">Modalidades</a>
                    </li>
                    <li>
                        <a href="{{ route('app.evento.index')}}" class="hover:underline me-4 md:me-6">Eventos</a>
                    </li>
                    <li>
                        <a href="{{ route('app.unidade.index')}}" class="hover:underline me-4 md:me-6">Unidades</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="{{ route('app.home')}}" class="hover:underline">{{ $user_data->nm_usuario }}</a>.Todos os direitos reservados.</span>
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">Desenvolvido por  <a href="{{ route('home')}}" class="hover:underline">Fatecanos</a></span>
        </div>
    </footer>
</div>