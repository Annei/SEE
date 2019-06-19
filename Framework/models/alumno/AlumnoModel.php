<?php  
/**
 * 
 */
class AlumnoModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'sinTablita:3';
	}
	//MI CAMBIO CHIDO
	public function getDbfUser($matricula){
		$con = $this->DB->DBFconnect('DALUMN');
		$aux = null;

		if ($con) {
			$numero_registros = dbase_numrecords($con);
			

          for ($i = 1; $i <= $numero_registros; $i++) {

              $fila = dbase_get_record_with_names($con, $i);
               
              if (strcmp($fila["ALUCTR"],$matricula) == 0) {
              		// $aux = $fila;
              		$aux = [
							'matricula' => $fila['ALUCTR'],
							'nombre'    => $fila['ALUAPP'].' '.$fila['ALUAPM'].' '.$fila['ALUNOM'],
							'cumple'    => $fila['ALUNAC'],
							'direccion' => $fila['ALUTCL'].' '.$fila['ALUTNU'].' '.$fila['ALUTCO'],
							'cp'        => $fila['ALUTCP'],
							'cel'       => $fila['ALUTTE1'],
							'tel'       => $fila['ALUTTE2'],
							'email'     => $fila['ALUTMAI'],
							'curp'      => $fila['ALUCUR'],
							'sex'       => (strcmp($fila['ALUSEX'],'1') == 0 ? 'Hombre': 'Mujer')
              		];
              		break;
              }
              
              
          }

          dbase_close($con);
          return $aux;
		}
		return null;

	}


	public function getClave($matricula)
    {
        $datos = $this->DB->DBFconnect('DLISTA');
     	  $info = array();
        $aux = 0;

        if($datos){

            $numero_registros = dbase_numrecords($datos);
            for($i = 1; $i <= $numero_registros; $i++){
                $fila = dbase_get_record($datos, $i);
                if(strcmp($fila[1], $matricula) == 0){
                    $info=$fila[0];
                    $aux++;
                }
            }
            return (int)$info;


        }

    }

    public function getHorarios($matricula,$clave,$letra,$grupo){
        $datos= $this->DB->DBFconnect('DGRUPO');
		    $info = array();
        $aux = 0;

        if($datos){

            $numero_registros = dbase_numrecords($datos);
            for($i = 1; $i <= $numero_registros; $i++){
                $fila = dbase_get_record($datos, $i);
                if(strcmp($fila[0], $matricula)==0)
                {
                    if(strcmp($fila[3], $clave)==0)
                    {
                        if(strcmp($fila[4],$letra)==0)
                        {
                            if(strcmp($grupo,$fila[6])==0)
                              {
                                  $Mater = $fila[7];
                                  $grup = $fila[6];
                                  $Lunes = $fila[13];
                                  $Martes = $fila[15];
                                  $Miercoles = $fila[17];
                                  $Jueves = $fila[19];
                                  $Viernes = $fila[21];
                                  $Resultados ="Materia:".$Mater."Grupo".$grup."Lunes:".$Lunes."Martes:".$Martes."Miercoles:".$Miercoles."Jueves:".$Jueves."Viernes:".$Viernes;
                                  array_push($info, $Resultados);
                                  $aux++;
                             }
                        }
                    }
                }


            }
            return $info;
        }
}
public function getPeriodo($clavedeplan)
    {
      $datos = $this->DB->DBFconnect('DPERIO');
            $info = array();
            $aux = 0;

              if($datos){

                  $numero_registros = dbase_numrecords($datos);
                  for($i = 1; $i <= $numero_registros; $i++){
                      $fila = dbase_get_record($datos, $i);
                      if(strcmp($fila[0], $clavedeplan) == 0){
                          $info=$fila[3];
                          $aux++;
                      }
                  }
                  return $info;


              }

    }
    public function getCarrera($Carcb)
    {
        $datos = $this->DB->DBFconnect('DCARRE');
        $carrerabr = array();
        $aux = 0;

        if($datos){

            $numero_registros = dbase_numrecords($datos);
            for($i = 1; $i <= $numero_registros; $i++){
                $fila = dbase_get_record($datos, $i);
                if(strcmp($fila[0], $Carcb) == 0){
                    $carrerabr=$fila[3];
                    $aux++;
                }
            }
            return $carrerabr;
        }

    }
    public function getmatter($Claveplan,$matricula)
    {
        $datos = $this->DB->DBFconnect('DLISTA');
        $matter = array();
        $aux = 0;

        if($datos){

            $numero_registros = dbase_numrecords($datos);
            for($i = 1; $i <= $numero_registros; $i++){
                $fila = dbase_get_record($datos, $i);
                if(strcmp($fila[0], $Claveplan) == 0){
                    if(strcmp($fila[1], $matricula)==0)
                    {
                        $materia1=$fila[2];
                        array_push($matter, $materia1);
                         $aux++;
                    }
                }
            }
            return $matter;
        }

    }
