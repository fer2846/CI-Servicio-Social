<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores</title>
</head>
<body>
    <h1>Operadores</h1>
    <?php
        $a=5;
        $b=10;
        
        $suma= $a + $b;
        $resta= $b - $a;
        $multi= $b * $a;
        $expA= $a**$b;
        $div= $a/$b;

    ?>
    <h3>Para imprimir este resultado ya no se uso escho, se uso</h3>
    <h3>HTML y se incrusto PHP de la siguiente forma</h3>
    <h3>-p- -?= ?- -p- los guiones son < > </h3>
    <p>La suma de <?=$a."+".$b." es igual a ".$suma?>  </p>
    <p>La resta de <?=$b."-".$a." es igual a ".$resta?>  </p>
    <p>La multiplicacion de <?=$b."*".$a." es igual a ".$multi?>  </p>
    <p>La exponencial de <?=$a."^".$b." es igual a ".$expA?>  </p>
    <p>La division de <?=$a."+".$b." es igual a ".$div?>  </p>
</body>
</html>