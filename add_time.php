<?php
function add_time ($inicio, $duracion, $dia = null) {
    $dias_de_semana = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];

    list($tiempo_de_inicio, $periodo) = explode(' ', $inicio);
    list($inicio_de_hora,$inicio_de_minuto) = explode(':', $tiempo_de_inicio);
    list($duracion_de_hora,$duracion_de_minutos) = explode(':', $duracion);

    $nueva_hora = $inicio_de_hora + $duracion_de_hora;
    $nuevo_minuto = $inicio_de_minuto + $duracion_de_minutos;
    

    if ($nuevo_minuto >= 60){
        $nueva_hora +=1;
        $nuevo_minuto-=60;
    }

    if ($nueva_hora >= 12) {
        if ($periodo == 'AM') {
            $periodo = 'PM';
        } else {
            $periodo = 'AM';
            $nueva_hora-=12;
        }
    }

    $dias_despues = floor(($nueva_hora / 24));
    $nueva_hora %= 24;

    if($dia !== null){
        $dia = ucfirst(strtolower($dia));
        $index_dia= array_search($dia, $dias_de_semana) + $dias_despues % 7;
        $nuevo_dia = $dias_de_semana[$index_dia];

    }

    $nuevo_tiempo = "$nueva_hora:$nuevo_minuto $periodo";
    if ($dias_despues == 1 ) {
        $nuevo_tiempo .= " ($dias_despues dia siguiente)";
    } elseif ($dias_despues > 1) {
        $nuevo_tiempo .= " ($dias_despues dias despues)";
    }

    if ($dia !== null) {
        $nuevo_tiempo .= ", $nuevo_dia";
    }
    return $nuevo_tiempo;
}

echo add_time("3:00 PM", "3:10") . "<br>";
echo add_time("11:30 AM", "2:32", "Lunes") . "<br>";
echo add_time("11:43 AM", "00:20") . "<br>";
echo add_time("10:10 PM", "3:30") . "<br>";
echo add_time("11:43 PM", "24:20", "Martes") . "<br>";
echo add_time("6:30 PM", "205:12") . "<br>";


?>