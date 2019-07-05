<?php  
/**
 * 	Controlador que gestiona el kardex
 */


#
class KardexController extends Controller
{
	function __construct()
	{

		$this->auth = new AuthValidator();
		$this->validatorAuth($this->auth);
		// if (!$auth->makeAuth()) 
			// $this->localRedirect('login');		
		
		parent::__construct();
		$this->modeln    = "Kardex"; 
		$this->path      = "kardex";
		$this->routeView = "kardex/kardex";
	}

	public function render(){
		$this->view->render($this->routeView);
	}

	public function getKardex(){
		if ($this->validatorAuth($this->auth)) {
			$datos = $this->model->kardex($_SESSION['usuario']['matricula']);
			$this->view->datos = $datos;
			$this->render();
		}else{
			$this->localRedirect('login');
		}
	}
}
?>