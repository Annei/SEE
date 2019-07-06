<!--
*  profile.html 
*  @version: 1.0.0
*  @author: Universidad Politecnica - Raymundo, kath
*  @description: FORMATOS ADMINISTRADOR
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>public/css/animate.css">
    <script src="<?php echo constant('URL'); ?>public/js/wow.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/modals.js"></script>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>public/css/dropzone.css">
    <script src="<?php echo constant('URL'); ?>public/js/dropzone.js"></script>
    <title>SEE - Formatos Admin</title>
    <link rel="shortcut icon" href="">
</head>
<body>
    <div class="main flex">
        <div class="column formatos full">
            <div class="row-responsive">
                <div class="column align-center justify-center menu" tabindex="0">
                        <div class="smartphone-menu-trigger"></div>
                        <div class="white-space-24"></div>
    
                        <div class="responsive-img item-left justify-center align-center logo">
                            <img src="<?php echo constant('URL'); ?>public/img/upqroo-newlogo@2x.png" alt="responsive img" title="responsive img" class="cover-img "/>
                        </div>
    
                        <div class="white-space-32"></div>
                        <!-- <div class="white-space-16"></div> -->
                        
<div class="column main align-center auto">
                            <div class="menu-options">
                                <a href="<?php echo constant('URL'); ?>alumnos/datos" class="item-left">
                                    <div class="row justify-center align-start">
                                        <div class="column icon align-center"><i class="fa fa-user"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Datos generales</h4>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="<?php echo constant('URL'); ?>alumnos/carga-academica" class="item-left">
                                    <div class="row justify-center">
                                            <div class="column icon align-center"><i class="fa fa-university"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Carga académica</h4>
                                        </div>                        
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>alumnos/calificaciones" class="item-left">
                                    <div class="row justify-center">
                                            <div class="column icon align-center"><i class="fa fa-star"></i></div> 
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Calificaciones</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>alumnos/kardex" class="item-left">
                                    <div class="row justify-center">
                                        <div class="column icon align-center"><i class="fa fa-book-user"></i></div>
                                        <div class="column full">
                                            <h4 class="color-white weight-regular font-small">Kardex</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>alumnos/horario" class="item-left">
                                    <div class="row justify-center">
                                        <div class="column icon align-center"><i class="fa fa-calendar-alt"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Horario</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>xd" class="item-left">
                                    <div class="row justify-center">
                                        <div class="column icon align-center"><i class="fa fa-newspaper"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Noticias</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>alumnos/formatos" class="item-left">
                                    <div class="row justify-center">
                                        <div class="column icon align-center"><i class="fa fa-file-download"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Formatos</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>xd" class="item-left">
                                    <div class="row justify-center">
                                        <div class="column icon align-center"><i class="fa fa-mail-bulk"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Correo Institucional</h4>
                                        </div>
                                    </div>
                                </a>
    
                                <a href="<?php echo constant('URL'); ?>logout" class="item-left">
                                    <div class="row item-left justify-center">
                                        <div class="column icon align-center"><i class="fa fa-sign-out"></i></div>
                                        <div class = "column full">
                                            <h4 class="color-white weight-regular font-small">Cerrar Sesión</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                </div>  
                <div class="column align-center full body">
                    <div class="row-responsive justify-center header-tittle align-center" style="background-image: url(<?php echo constant('URL'); ?>public/img/new-footer-blue.png)">
                        <div class="container-data align-center header-content justify-between">
                            <div class="row auto">
                                <div class="column auto justify-center">
                                    <h1 class="color-white weight-bold">Formatos</h1>
                                </div>  
                            </div>
                            <div class="row auto">
                                <button onclick="openModal('modal-formats')" class="btn btn-admin bg-darkBlue color-white font-regular weight-semi">
                                    <i class="far fa-file-upload icon-btn"></i>
                                    Subir archivo</button>
                            </div>
                        </div>
                    </div>

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
                            <a onclick="openModal('modal-edit')" class="hover-file row padding-semi align-center justify-center">
                                <div class="column">
                                <i class="font-triple color-white fas fa-file-edit"></i>
                                <div class="white-space-16"></div>
                                <p class="font-tiny color-white weight-bold">Editar Archivo</p>
                                </div>
                            </a>
                            <div class="white-space-16"></div>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="white-space-32"></div>
                </div>
            </div>

            <div class="modal modal-confirm column justify-center align-center hidden  wow animated "  data-wow-duration=".7s" id="modal-formats">
                <div class="container modal-content align-center column" >
                    
                    <div class="row-responsive justify-center header-tittle align-center header-tittle-modal" style="background-image: url(<?php echo constant('URL'); ?>public/img/new-footer-blue.png)">
                        <div class="container-data header-content justify-center">
                            <div class="row auto">
                                <div class="column auto align-center">
                                    <h3 class="color-white weight-bold font-double">Subir archivo</h3>
                                </div>  
                            </div>
                            <div class="row auto">
                                <a href="javascript:void(0)" id="close-modal" onclick="closeModal('modal-formats')">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upload-summary column">
                        <div class="white-space-24"></div>
                        <form class="content column justify-center align-center" >
                            <input type="text" name="name_file" placeholder="Nombre del archivo" class="input" required>
                            <div class="white-space-24"></div>
                            <div class="dropzone" id="myDropzone"></div>
                            <div class="white-space-24"></div>
                            <button type="submit" id="submit-all" class="btn btn-admin btn-radius btn-large btn-darkBlue bg-darkBlue font-regular weight-bold color-white">
                                <i class="far fa-file-upload icon-btn"></i>
                                Subir archivo 
                            </button>
                        </form>
                    </div>
                <div class="white-space-32"></div>
                </div>
            </div>


            <div class="modal modal-confirm column justify-center align-center hidden  wow animated" data-wow-duration=".7s" id="modal-edit">
                <div class="container modal-content align-center column" >
                    
                    <div class="row-responsive justify-center header-tittle align-center header-tittle-modal" style="background-image: url(<?php echo constant('URL'); ?>public/img/new-footer-blue.png)">
                        <div class="container-data header-content justify-center">
                            <div class="row auto">
                                <div class="column auto align-center">
                                    <h3 class="color-white weight-bold font-double">Editar Archivo</h3>
                                </div>  
                            </div>
                            <div class="row auto">
                                <a href="javascript:void(0)" id="close-modal" onclick="closeModal('modal-edit')">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upload-summary column">
                        <div class="white-space-24"></div>
                        <form class="content column justify-center align-center" >
                            <input type="text" name="name_file" placeholder="Nombre del archivo" class="input" required>
                            <div class="white-space-24"></div>
                            <div class="dropzone" id="myDropzone"></div>
                            <div class="white-space-24"></div>
                            <button type="submit" id="submit-all" class="btn btn-admin btn-radius btn-large btn-darkBlue bg-darkBlue font-regular weight-bold color-white">
                                Guardar Cambios
                            </button>
                        </form>
                    </div>
                <div class="white-space-32"></div>
                </div>
            </div>

        </div>
    </div>
    
    <script>
        new WOW().init();
    </script>
    <script type="text/javascript">
        Dropzone.options.myDropzone = {
            url: 'upload.php',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 4,
            maxFiles: 5,
            maxFilesize: 1,
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='font-triple color-lightBlue fa fa-file'></i> Arrastra o da click aquí para subir un archivo",
            init: function() {
                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("submit-all").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });
            }
        }
    </script>
</body>
</html>