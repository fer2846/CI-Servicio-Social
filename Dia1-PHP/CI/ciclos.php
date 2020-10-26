<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciclos</title>
</head>
<body>
    
    <?php
        echo "<h2>Tabla 5</h2>";
        const cinco=5;
        const ocho=8;
        $intControl=1;
        $intVecesAMultipli=10;
        while($intControl <= $intVecesAMultipli){
            $intResultado= cinco * $intControl;
            echo cinco." x $intControl = ". $intResultado. "<br>";
            $intControl++;
        }

        echo "<h2>Tabla 5</h2>";
        for($intControl=1; $intControl<=$intVecesAMultipli; $intControl++){
            $intResultado= ocho * $intControl;
            echo ocho." x $intControl = ". $intResultado. "<br>";
        }
    ?>
</body>
</html>