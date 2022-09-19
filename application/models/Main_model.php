<?php
class Main_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Obtiene una fila segun la consulta
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table 	El nombre de la tabla
	 * @param  array 	$where 	Condiciones WHERE para las consultas
	 * @return object        	Resultado de la consulta realizada
	 */
	function get($table, $where=null){
		return $this->db->get_where($table, $where)->row();
	}

	/**
	 * Obtiene una fila segun la consulta
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table 	El nombre de la tabla
	 * @param  array 	$where 	Condiciones WHERE para las consultas
	 * @return object        	Resultado de la consulta realizada
	 */
	function getOrder($table, $order=null, $where=null){
		if($order){
			foreach($order as $orderby=>$direction){
				$this->db->order_by($orderby, $direction);
			}
		}
		return $this->get($table, $where);
	}

	/**
	 * Obtiene una fila con los campos seleccionados
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  El nombre de la tabla
	 * @param  string 	$select Campos que seran devueltos despues de la consulta
	 * @param  array 	$where  Condiciones WHERE para la consulta
	 * @return object         	Resultado de la consulta realizada
	 */
	function getSelect($table, $select=null, $where = null){
		$this->db->select($select, false);
		return $this->get($table, $where);
	}

	/**
	 * Obtiene la cantidad de registros segun la consulta
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  El nombre de la tabla
	 * @param  array 	$where  Condiciones WHERE para la consulta
	 * @return integer          Cantidad de resultados de la consulta realizada
	 */

	function total($table, $where = null){
		$this->db->distinct();

		return $this->db->get_where($table, $where)->num_rows();
	}

    /**
	 * La cantidad de registros de la seleccion
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  string  	$select  	Campos que seran seleccionados
	 * @param  array 	$where 		Condiciones WHERE para la eliminacion
	 * @return integer         		El resultado de la consulta
	 */
	function totalSelect($table, $select=null, $where = null){
		$this->db->select($select, false);
		return $this->total($table, $where);
	}

	/**
	 * Obtiene una lista con todos los campos segun la consulta
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  array 	$where  	Condiciones WHERE para la consulta
	 * @param  integer 	$limit  	Cantidad de resultados a mostrar
	 * @param  string 	$groupby 	Sirve para agrupar los resultados por algun campo en especifico
	 * @return object          		Los resultados de la consulta realizada
	 */

	function getList($table, $where = null, $limit = null, $offset = null, $groupby=null){
		$this->db->distinct();
		
		if($groupby){
			$this->db->group_by($groupby);
		}

		return $this->db->get_where($table, $where, $limit, $offset)->result();
	}

	/**
	 * Devuelve una lista ordenada por un campo
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  array    $order   	El campo a ordenarce y si es adc o desc
	 * @param  array 	$where  	Condiciones WHERE para la consulta
	 * @param  integer 	$limit  	Cantidad de resultados a mostrar
	 * @param  integer  $offset 	A partir de que registro se mostraran los rosultados
	 * @param  string 	$groupby 	Sirve para agrupar los resultados por algun campo en especifico
	 * @return object          		Los resultados de la consulta realizada
	 */

	function getListOrder($table, $order=null, $where = null, $limit = null, $offset = null, $groupby=null){
		if($order){
			foreach($order as $orderby=>$direction){
				$this->db->order_by($orderby, $direction);
			}
		}
		return $this->getList($table, $where, $limit, $offset, $groupby);
	}

    /**
	 * Obtiene una lista con los campos escogidos
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  string  	$select  	Campos que seran seleccionados
	 * @param  array 	$order   	Campo por el que seran ordenados los resultados
	 * @param  array 	$where 		Condiciones WHERE para la eliminacion
	 * @param  integer 	$limit  	Cantidad de resultados a mostrar
	 * @param  integer  $offset 	A partir de que registro se mostraran los rosultados
	 * @param  string 	$groupby 	Agrupa los resultados por algun campo en especifico
	 * @return object          		Resultado de la consulta realizada
	 */

	function getListSelect($table, $select=null, $order=null, $where = null, $limit = null, $offset = null, $groupby=null){
		if($order){
			foreach($order as $orderby=>$direction){
				$this->db->order_by($orderby, $direction);
			}
		}
		$this->db->select($select, false);
		return $this->getList($table, $where, $limit, $offset, $groupby);
	}

	/**
	 * Inserta registros a una tabla
	 *
	 * @author Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  array   	$data  		Los datos a insertarse en la tabla
	 * @return integer        		el Id generado tras la inserccion.
	 */
	 
	function insert($table, $data, $seq = null)
	{
		  $this->db->insert($table, $data);

		  if($seq)
		  {
			return $this->db->insert_id($seq);
		  } 
    }

	/**
	 * Actualiza un registro de una tabla
	 * Ing. John Evert Aleman Orellana
	 * @param  string 	$table  	El nombre de la tabla
	 * @param  array 	$set   		Los campos que seran actualizados
	 * @param  array 	$where 		Condiciones WHERE para la eliminacion
	 * @return void
	 */

	 function update($table, $set=null, $where = null) {

         $this->db->update($table, $set, $where);
     }

	/**
	 *	Un combo box para ser usado
	 *
	 * @param  array   $list  La lista para ser usado como un dropdown
	 * @param  string  $title El titulo o placeholder del dropdown
	 * @param  boolean $type  Typo de combo box para la devolucion
	 * @return object         Un lista tipo combobox
	 */
	function dropdown($list, $title=FALSE, $type=FALSE){
		$options = array();
		if($title!==FALSE){
			if($type){
				$options[] = array('key'=>'', 'value'=>$title);
			}
			else{
				$options =  array(''=>$title);
			}
		}
		foreach ($list as $item){
			if($type){
				$options[] = array('key'=>$item, 'value'=>end($item));
			}
			else{
				$options[current($item)] = end($item);
			}
		}
		return $options;
	}

		/**
	 * Obtiene el valor de un campo de una tabla de un registro
	 *
	 * @param  string $table El nombre de la tabla
	 * @param  string $field El campo de la tabla
	 * @param  array  $where Condiciones $where para la busqueda
	 * @return string        el resultado de la consulta
	 */
	function getField($table, $field, $where=null){
		$row = $this->db->get_where($table, $where)->row();

		return ($row)?$row->$field:'';
	}

	function getQuery($query) {          
		$data = $this->db->query($query) ;
		$result = $data->result();
		return $result;
  	}
	
	function getQuery2($query) {
		$res = false;          
		try {
			if($this->db->query($query)){
				$res = true;
			}
		} catch (Exception $e) {
			return false;
		}
		return $res;
  	}  
}