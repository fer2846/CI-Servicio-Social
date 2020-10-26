<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta base="<?php echo "http://localhost/".base_url();?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo "http://localhost/".base_url();?>css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <title>Ejemplo Curso CI</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Curso CI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($strActivo == 'marcas') echo 'active';?>">
                    <a class="nav-link" href="<?php echo 'http://localhost/'.base_url();?>marcas">Marcas</a>
                </li>
                <li class="nav-item <?php if($strActivo == 'modelos') echo 'active';?>">
                    <a class="nav-link" href="<?php echo 'http://localhost/'.base_url();?>modelos">Modelos</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="conatiner">
        <br>
        <?php /*echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>');*/?>
        
        <div id="divMensajes">

        </div>
        
        <?php if(isset($arrMensajes)){
                foreach($arrMensajes as $arrMensaje) {?>
            <div class="alert alert-<?php if($arrMensaje['intTipo']==1) echo 'success'; else echo 'danger';?>" role="alert">
            <strong>!</strong> <?php echo $arrMensaje['strMensaje'];?>
            </div>
        <?php }}?>

        <?php
            if(isset($strContenido))
                echo $strContenido;
        ?>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
</body>
</html>