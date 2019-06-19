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
		$aux2 = null;

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
							'sex'       => (strcmp($fila['ALUSEX'],'1') == 0 ? 'Hombre': 'Mujer'),
							// 'ayudqa'	=> $fila['PLACRE'],
              		];
              		break;
              }
              
              
          }

          dbase_close($con);

          // Datos más tecnicos,clave
          $con = $this->DB->DBFconnect('DCALUM');
          if ($con) {
			$numero_registros = dbase_numrecords($con);
			

          for ($i = 1; $i <= $numero_registros; $i++) {

              $fila = dbase_get_record_with_names($con, $i);
               
              if (strcmp($fila["ALUCTR"],$matricula) == 0) {
              		// $aux = $fila;
              		$aux2 = [
							'plan_estudios' => $fila['PLACVE'],
							'id_carre'      => $fila['CARCVE'],
							'creditos'      => $fila['CALCAC'],
              		];
              		break;
              }
              
              
          }

          dbase_close($con);
          $aux = array_merge($aux,$aux2);








          
          return $aux;
		}
		return null;
	}
}

// PARTE DE VISTOR RIOS

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
		// $auxClase = new AlumnoModel;
		if($datos){
			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				$fila = dbase_get_record_with_names($datos, $i);
				if(strcmp($fila["ALUCTR"], $matricula) == 0){
					$claveCarrera = $fila['CARCVE'];
					$clavePlan = $fila['PLACVE'];
					return $fila['CALCAC'].' '. $this->creditosTotales($claveCarrera, $clavePlan);
				}
			}
		}
	}
	/* Retorna la informacion necesaria para la vista del kardex.
	 * La informacion de los creditos la obtiene del metodo creditos.
	 * La informacion del kardex la obtiene del DBF DKARDE.
	 * En la posicion 0,0 del array que se retorna se encuentra la informacion de los creditos
	 * posterior a eso (las siguientes posiciones del array) se encuentra la informacion del
	 * kardex, use el segundo for para introducir solo los datos necesarios en el array.
	 * Informacion de los valores del array info (despues de la informacion de los creditos):
	 * 0 = clave de la materia
	 * 1 = calificacion de la materia
	 * 2 = forma en que se paso la materia (en el kardex la columna se llama Op.)
	 * 3 = clave del periodo en el que se curso la primera vez
	 * 4 = cuatrimestre en el que se curso la primera vez
	 * 5 = dato vacio que no se que es
	 * 6 = clave del periodo en el que se curso la segunda vez (si es que reprobo)
	 * 7 = cuatrimestre en el que se curso la segunda vez (si es que reprobo)
	 * En cuanto a los periodos y materias solo retorno las claves, no las fechas y nombre
	 */
	public function kardex($matricula){
		$datos = $this->DB->DBFconnect("DKARDE");
		$info = array();
		$aux = 1;
		// $auxClase = new AlumnoModel;
		$info[0][0] = $this->creditos($matricula);
		if($datos){
			$numero_registros = dbase_numrecords($datos);
			for($i = 1; $i <= $numero_registros; $i++){
				
				$fila = dbase_get_record($datos, $i);
				if(strcmp($fila[0], $matricula) == 0){
					
					for($j = 1; $j < 9; $j++){
						$info[$aux][$j-1] = $fila[$j];
					}
					$aux++;
				}
			}
			return $info;
		}
	}


// FIN PARTE VICTOR RIOS


// PARTE DE GLORIA Y EL JUANILLO

