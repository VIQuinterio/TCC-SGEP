@extends('layouts.main')

@section('title', 'Home')

@section('links')
    <ul class="font-montserrat items-center hidden md:flex">
        <li class="mx-3 ">
            <a class="growing-underline" href="howitworks">
                How it works
            </a>
        </li>
        <li class="growing-underline mx-3">
            <a href="features">Features</a>
        </li>
        <li class="growing-underline mx-3">
            <a href="pricing">Pricing</a>
        </li>
    </ul>
    @section('navbar-buttons')
    <button class="mr-6">Login</button>
    <button class="py-2 px-4 text-white bg-black rounded-3xl">
      Signup
    </button>
    @endsection
@endsection
@section('links-mobile')
    <ul class="font-montserrat flex flex-col mx-8 my-24 items-center text-3xl">
        <li class="my-6">
            <a href="howitworks">How it works</a>
        </li>
        <li class="my-6">
            <a href="features">Features</a>
        </li>
        <li class="my-6">
            <a href="pricing">Pricing</a>
        </li>
    </ul>
@endsection

@section('title-banner', 'Desperte a Paixão pelo Esporte em Sua Comunidade')

@section('subtitle-banner', 'Unimos as Modalidades, Unidades e Eventos Esportivos da Sua Prefeitura em um Único
    Espaço!')

@section('botao-banner', 'Comece a gerenciar agora mesmo!')
