<?php  
/**
 * 
 */
class NotificacionModel extends Model
{
	
	function __construct(){
		parent::__construct();
		$this->table = 'sinTablita:3';
	}


	public function crearNotificacion($texto, $imagen, $carrera, $matricula){
		try{

			$sql = "CALL crear_notificacion(:texto,:imagen,:carrera,:matricula);";
			$query = $this->DB->MYSQLconnect()->prepare($sql);
			
			$data = [
				':texto' 		=> $texto,
				':imagen'	 	=> $imagen,
				':carrera'      => $carrera,
				':matricula'    => $matricula
			];
			
			$query->execute($data);
			
			// $this->DB = null;
			return true;

		}catch(PDOException $e){
			echo "<br> error ".$e." <br>";
			return false;
		}
	}


	public function getNoticia(){
		// traer_notificaciones
		
		try{
			
			$query = $this->DB->MYSQLconnect()->prepare("call traer_notificaciones();");
			
			$query->execute();
			
			$aux = [];	
			foreach ($query as $q) {

				array_push($aux,$q);
			}
		

			return $aux;

		}catch(PDOException $e){
			echo "<br> error ".$e." <br>";
			return null;
		}


	}

	/**
	 * [editNoticia description]
	 * @param  string $texto     [description]
	 * @param  string $image     path
	 * @param  int $carrera   [description]
	 * @param  [int] $idNoticia [description]
	 * @return [type]            [description]
	 */
	public function editNoticia($texto, $image, $carrera, $idNoticia){
		try{


			$sql = "CALL editar_notificacion(:texto,:imagen,:carrera,:id)";
			$query = $this->DB->MYSQLconnect()->prepare($sql);
			
			$data = [
				':texto' 	=> $texto,
				':imagen' 	=> $image,
				':carrera' 	=> $carrera,
				':id' 		=> $idNoticia,
				
			];
			
			$query->execute($data);
			
			// $this->DB = null;
			return true;

		}catch(PDOException $e){
			echo "<br> error ".$e." <br>";
			return false;
		}

	}



	public function getCarreras(){
		$con = $this->DB->DBFconnect('DCARRE');
		$car = [];

		if ($con) {
			$numero_registros = dbase_numrecords($con);
			

          	for ($i = 1; $i <= $numero_registros; $i++) {

	              $fila = dbase_get_record_with_names($con, $i);
	               
	              $aux = [
	              	'clave' 	=>$fila['CARCVE'],
	              	'nombre' 	=>$fila['CARNOM'],
	              	'nombre2' 	=>$fila['CARNCO'],
	              ];
	              array_push($car,$aux);
              
              
          	}

          dbase_close($con);
          return $car;
		}
		return null;

	}



}
?>