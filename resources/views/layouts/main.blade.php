<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
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
        <span class="bg-underline1 bg-left-bottom bg-no-repeat pb-2 bg-100%">
          cool website
        </span>
      </h1>
      <p class="font-pt-serif font-normal mb-7">
        @yield('subtitle-banner')
      </p>
      <div class="font-montserrat">
        <button class="bg-black px-6 py-4 rounded-lg border-2 border-black border-solid text-white mr-2 mb-2">
          @yield('botao-banner')
        </button>
        <button class="px-6 py-4 border-2 border-black border-solid rounded-lg">
          Secondary action
        </button>
      </div>
    </div>
    <div class="flex justify-around md:block mt-8 md:mt-0 md:flex-1">  
      <img src="{{ asset('img/bg-form.jpg') }}" alt="Esporte" />
    </div>
  </section>
  
  <section class="text-black sectionSize">
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
                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </span>
            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Flowbite Library v1.2.2</h3>
            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Released on December 2nd, 2021</time>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web components and interactive elements built on top of Tailwind CSS.</p>
        </li>
    </ol>    
    </div>
  </section>


  <section class="bg-black text-white sectionSize">
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

  <section class="sectionSize bg-secondary">
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



</body>
</html>