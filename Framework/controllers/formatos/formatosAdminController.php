<?php  
/**
 Controlador que gestiona acciones de los alumnos
 @author: Universidad Politecnica - Gustavo
 @description: Controladores para descarga de formatos
 */


#
class formatosAdminController extends Controller
{

	
	function __construct()
	{
		$this->auth = new AuthValidator();
		$this->validatorAuth($this->auth);

		// if (!$auth->makeAuth()) 
			// $this->localRedirect('login');		
		
		parent::__construct();
		$this->modeln    = "formatos"; 
		$this->path      = "formatos";
		$this->routeView = "formatos/formatos-admin";
	}

	public function render(){
		$this->view->render($this->routeView);
	}


	public function formatosAdmin()
	{

        if ($this->validatorAuth($this->auth)) {	

			if (isset($_POST['archivo'])) {

				$this->model->SubirArchivo($_POST["archivo"],basename($_POST["archivo"])); 
				unset($_POST["archivo"]);

			}
				
			$formatos = $this->model->GetFormatos();
			$this->view->Formatos = $formatos;

			$this->render();
			

        
        }else{
            $this->localRedirect('login');
        }
	  }
	
}
?>