<?php

//padroniza nomes pessoais
function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI", "e")){
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
   }//foreach
   return $string;
}

function nameCase($frase){
    $p = ucfirst($frase);
    return $p;
}

//primeira letra maiuscula e ultimo caracterer com pontuação
function textCase($frase){

    $p = $frase;
    $primeiraLetra = substr($p, 0, 1);
    $primeiraLetra = strtoupper($primeiraLetra);
    $restoPalavra = substr($p, 1);
    $p = $primeiraLetra.$restoPalavra;
    $ultimaLetra = substr($p, strlen($p)-1, strlen($p));
    if($ultimaLetra != "." && $ultimaLetra != "!" && $ultimaLetra != "?"){
        $p = $primeiraLetra.$restoPalavra.".";
    }
    return $p;
}