// FIN PARTE WAKAI


// PARTE DEL LUCIO



/**
	  *Metodo: getPeriodo
	  *Descripcion: Se obtiene el ultimo cuatrimestre que ha cursado el alumno, senecesita obtener el ultimo período
	  *para poder utilizar la función getcalif
	  *Autor: Uziel Mendez
	  *Fecha: 19/06/2019 
*/

	 public function getPeriodol($matricula){
		//Nos conectamos al dbf
		$con = $this->DB->DBFconnect('DLISTA');
		//se inicializa una variable y la hacemos array
		$periodo = [];
	//validamos si entra en la conexión 
		if ($con) {
			$numero_registros = dbase_numrecords($con);
		//obtenemos todos los registros
          for ($i = 1; $i<=$numero_registros; $i++) {
			  
			$fila = dbase_get_record_with_names($con, $i);
			//validamos la matricula con el registro de la tabla 
			  
              if (strcmp($fila["ALUCTR"],$matricula) == 0) {
				 	//PDOCVE = Clave del Periodo	
				$aux = $fila['PDOCVE'];		
				  break;
              }              
		  }
		  return $periodo;
		  //Cerramos conexión
          dbase_close($con);
         
		}
		return null;
	}
	public function getcalif($matricula,$ultimo_p)
	{
				
				//Connexión a los dbf
				$con = $this->DB->DBFconnect('DLISTA');
				//Conexión a los dbf
		
				$conn = $this->DB->DBFConnect("DMATER");
				// inicializción de los arrays 
				$materia = [];
				$aux = [];
				// Validaci[on simple de conexión 
				if($con && $conn )
				{
					//El número de registro  que contiene 
					$numero_registros = dbase_numrecords($con);
					$numero_registross = dbase_numrecords($conn);
		
					
					$filaa = '';
				
					//obtenemos todos los registros
				for($i=1; $i<=$numero_registros;$i++) 	
					{
						//devuelve los registros
							$fila = dbase_get_record_with_names($con, $i);
						
						
		
						// validamos si es concuerda la matrícula y el último período
						if (strcmp($fila["ALUCTR"], $matricula) == 0  && $fila["PDOCVE"] == $ultimo_p ){
						
						//se obtinen los datos específicos 
						//Nombre tiene un # para inicializarlo
							
							$aux = [
								
								'Clave' => $fila['MATCVE'],
								'Nombre'=>'#',
								'Parcial1' =>$fila['LISPA1'],
								'Parcial2' =>$fila['LISPA2'],
								'Parcial3' =>$fila['LISPA3'],
								'Parcial4' =>$fila['LISPA4'],
								'Parcial5' =>$fila['LISPA5']
								
							];
					
						
							array_push($materia,$aux);
							
						
						}
				
							
							
						
					
					}
					//Necesitamos realizar el siguiente proceso para obtener el nombre de la materia
					
					for($s=1; $s <= $numero_registross;$s++) 	
					{
						$filaa = dbase_get_record_with_names($conn, $s);
						
						//Devolverá el tamaño que ocupa la variable 
						for($e=0 ; $e <sizeof($materia); $e++ ){
						
						//comparamos si clave de la materia 
							
						if (strcmp($materia[$e]['Clave'], $filaa['MATCVE']) == 0){
							//lo igualamos Nombre de la materia a nuestra variable
								$materia[$e]['Nombre'] = $filaa['MATNOM'];
							}
						}
					
					}
				
				
					return $materia;
				
					//cerramos la conexión
					dbase_close($con);
				}
				
	 		return null;
	}
// FIN PART DE LUCIO


}


?>