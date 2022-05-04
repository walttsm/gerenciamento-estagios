<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Declaração</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <style>
        *,
        ::before,
        ::after {
            box-sizing: border-box;
            /* 1 */
            border-width: 0;
            /* 2 */
            border-style: solid;
            /* 2 */
            border-color: currentColor;
            /* 2 */
        }

        html {
            line-height: 1.5;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -moz-tab-size: 4;
            /* 3 */
            -o-tab-size: 4;
            tab-size: 4;
            /* 3 */
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /* 4 */
        }

        body {
            margin: 0;
            /* 1 */
            line-height: inherit;
            /* 2 */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        h1,
        .h1 {
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 700;
        }

        @media (min-width: 768px) {

            h1,
            .h1 {
                font-size: 2.25rem;
                line-height: 2.5rem;
            }
        }

        h2,
        .h2 {
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 700;
        }

        @media (min-width: 768px) {

            h2,
            .h2 {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }
        }

        h3,
        .h3 {
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 700;
        }

        @media (min-width: 768px) {

            h3,
            .h3 {
                font-size: 1.5rem;
                line-height: 2rem;
            }
        }

        h4,
        .h4 {
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            line-height: 1.5rem;
            font-weight: 700;
        }

        @media (min-width: 768px) {

            h4,
            .h4 {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }
        }

        body,
        .p {
            font-family: Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        @media (min-width: 768px) {

            body,
            .p {
                font-size: 1rem;
                line-height: 1.5rem;
            }
        }

        hr {
            height: 0;
            /* 1 */
            color: inherit;
            /* 2 */
            border-top-width: 1px;
            /* 3 */
        }

        .text-center {
            text-align: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .max-w-xl {
            max-width: 36rem;
        }

        .my-20 {
            margin-top: 5rem;
            margin-bottom: 5rem;
        }

        .my-40 {
            margin-top: 10rem;
            margin-bottom: 10rem;
        }

        .mt-40 {
            margin-top: 10rem;
        }

        .mb-20 {
            margin-bottom: 5rem;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-evenly {
            justify-content: space-evenly;
        }

        .text-justify {
            text-align: justify;
        }

        .text-right {
            text-align: right;
        }

        .below-text {
            font-size: 0.6rem;
        }

    </style>
</head>

<body>
    <div class="text-center mx-auto max-w-xl">
        <h1 class="mt-40 mb-20">Declaração</h1>
        <br>
        <div class="flex justify-center max-w-xl">
            <p class="text-justify">
                Declaramos a realização, em {{ date('Y') }}, da banca de avaliação de Estágio entitulado
                <b>{{ $aluno->nome_trabalho }}</b>, de autoria de {{ $aluno->nome_aluno }}, aluna do curso de
                {{ $aluno->curso }}, orientada
                pelo
                professor <b>{{ $aluno->orientador->nome }}</b>.
                Além do orientador, a banca teve em sua composição de avaliação os professores <b>Banca 1</b> e <b>Banca
                    2</b>.
            </p>
        </div>

        <p class="text-right my-20">Londrina,
            <?php
            //$cur_date = new DateTime();
            //echo $cur_date->format('d/m/Y');

            echo get_data_escrita();
            ?>.
        </p>


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
        <p class="below-text">Credenciado - Dec: de 24/04/2001 - DOU de 25/04/2001 - Recredenciado - Portaria nº 814
            - DOU de 27/08/2007<br>
            Mantenedora: <b>Instituto Filadélfia de Londrina</b>
        </p>
    </div>
</body>

</html>
