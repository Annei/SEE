<?php  
	// TIPOS ACEPTADOS GET Y POST
/**
 * Rutas Autenticacion de usuarios
 */
	$this->newRoute('login','auth/authController','render');
	$this->newRoute('login','auth/authController','login','POST');
	$this->newRoute('logout','auth/authController','logout');


	$this->newRoute('alumnos/datos','alumno/alumnoController','datosGenerales');

	$this->newRoute('alumnos/horario','prototipo/segundoController','buscarHorario');

	$this->newRoute('alumnos/pass','alumno/alumnoController','cambiaPass');

	$this->newRoute('addadmin','auth/authController','crear_admin');

	$this->newRoute('crearNoticia','notificaciones/notificacionController','crearNoticia');
	$this->newRoute('noticias','notificaciones/notificacionController','traerNoticia');
	$this->newRoute('editarn','notificaciones/notificacionController','editarNotificacion');
	$this->newRoute('carreras','notificaciones/notificacionController','carreras');
	$this->newRoute('alumnos/horario','horario/horarioController','horario2');

	$this->newRoute('alumnos/carga-academica','carga/cargaController','academicDataMethod');
	$this->newRoute('alumnos/SEE_Carga_acádemica_PDF','cargapdf/cargapdfController','academicDataPdf');

	$this->newRoute('alumnos/formatos','formatos/formatosController','formatos');
	$this->newRoute('alumnos/Descargar','formatos/formatosController','Descargar');

	$this->newRoute('administrador/formatos','formatos/formatosAdminController','formatosAdmin');
	$this->newRoute('administrador/formatos','formatos/formatosAdminController','formatosAdmin', 'POST');

	$this->newRoute('alumnos/kardex','kardex/kardexController','getKardex');
	$this->newRoute('alumnos/calificaciones','calificaciones/calificacionesController','getCalificaciones');
	
	// carreras

/*cambiaPass
 *cread_admin

- CAMBIAR CONTRASEÑA
- Crear admin
- Crear Notificaciones

- Ver todas las notificaciones
- Editar Notificaciones 
- traer carreras


 */
?>
