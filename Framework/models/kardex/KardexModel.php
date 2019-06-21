<?php
class KardexModel extends Model
{
    /* Retorna los creditos totales del plan de estudios.
	 * La informacion de los creditos totales se encuentra en el DBF DPLANE.
	 * Identifico el plan de estudios del alumno mediante la clave de la carrera
	 * y la clave del plan de estudios que se obtienen del DBF DCALUM en la funcion creditos.
	 * Informacion de las columnas del DBF DPLANE:
	 * CARCVE = clave de la carrera
	 * PLACVE = clave del plan de estudios
	 * PLACRE = creditos del plan de estudios
	 */
	public function creditosTotales($claveCarrera, $clavePlan){

		$datos = $this->DB->DBFconnect("DPLANE");

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["CARCVE"], $claveCarrera) == 0 && strcmp($fila["PLACVE"], $clavePlan) == 0){
					return $fila['PLACRE']; 
				}
			}
		}
	}

	/* Retorna los creditos acumulados del alumno y los creditos totales del plan de estudios.
	 * La informacion de los creditos acumulados del alumno esta en el DBF DCALUM y retorno
	 * tambien los creditos totales para devolver (posteriormente) toda la informacion del
	 * kardex (necesaria) con un solo metodo.
	 * Informacion de las columnas del DBF DCALUM:
	 * ALUCTR = matricula del alumno
	 * CARCVE = clave de la carrera
	 * PLACVE = clave del plan de estudios
	 * CALCAC = creditos acumulados del alumno
	 */
	public function creditos($matricula){

		$datos = $this->DB->DBFconnect("DCALUM");
		$auxClase = new KardexModel;

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["ALUCTR"], $matricula) == 0){
					$claveCarrera = $fila['CARCVE'];
					$clavePlan = $fila['PLACVE'];
					return $fila['CALCAC'].' de '. $auxClase->creditosTotales($claveCarrera, $clavePlan);
				}
			}
		}

	}
	public function porcentaje($matricula){
		$datos = $this->DB->DBFconnect("DCALUM");
		$auxClase = new KardexModel;

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["ALUCTR"], $matricula) == 0){
					$claveCarrera = $fila['CARCVE'];
					$clavePlan = $fila['PLACVE'];
					$creditos =  $fila['CALCAC'];
					$creditos_total = $auxClase->creditosTotales($claveCarrera, $clavePlan);
					$porcentaje = $creditos * 100 / $creditos_total;
					return round($porcentaje, 2);
				}
			}
		}

	}
    /* Retorna el nombre de la materia
	 * La informacion del nombre de la materia se obtiene del DBF DMATER
	 * solo retorna el nombre de acuerdo a la clave de la materia
	 * Informacion de las columnas del DBF DMATER:
	 * MATCVE = clave de la materia
	 * MATNOM = nombre de la materia
	 */
	public function materia($claveMateria){

		$datos = $this->DB->DBFconnect("DMATER");

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["MATCVE"], $claveMateria) == 0){
					return $fila['MATNOM'];
				}
			}
		}
	}

	/* Retorna la fecha del periodo
	 * La informacion de la fecha del periodo se obtiene del DBF DPERIO
	 * solo retorna la fecha de acuerdo a la clave del periodo
	 * Informacion de las columnas del DBF DPERIO:
	 * PDOCVE = clave del periodo
	 * PDODES = descripcion del periodo (fechas)
	 */
	public function periodo($clavePeriodo){

		$datos = $this->DB->DBFconnect("DPERIO");

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["PDOCVE"], $clavePeriodo) == 0){
					return $fila['PDODES'];
				}
			}
		}
	}
	public function promedio($matricula){
		$datos = $this->DB->DBFconnect("DKARDE");
		$info = array();
		$auxClase = new KardexModel;
		$calificaciones = 0;
		$num_materias = 1;
		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["ALUCTR"], $matricula) == 0){
					$calificaciones = $calificaciones + $fila['KARCAL'];
					$num_materias = $num_materias + 1;
				}
			}
			$promedio = $calificaciones / $num_materias;
			return round($promedio, 2);
		}
	}
    /* Retorna la informacion necesaria para la vista del kardex.
	 * La informacion de los creditos la obtiene del metodo creditos.
	 * La informacion del kardex la obtiene del DBF DKARDE.
	 * En la posicion 0,0 del array que se retorna se encuentra la informacion de los creditos
	 * posterior a eso (las siguientes posiciones del array) se encuentra la informacion del
	 * kardex, use el segundo for para introducir solo los datos necesarios en el array.
	 * Informacion de los valores del array info (despues de la informacion de los creditos):
	 * claveMat 	= clave de la materia
	 * nombreMat 	= nombre de la materia
	 * calfMat 		= calificacion de la materia
	 * opMat 		= forma en que se paso la materia (en el kardex la columna se llama Op.)
	 * cuatriPri 	= cuatrimestre en el que se curso la primera vez
	 * periodPri 	= clave del periodo en el que se curso la primera vez
	 * cuatriSeg 	= cuatrimestre en el que se curso la segunda vez (si es que reprobo)
	 * periodSeg 	= clave del periodo en el que se curso la segunda vez (si es que reprobo)
	 * especial 	= fecha en que se hizo una evaluacion especial (global)
	 */
	public function kardex($matricula){

		$datos = $this->DB->DBFconnect("DKARDE");
		$info = array();
		$auxClase = new KardexModel;

		$info[0]['creditos'] = $auxClase->creditos($matricula);
		$info[1]['porcentaje'] = $auxClase->porcentaje($matricula);
		$info[2]['promedio'] = $auxClase->promedio($matricula);

		if($datos){

			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["ALUCTR"], $matricula) == 0){

					$aux = [
							'claveMat' 		=> $fila['MATCVE'],
							'nombreMat' 	=> $auxClase->materia($fila['MATCVE']),
							'calfMat'   	=> $fila['KARCAL'],
							'opMat' 		=> $fila['TCACVE'],
							'cuatriPri' 	=> $fila['KARNPE1'],
							'periodPri' 	=> $auxClase->periodo($fila['PDOCVE1']),
							'cuatriSeg' 	=> $fila['KARNPE2'],
							'periodSeg' 	=> $auxClase->periodo($fila['PDOCVE2']),
							'especial'  	=> $fila['KARFEC']
					];
					array_push($info, $aux);  
				}
			}
			return $info;
		}
	}
}
?>