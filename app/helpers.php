<?php

/**
 *  Converte o mes recebido em número em seu equivalente por escrito
 *
 * @param   string  $mes    O número do mês a ser convertido
 * @return  string  Mês por escrito
 */
function converter_mes($mes)
{
    switch ($mes) {
        case '01':
            return 'Janeiro';
        case '02':
            return 'Fevereiro';
        case '03':
            return 'Março';
        case '04':
            return 'Abril';
        case '05':
            return 'Maio';
        case '06':
            return 'Junho';
        case '07':
            return 'Julho';
        case '08':
            return 'Agosto';
        case '09':
            return 'Setembro';
        case '10':
            return 'Outubro';
        case '11':
            return 'Novembro';
        case '12':
            return 'Dezembro';
    }
}

/**
 * Tranforma a data atual em seu formato por escrito.
 *
 * @return string Data atual por escrito
 */
function get_data_escrita()
{
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');

    $mes = converter_mes($mes);

    return $dia . ' de ' . $mes . ' de ' . $ano;
}
