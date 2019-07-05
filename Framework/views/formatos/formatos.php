<!--
*  profile.html 
*  @version: 1.0.0
*  @author: Universidad Politecnica - Raymundo, kath
*  @description: FORMATOS
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>public/css/style.css"></link>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>SEE - Formatos</title>
    <link rel="shortcut icon" href="">
</head>
<body>
    <div class="main flex">
        <div class="column formatos full">
            <div class="row-responsive full">
                    <div class="column menu-left align-center justify-center">
                            <div class="white-space-24"></div>
                            <div class="responsive-img item-left justify-center align-center">
                                <img src="<?php echo constant('URL'); ?>/public/img/upqroo-newlogo@2x.png" alt="responsive img" title="responsive img" class="cover-img "/>
                            </div>
                            <div class="white-space-32"></div>
                            <div class="white-space-16"></div>
                            <div class="column main align-center auto">
                            <a href="<?php echo constant('URL'); ?>alumnos/datos" class="item-left ">
                                <div class="row  justify-center align-start">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Datos generales</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo constant('URL'); ?>alumnos/carga-academica" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Carga académica</h4>
                                    </div>                        
                                </div>
                            </a>
                            <a href="calificaciones.html" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Calificaciones</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="kardex.html" class="item-left ">
                                <div class="row justify-center">
                                    <div class="column full">
                                        <h4 class="color-white weight-regular font-small">Kardex</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="horario.html" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Horario</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="noticias.html" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Noticias</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo constant('URL'); ?>alumnos/formatos" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Formatos</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="item-left ">
                                <div class="row justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Correo Institucional</h4>
                                    </div>
                                </div>
                            </a>
                            <a href="login.html" class="item-left ">
                                <div class="row item-left justify-center">
                                    <div class = "column full">
                                        <h4 class="color-white weight-regular font-small">Cerrar Sesión</h4>
                                    </div>
                                </div>
                            </a>
                            </div>
                    </div>
                <div class="column align-center">
                <div class="row-responsive full">
                        <div class="row-responsive justify-center header-tittle align-center" style="background-image: url(<?php echo constant('URL'); ?>public/img/new-footer-blue.png)">
                            <div class="column container-data align-start header-content">
                                <div class="row auto">
                                    <div class="column auto">
                                        <h1 class="color-white weight-bold">Formatos</h1>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div> <!--/.header title-->
                    <div class="white-space-24"></div>
                    <div class="row container-cards wrap justify-start container-data">

                        <?php while ($item=array_pop($this->Formatos)) { ?>
                        <div class="box-file column bg-white align-center justify-center">
                                <div class="white-space-16"></div>
                                <div class="file row bg-white padding-semi align-center justify-center">
                                <div class="column">
                                <i class="font-triple color-lightBlue fa fa-file"></i>
                                <div class="white-space-16"></div>
                                <h3 class="font-text color-darkBlue weight-bold"><?php echo substr($item,1,-5) ?></h3>
                                </div>
                            </div>
                            <a href="<?php echo constant('URL') . "documentos".$item; ?>" download="<?php $item; ?>">
                            <div class="hover-file row padding-semi align-center justify-center">
                                <div class="column">
                                <i class="font-triple color-white fa fa-download"></i>
                                <div class="white-space-16"></div>
                                <p class="font-tiny color-white weight-bold">Descargar Archivo</p>
                                </div>
                            </div>
                            </a>
                            <div class="white-space-16"></div>
                        </div>
                        <?php } ?>


                            


                    </div>
                    <div class="white-space-32"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>