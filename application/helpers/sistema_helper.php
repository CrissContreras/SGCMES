<?php 
// calcular el numero de resultados en funcion del tamaño de la pantalla
function cuantosResultados() {
    $ci = &get_instance();
    // para 700 esta bien 20 resultados
    // cada resultado mide 20, entonces seria el  c = t/35
    $tamano = $ci->session->userdata('ses_ven_alto');
    $tamano = intval($tamano);
    $tamano = $tamano - 200 - 110; // esto es tamaño de la cabecera + pie
    $cuantos = $tamano / 19; // mientras mas pequeño, mas resultados
    $cuantos = floor($cuantos);
    if ($cuantos < 1)
        $cuantos = 10;
    return $cuantos;
}
function paginador_multiple($sql, $cuantos, $desde) {
    $paginado = "";
    $ci = &get_instance();

    $cuantos = intval($cuantos);
    $desde = intval($desde);
    $query = $ci->db->query($sql);

    $total_registros = $query->num_rows();
    $cantidad_paginas = floor($total_registros / $cuantos);
    if ($total_registros % $cuantos > 0)
        $cantidad_paginas++;

    if ($cantidad_paginas >= 12)
        $salto = floor($cantidad_paginas / 12);
    else
        $salto = 1;

    $vecinos = 4;
    $primos = floor($salto / $vecinos);
    $tios = $primos - floor($primos / 2);
    $arr_incluidas[0] = 0;
    /* die("paginas: $cantidad_paginas vecinos $vecinos salto $salto"); */

    for ($i = 0; $i < $cantidad_paginas; $i++) {
        $j = $i + 1;

        /* hermanos */
        if (($i > $desde - $vecinos) and ( $i < $desde + $vecinos) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado .= "<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado .= "<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* primos */
        if ((($i == $desde - $primos) or ( $i == $desde + $primos)) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado .= "<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado .= "<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* tios */
        if ((($i == $desde - $tios) or ( $i == $desde + $tios)) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado .= "<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado .= "<a  class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* extremos 1 y cantidad de paginas */
        if (($i == 0 or $i + 1 == $cantidad_paginas) and ! array_key_exists($j, $arr_incluidas)) {
            if ($i == $desde)
                $paginado .= "<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado .= "<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
            $arr_incluidas[$j] = $j;
        }

        /* identificar si es salto e imprimirlo */
        if ((($i % $salto) == 0) and ! (array_key_exists($j, $arr_incluidas)))
            if ($i == $desde)
                $paginado .= "<a class='numpagactivo' href='#' rel='paginador' style='color:#FFF'>$j</a>";
            else
                $paginado .= "<a class='numpag' href='$i' rel='paginador' style='color:#FFF'>$j</a> ";
        $arr_incluidas[$j] = $j;
    }
    return $paginado;
}