<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases</title>
</head>
<body>
    <?php
        include './persona.php';
        $yo = new Persona(); 
    ?>
    <h1>Clase Persona</h1>
    <p>
        Mi nombre es <?=$yo->nombre?> y mi apelido es <?= $yo->apellido?>
        por lo tanto mi nombre es <?=$yo->getNombreCompleto()?>   
    </p>
</body>
</html>