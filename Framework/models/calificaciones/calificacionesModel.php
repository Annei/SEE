<?php
class CalificacionesModel extends Model
{
	public function getPeriodol($matricula){
		$con = $this->DB->DBFconnect('DLISTA');
		$periodo = [];
		if ($con) {
			$numero_registros = dbase_numrecords($con);
            for ($i = 1; $i<=$numero_registros; $i++) {
				$fila = dbase_get_record_with_names($con, $i);
            	if (strcmp($fila["ALUCTR"],$matricula) == 0) {
					$aux = $fila['PDOCVE'];		
					break;
            	}              
			}
			return $periodo;
		    dbase_close($con);		
  		}
		return null;
	}
	public function getcalif($matricula,$ultimo_p){
		$con = $this->DB->DBFconnect('DLISTA');
		$conn = $this->DB->DBFConnect("DMATER");
		$materia = [];
		$aux = [];
		if($con && $conn ){
			$numero_registros = dbase_numrecords($con);
			$numero_registross = dbase_numrecords($conn);
			$filaa = '';
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($con, $i);
				if (strcmp($fila["ALUCTR"], $matricula) == 0  && $fila["PDOCVE"] == $ultimo_p ){
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
			for($s=1; $s <= $numero_registross;$s++){
				$filaa = dbase_get_record_with_names($conn, $s);
				for($e = 0; $e < sizeof($materia); $e++ ){
					if (strcmp($materia[$e]['Clave'], $filaa['MATCVE']) == 0){
						$materia[$e]['Nombre'] = $filaa['MATNOM'];
					}
				}
			}
			return $materia;
			dbase_close($con);
		}
	 	return null;
	}
	public function getClave($matricula){
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
	public function getPeriodo($clavedeplan){
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
   	public function getGrupo($matricula){
        $con = $this->DB->DBFconnect('DCALUM');
       	$aux = null;
       	if ($con) {
        	$numero_registros = dbase_numrecords($con);
         	for ($i = 1; $i <= $numero_registros; $i++) {
             	$fila = dbase_get_record_with_names($con, $i);
             	if (strcmp($fila["ALUCTR"],$matricula) == 0) {
                     // $aux = $fila;
                    $aux = [
                        'estudia' => "0".$fila["CARCVE"].$fila["PLACVE"]
                    ];															# estos necesitos
                    break;
             	}
         	}	
         	dbase_close($con);
         	return $aux;
        }
       return null;
    }
    public function getNumeroGrupo($matricula){
        $con = $this->DB->DBFconnect('DCALUM');
       	$aux = null;
       	if ($con) {
        	$numero_registros = dbase_numrecords($con);
         	for ($i = 1; $i <= $numero_registros; $i++) {
             	$fila = dbase_get_record_with_names($con, $i);
             	if (strcmp($fila["ALUCTR"],$matricula) == 0) {
                     // $aux = $fila;
                   
                    $aux = $fila["CARCVE"];
                    break;
             	}
         	}	
         	dbase_close($con);
         	return $aux;
        }
       return null;
    }
    public function getCarrera($clave)
    {
       $datos = $this->DB->DBFconnect('DCARRE');
       $carrerabr = array();
       $aux = 0;
       if($datos){
           $numero_registros = dbase_numrecords($datos);
           for($i = 1; $i <= $numero_registros; $i++){
               $fila = dbase_get_record($datos, $i);
               if(strcmp($fila[0], $clave) == 0){
                   $carrerabr=$fila[3];
                   $aux++;
               }
           }
           return $carrerabr;
       }
    }

}
?>