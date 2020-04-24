<!DOCTYPE html>

<?php
    date_default_timezone_set('America/Sao_Paulo');
    $abertura = new DateTime('2017-08-13 15:00:00');
    $fechamento = new DateTime('2017-08-18 18:15:00');
    $intervalo = $fechamento->diff($abertura);
    $d; $h; $i;
    $d = $intervalo->format("%d");
    $h = $intervalo->format("%h");
    $i = $intervalo->format("%I");
    
    echo $d.$h.$i;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