public function getAcademicData($matricula)
	{
		
		/**Es muy importante que la matricula este bien validada, ya que con esta se realizan los metodos para validar
		 * en los DBF* */
		$cargaMaterias=$this->procesarDatosMaterias($matricula);
		$datosAlumno= $this->procesarDatosPeriodo($matricula);
		$newArr=array_merge($datosAlumno,$cargaMaterias);
		die(var_dump($newArr));
		return $datosAlumno;
		
	
	}
	/**
	 * Metodo: procesarDatosMateria
	 * Descripcion: Se asigna el nombre y el cr de las materias
	 * Autor: Gloria Aguilar
	 * Fecha: 14/06/2019* */
	public function procesarDatosMaterias($matricula){
		$aux=$this->procesarMaterias($matricula);
		
		foreach ($aux as $key => $value) {
			$nombres[]=$this->getMateriasNombres($key);
		}
		if(count($nombres)>0 && is_array($nombres)){
			foreach ($nombres as $indice=>$arrDatos){
				if(array_key_exists($arrDatos['clave_materia'],$aux))
				{
					$aux[$arrDatos['clave_materia']]['nombre_mater']=$arrDatos['materia_nom'];
					$aux[$arrDatos['clave_materia']]['cr']=$arrDatos['cr'];
				}
			}
		
			return $aux;
		}
		return null;
	
	}
	/**
	 * Metodo: procesarDatosPeriodo
	 * Descripcion: En este metodo se obtiene la descripcion de la carrera, 
	 * el periodo en el que ingreso el alumno, la clave de la carrera, la clave del plan,
	 * y se adjuntan los datos generales del alumno, todo en un array.
	 * NOTA: queda pendiente presentar el periodo actual, sin embargo parece inecesario porque ya existe
	 * vista general.
	 * Autor: Gloria Aguilar
	 * Fecha: 14/06/2019** */
	public function procesarDatosPeriodo($matricula)
	{
		$datos              = $this->getAlumnoUltimoCursado($matricula);
		$periodoAlumnoIngre = $this->getPeriodoAlumnoIngreso($datos['plan_clave'],$datos['clave_carrera']);
		$descripcionCarrera = $this->getCarreras($datos['clave_carrera']);
		$datosAlum			= $this->getDatosAlumn($matricula);
		$datos=array_merge($periodoAlumnoIngre,$descripcionCarrera);
		$datosGenerales=array_merge($datos,$datosAlum);
		return $datosGenerales;
		
	}
	/**
	 * Metodo:getDatosAlumn
	 * Descripcion: Obtenemos los datos del alumno con el que trabajaremos
	 * -importante: la matricula tiene que estar bien validad para que esto funcione correctamente-
	 * Nota: Parece ser inecesario porque ya existe vista general del alumno
	 * Autor: Gloria Aguilar
	 * Fecha: 13/06/2019* */
	public function getDatosAlumn($matricula){        
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
              		];
              		break;
              }
              
              
		  }
          dbase_close($con);
          return $aux;
		}
		return null;
	}
	/**
	 * Metodo: procesarMateris
	 * Descripcion: En esta funcion, se manda a llamar: las materias del respectivo periodo, los ultimos datos del
	 * del alumno que se ingresaron en los dbf, unna vez teniendo eso, se adjunta en un array los días de la semana, horas y el aula en la 
	 *donde se tomara la materia ¡AQUI NO SE ASIGNA EL NOMBRE!
	 * Autor: Gloria Aguilar
	 * Fecha: 13/06/2019
	 * Ultima modificacion: 14/06/2019
	 ** */
	public function procesarMaterias($matricula){
		/**Obtener ultimos datos cursados del alumno*/
		$datosCurso=$this->getAlumnoUltimoCursado($matricula);
		$datosCurso=((count($datosCurso)>0 && is_array($datosCurso))?$datosCurso:array());
		/**Obtener la carga de materias en el periodo actual*/
		$datosMateria = $this->getMateriasCargaH($matricula);
		$datosMateria = ((count($datosMateria)>0 && is_array($datosMateria))?$datosMateria:array());
		foreach($datosMateria as $ky=>$val){		
			$cargaMaterias[]=$this->getHorario($val['periodo'],$datosCurso['clave_carrera'],$datosCurso['plan_clave'],$val['clave_materia']);
			$grupoEstudiante=$val['grupo'];
		}
		/**Se realizo un metodo para quitar los espacios en blanco**/
		$grupoLimpio =$this->limpiarString($grupoEstudiante);
		/**Se recorre el array con las materias y grupo cargados, en este array se busca el
		 * grupo correspondiente del alumno para que se sepa el horario** */	
		if(count($cargaMaterias)>0 && is_array($cargaMaterias)){
			foreach($cargaMaterias as $indice=>$arrDatos){
				foreach($arrDatos as $key=>$arrMaterias){
					foreach($arrMaterias as $valores){
						if(strpos($valores['grupo'],$grupoLimpio)!==false){
							$datosCarga[$key]=$valores;
						}
					}
				}
			}
			return $datosCarga;
		}else{
			echo "Error #100";
		}
			return null;
		}
	/**
	 * Metodo: getAlumnoUltimoCursado,
	 * Descripcion: Este método obtiene la clave de la carrera, el ultimo cuatrimestre cursado,
	 * y el grupo al que pertenece. Este método servirá para obtener datos de otras tables.
	 * Autor: Gloria Aguilar
	 * Módulo: Carga Alumno
	 * Fecha: 13/06/2019
	 * */
	public function getAlumnoUltimoCursado($matricula){
		$con = $this->DB->DBFconnect('DCALUM');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
              $fila = dbase_get_record_with_names($con, $i);
              if (strcmp($fila["ALUCTR"],$matricula) == 0) {
              		// $aux = $fila;
              		$aux = array(
							'clave_carrera' => $fila['CARCVE'],
							'plan_clave'    => $fila['PLACVE'],
							'periodo_ingreso' =>$fila['CALING']
					  );
              		break;
              }              
          }
          dbase_close($con);
          return $aux;
		}
		return null;
	}
	/**
	 * Metodo: getMateriasCargaH
	 * Descripcion: En este metodo se el periodo del alumno que esta cursando
	 * -importante: es necesario pasar la matricula-
	 * Autor: Gloria Aguilar
	 * Fecha: 13/06/2019* */
	public function getMateriasCargaH($matricula){
		$con = $this->DB->DBFconnect('DLISTA');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
              $fila = dbase_get_record_with_names($con, $i);
              if (strcmp($fila["ALUCTR"],$matricula) == 0) {
				  if($fila['TCACVE']===0){
					$aux[] =array(
						'periodo'       => $fila['PDOCVE'],
						'matricula'     => $fila['ALUCTR'],
						'clave_materia' => $fila['MATCVE'],
						'grupo'         => $fila['GPOCVE'],
					
					);
				  }
              }              
          }
          dbase_close($con);
          return $aux;
		}
		return null;
	}
	/**
	 * Metodo:getHorario.
	 *Descripcion: En este metodo se obtienen los días, las horas
	 *en las que el alumno tendra la materia.
	 *Importante: Es necesario el periodo, la clave de la carrera, clave del periodo y el grupo
	 *Autor: Gloria Aguilar
	 *Fecha: 13/06/2019
	 * 
	  **/
	public function getHorario($periodo,$claveCarrera,$clavePeriodo,$materia){
		$con = $this->DB->DBFconnect('DGRUPO');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
			  $fila = dbase_get_record_with_names($con, $i);
			  //Obtenemos el periodo de la carga
              if (strcmp($fila["PDOCVE"],$periodo) == 0) {
				  if(strcmp($fila['CARCVE'],$claveCarrera)==0){
					if(strcmp($fila['PLACVE'],$clavePeriodo)==0){
 						if(strcmp($fila['MATCVE'],$materia)==0){
							$aux[$fila['MATCVE']][] =array(
								'lunes'			=>$fila['LUNHRA'],	
								'lunes_aula'	=>$fila['LUNAUL'],	
								'martes'		=>$fila['MARHRA'],	
								'martes_aula'	=>$fila['MARAUL'],	
								'miercoles'		=>$fila['MIEHRA'],	
								'miercoles_aula'=>$fila['MIEAUL'],	
								'jueves'		=>$fila['JUEHRA'],	
								'jueves_aula'	=>$fila['JUEAUL'],	
								'viernes'		=>$fila['VIEHRA'],	
								'viernes_aula'	=>$fila['VIEAUL'],
								'grupo'			=>$fila['GPOCVE'],
								'clave_materia' =>$fila['MATCVE'],
								'nombre_mater'  => '',
								'cr'            => ''
							);						
					  }
					}
					 
				  }
              }              
          }
          dbase_close($con);
		  return $aux;
		
		}
		return null;
		
	}
	public function getMateriasNombres($claveMateria){
		$con = $this->DB->DBFconnect('DMATER');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
              $fila = dbase_get_record_with_names($con, $i);
              if (strcmp($fila["MATCVE"],$claveMateria) == 0) {
              		$aux = array(
							'clave_materia' => $fila['MATCVE'],
							'materia_nom'   => $fila['MATNOM'],
							'cr'            => $fila['MATCRE']
					  );
              }              
          }
          dbase_close($con);
          return $aux;
		}
		return null;
	}
	/**
	 * Funcion: limpiarString
	 * Descripcion: Esta función sirve para limpiar los espacios en blanco de los datos
	 * que llegan de los DBF, se implementó por que si la cadena cuenta con algun espacio, este no lo detecta 
	 * y se omite el registro.
	 * Autor: Gloria Aguilar
	 * Fecha: 14/06/2019
	 * *** */
	public function limpiarString($cadena)
	{
		if($cadena!=="")
		{
			$newString =str_replace(' ', '', $cadena);
			return $newString;
		}
		return null;
	}
	/***
	 * Metodo: getPeriodoAlumnoIngreso
	 * Descripcion: Se obtienen el periodo del alumno cuando ingreso a la institucion
	 * Nota: Parecer ser inecesario pero así se muestra en la vista de Front
	 * Autor: Gloria Aguilar
	 * Fecha: 14/06/2019** */
	public function getPeriodoAlumnoIngreso($planClave,$carreraClave){
		$con = $this->DB->DBFconnect('DPLANE');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
              $fila = dbase_get_record_with_names($con, $i);
              if (strcmp($fila["PLACVE"],$planClave) == 0) {
				if (strcmp($fila["CARCVE"],$carreraClave) == 0) {
					$aux = array(
						'plan_inicio'  => $fila['PLACOF'],
						'clave_carrera' => $fila['CARCVE'],
						'plan_clave'    => $fila['PLACVE']
				  );
				  break;
				}
              }              
          }
          dbase_close($con);
          return $aux;
		}
		return null;
	}
	/***
	 * Metodo: getCarreras
	 * Descripcion: se obtiene el nombre y la descripcion de la carrera
	 * NOTA: parece ser inecesario porque ya existe una vista General y ahí se pueden obtener datos
	 * Autor: Gloria Aguilar
	 * Fecha: 14/06/2019** */
	public function getCarreras($clave_carrera)
	{
		$con = $this->DB->DBFconnect('DCARRE');
		$aux = null;
		if ($con) {
			$numero_registros = dbase_numrecords($con);
          for ($i = 1; $i <= $numero_registros; $i++) {
              $fila = dbase_get_record_with_names($con, $i);
				if (strcmp($fila["CARCVE"],$clave_carrera) == 0) {
					$aux = array(
						'carrera_nombre'=> $fila['CARNOM'],
						'carrera_abre'  => $fila['CARNCO']
				  );
				  break;
				}            
          	}		
          dbase_close($con);
          return $aux;
		}
		return null;
	}
// FIN PARTE GLORIA Y JUANILLO


// PARTE DEL WAKAI
// 

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