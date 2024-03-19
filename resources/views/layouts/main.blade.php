<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <!--<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <script src="{{ asset('js/script.js') }}"></script>

</head>
<body>
  <nav class="fixed flex justify-between py-6 w-full lg:px-48 md:px-12 px-4 content-center bg-secondary z-10">
    <div class="flex items-center">
      SGEP
    </div>
    @yield('links')
    <div class="font-montserrat hidden md:block">
      @yield('navbar-buttons')
    </div>
    <div id="showMenu" class="md:hidden">
      <img src="{{ asset('img/Menu.svg') }}" alt="Menu icon" />
    </div>
  </nav>
  <div id="mobileNav" class="hidden px-4 py-6 fixed top-0 left-0 h-full w-full bg-secondary z-20 animate-fade-in-down">
    <div id="hideMenu" class="flex justify-end">
      <img src="{{ asset('img/Cross.svg') }}" alt="" class="h-16 w-16" />
    </div>
    @yield('links-mobile')
  </div>
  
  <section
  class="pt-24 md:mt-0 md:h-screen flex flex-col justify-center text-center md:text-left md:flex-row md:justify-between md:items-center lg:px-48 md:px-12 px-4 bg-secondary">
    <div class="md:flex-1 md:mr-10">
      <h1 class="font-pt-serif text-5xl font-bold mb-7">
        @yield('title-banner')        
      </h1>
      <p class="font-pt-serif font-normal mb-7">
        @yield('subtitle-banner')
      </p>
      <div class="font-montserrat">
        <!--<a href="{{ url('signup') }}">-->
          <button class="bg-black px-6 py-4 rounded-lg border-2 border-black border-solid text-white mr-2 mb-2">
            @yield('botao-banner')
          </button>     
        <!--</a>-->
      </div>
    </div>
    <div class="flex justify-around md:block mt-8 md:mt-0 md:flex-1">  
      <img src="{{ asset('img/bg-form.jpg') }}" alt="Esporte" />
    </div>
  </section>
  
  <section id="funcionalidades" class="text-black sectionSize">
    <div>
      <h2 class="secondaryTitle bg-underline2 bg-100%">Funcionalidades da Plataforma</h2>
    </div>
    <div class="flex flex-col md:flex-row">

      <ol class="relative border-s border-gray-200 dark:border-gray-700">                          
        <li class="mb-10 ms-6">
            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                1
            </span>
            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Customização Flexível</h3>
            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Released on December 7th, 2021</time>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">As prefeituras têm a liberdade de personalizar a plataforma, introduzindo quais modalidades, unidades, notícias e eventos esportivos serão divulgados.</p>
        </li>
        <li class="ms-6">
            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                2
            </span>
            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Flowbite Library v1.2.2</h3>
            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Released on December 2nd, 2021</time>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web components and interactive elements built on top of Tailwind CSS.</p>
        </li>
    </ol>    
    </div>
  </section>


  <section id="divulgação" class="bg-black text-white sectionSize">
    <div>
      <h2 class="secondaryTitle bg-underline2 bg-100%">Divulgação de Modalidades Esportivas Públicas Municipais</h2>
    </div>
    <div class="flex flex-col md:flex-row">
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          1
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Atração de Público</h3>
        <p class="text-center font-montserrat">
          A plataforma ajuda a divulgar modalidades esportivas públicas municipais, 
          atraindo participantes e espectadores para eventos esportivos locais.
        </p>
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          2
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Promovendo a Saúde</h3>
        <p class="text-center font-montserrat">
          A divulgação eficaz das modalidades esportivas incentiva a prática de atividades físicas, 
          promovendo um estilo de vida saudável na comunidade.
        </p>        
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          3
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Engajamento da Comunidade</h3>
        <p class="text-center font-montserrat">
          Fortalecimento do engajamento da comunidade local com as atividades esportivas oferecidas, 
          promovendo um ambiente de interação e inclusão.
        </p>       
      </div>
    </div>
  </section>

  <section id="benefícios" class="sectionSize bg-secondary">
    <div>
      <h2 class="secondaryTitle bg-underline3 bg-100%">Benefícios para os Usuários</h2>
    </div>
    <div class="flex flex-col md:flex-row">
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          1
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Atração de Público</h3>
        <p class="text-center font-montserrat">
          A plataforma ajuda a divulgar modalidades esportivas públicas municipais, 
          atraindo participantes e espectadores para eventos esportivos locais.
        </p>
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          2
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Promovendo a Saúde</h3>
        <p class="text-center font-montserrat">
          A divulgação eficaz das modalidades esportivas incentiva a prática de atividades físicas, 
          promovendo um estilo de vida saudável na comunidade.
        </p>        
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          3
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Engajamento da Comunidade</h3>
        <p class="text-center font-montserrat">
          Fortalecimento do engajamento da comunidade local com as atividades esportivas oferecidas, 
          promovendo um ambiente de interação e inclusão.
        </p>       
      </div>
    </div>
  </section>

  <footer>
    <section class="bg-black sectionSize">
      <div class="mb-4">
       <h1 class="h-4 text-white">SGEP</h1>
      </div>
      <div class="flex mb-8">
        <a href="#">
          <iconify-icon icon="bxl:facebook-square" style="color: white;" alt="Facebook logo" width="25" height="25" class="mx-4"></iconify-icon>
        </a>
        <a href="#">
          <iconify-icon icon="mdi:instagram" style="color: white;" alt="Instagram logo" width="25" height="25" class="mx-4"></iconify-icon>
        </a>
        <a href="#">
          <iconify-icon icon="simple-icons:x" style="color: white;" alt="X logo" width="25" height="25" class="mx-4"></iconify-icon>
        </a>
      </div>
      <div class="text-white font-montserrat text-sm">
        © 2023 SGEP. Direitos reservados 
      </div>
    </section>
  </footer>
  <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
</body>
</html>