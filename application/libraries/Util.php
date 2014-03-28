<?php

/**
 * Util - Métodos útiles
 *
 *@package      libraries
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util
{
	private $CI;	
	
	function __construct()
	{            
        $this->CI =& get_instance();
	}




    /**
	 * Envía una respuesta JSON
     * 
	 *
	 * @access	public
	 * @param	$ok boolean - TRUE si se puede dar la respuesta, FALSE si hay error
	 * @param 	$status int - codigo de exito / error
	 * @param 	$data array - datos a enviar en la respuesta 
 	 */
	public function json_response($ok, $status, $data)
    {
        echo json_encode(array(
            'ok' => $ok,
        	'status' => $status,
        	'data' => $data
        )); 
    }

    /**
	 * Busca el indice de un elemento de un arreglo de dos dimensiones compuesto de la siguiente manera:
     * arreglo[indice1=>[campo1=>valorA,campo2=>valorB] , indice2=>[campo1=>valorC,campo2=>valorD] ]
	 *
	 *	Si $campo = campo2 y $valor = valorB, la funcion retorna indice1
	 * @access	public
	 * @param	$arreglo array
	 * @param 	$campo string 
	 * @param 	$valor objeto
	 * @return 	indice o -1
 	 */
    public function buscar_indice($arreglo,$campo,$valor)
    {
    	$indice = NO_SELECTED;
    	foreach ($arreglo as $index => $fila) 
        {
            if($fila[$campo]==$valor)
            {
                $indice = $index;
                break;
            }
        }
        return $indice;
    }

    




}

/* Fin del archivo Util.php */
/* Ubicación: ./application/libraries/Util.php */