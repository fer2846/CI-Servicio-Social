<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estructura IF</title>
</head>
<body>
    <?php
        const aprueba=8;
        $mensaje="vacio";
        $intAlumno1=10;
        $intAlumno2=7;

        if($intAlumno1 >= $aprueba){
            $mensaje="Aprobaste";
        }else{
            $mensaje="Reprobaste";
        }
    ?>

    <p>El Alumno 1 saco <?=$intAlumno1?> por lo tanto <?=$mensaje?></p>

    <p>El Alumno 2 saco <?=$intAlumno2?> por lo tanto <?=$mensaje?></p>
</body>
</html>