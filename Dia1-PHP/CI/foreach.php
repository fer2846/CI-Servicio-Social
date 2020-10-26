<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $edades=[30,23,43,25,67];
        $nombres=['Fernando','Roberto','Carlos','Maria','Relleno'];
        $intPosicion=0;
        $variados=['Fernando','Sanchez',22];
    ?>
    <h3>Lista de alumnos</h3>
    <?php foreach ($nombres as $nombre){?>
        <p><?=$nombre?> y mi edad es <?=$edades[$intPosicion++]?></p>
    <?php }?>

    <h3>Otros Ejemplos</h3>
    <?php
        foreach($variados as $variado){
            echo $variado."<br>";
        }
    ?>

    <h3>Acceso Asociativo</h3>
    <h4>Mis datos</h4>
    <?php
        $arrayAsociativo= array('nombre' => 'Fernando',
                                'apellido' =>'Sánchez',
                                'edad'=>30);
            foreach($arrayAsociativo as $key => $value){
                echo "<p>Mi $key es $value</p>";
            }
    ?>
</body>
</html>