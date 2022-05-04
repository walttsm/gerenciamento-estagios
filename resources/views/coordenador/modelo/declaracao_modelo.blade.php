<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <?php

    ?>
    <div class="text-center mx-auto max-w-xl">
        <h1 class="mt-40 mb-20">Declaração</h1>
        <br>
        <div class="flex justify-center max-w-xl">
            <p class="text-justify">
                Declaramos a realização, em {{ date('Y') }}, da banca de avaliação de Estágio entitulado
                <b>Título do trabalho</b>, de autoria de <b>Nome do aluno</b>, aluna do curso de <b>Curso</b>, orientada
                pelo
                professor <b>Nome do Orientador</b>.
                Além do orientador, a banca teve em sua composição de avaliação os professores <b>Banca 1</b> e <b>Banca
                    2</b>.
            </p>
        </div>

        <p class="text-right my-20">Londrina, <?php
    $current_date = new DateTime();
    echo $current_date->format('d/m/Y');
    ?>.</p>


        <div class="flex justify-evenly my-40">
            <div class="flex flex-col">
                <hr>
                <b>Prof. Sérgio Akio Tanaka</b>
                <p>Coord. de curso</p>
                <p>Colegiado de <b>Ciência da Computação</b></p>
                <p>Instituto Filadélfia de Londrina | Unifil</p>
            </div>
            <div class="flex flex-col">
                <hr>
                <b>Profª. Simone Sawasaki Tanaka</b>
                <p>Coord. de estágios</p>
                <p>Colegiado de <b>Ciência da Computação</b></p>
                <p>Instituto Filadélfia de Londrina | Unifil</p>
            </div>
        </div>
        <br>
        <p class="text-[0.6rem]">Credenciado - Dec: de 24/04/2001 - DOU de 25/04/2001 - Recredenciado - Portaria nº 814 - DOU de 27/08/2007<br>
            Mantenedora: <b>Instituto Filadélfia de Londrina</b>
        </p>
    </div>
</body>

</html>
