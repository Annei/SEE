<?php 

/**
 * 
 */
class NotificacionController extends Controller
{
	
	function __construct()
	{
		$this->auth = new AuthValidator();
		$this->validatorAuth($this->auth);
		// if (!$auth->makeAuth()) 
			// $this->localRedirect('login');		
		
		parent::__construct();
		$this->modeln    = "Notificacion"; 
		$this->path      = "notificacion";
		$this->routeView = "";
	}

	public function render(){
		$this->view->render($this->routeView);
	}


/**
 * CREA LA NOTIFICAICON LA IMAGEN VA SERIALIZADA
 * @return [type] [description]
 */
	public function crearNoticia(){
		// $texto, $imagen, $carrera, $matricula
		// La imagen va serializada
		//NOTICIA - IMAGEN - CARRERA - MATRICULA
		$this->model->crearNotificacion('Junta de jefes de grupo el 25 / 03 / 2020', '',1,201600321);
	}


	public function traerNoticia(){
		echo "<pre>";
		print_r($this->model->getNoticia());
		echo "</pre>";
	}

	public function editarNotificacion(){
		$this->model->editNoticia('Cambios realizados n','noticia.png',1,2);
	}

	public function carreras(){
		$carreras = $this->model->getCarreras();

		echo "<pre>";
		print_r($carreras);
		echo "</pre> xd";

	}


}

?>