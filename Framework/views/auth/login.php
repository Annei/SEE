<!--
*  login.html 
*  @version: 1.0.0
*  @author: Universidad Politecnica - Jazmin Pool, kath
*  @description: LOGIN DEL ALUMNO
*  @date: 09/06/2019
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>public/css/style.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/fontawesome/css/all.css">
    <title>SEE - Kardex</title>
    <link rel="shortcut icon" href="">
</head>
<body>
    <div class="main flex">
        <div class="column login full">
            <div class="row background-login" >
                <div class="column justify-center align-center">
                    <div class="row">
                        <div class="column left justify-center align-center" style="background-image: url(<?php echo constant('URL'); ?>public/img/leftblue.jpg)">
                                <div class="container responsive-img item-left justify-center align-center">
                                    <img src="<?php echo constant('URL'); ?>public/img/upqroonew.png" alt="Universidad Politecnica" title="Universidad Politecnica" class="cover-img logo"/>
                                </div>
                        </div>
                        
                        <div class="column right align-center justify-center">
                            <div class="row container justify-center">
                                <form class="column form-data" method="POST" action="login" id="login">
                                    <div class="row responsive-img item-left justify-center align-center">
                                        <img src="<?php echo constant('URL'); ?>public/img/politecnica.jpg" alt="Universidad Politecnica" title="Universidad Politecnica" class="cover-img logo-mobile"/>
                                    </div>
                                    <h1 class="color-darkBlue font-double text-center title">UNIVERSIDAD POLITÉCNICA DE QUINTANA ROO</h1>
                                    <div class="white-space-24"></div>
                                    <p class="color-darkgray font-medium text-center">Introduzca sus datos de acceso</p>
                                    <div class="white-space-32"></div>
                                   
                                    <input type="text" name="matricula" placeholder="Matricula" class="input input-form" required>
                                    <div class="white-space-24"></div>
                                    <input type="password" name="pass" placeholder="Contraseña" class="input input-form" required>
                                    <div class="white-space-32"></div>
                                    <button class="btn btn-login  bg-darkBlue color-white font-regular weight-semi">
                                            INGRESAR 
                                    </button>

                                    <!-- Errores inico (Mover a donde vayan)-->
                                    <div class="white-space-32"></div>

                                    
                                    <?php if (isset($this->error)): ?>
                                        <div class="row-responsive justify-center">
                                            <div class="column text-left ">
                                                <p class=""><?php echo $this->error; ?></p>
                                            </div>
                                        </div>

                                        <div class="white-space-32"></div>
                                    <?php endif ?>
                                    <!--Errores fin-->     
                                    
                                    <div class="white-space-24"></div>
                                    <div class="row justify-center">
                                   <!-- <a class="color-lightBlue weight-semi text-center">¿Olvidaste tu contraseña?</a> -->
                                    </div>
                                </form>                               
                            </div>
                        </div> 
                    </div>

                   
                </div>
            </div> <!--/.background login-->
            
        </div> <!--/.column login-->

    </div> <!--/.main flex-->
    
</body>
</html>