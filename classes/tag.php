<?php
include_once("dbObjeto.php");

class tag extends dbObjeto{
	public $id;
	public $name;
	
	function tag($conn){
		$this->conection =$conn;
	}
	
	function actualizar(){
		if ($this->total > 0){
				mysqli_data_seek($this->lista,$this->indice);
				$row=mysqli_fetch_row($this->lista);
				$this->id = $row[0];
				$this->name = $row[1];
			}
	}

	function obtenerTodos(){
		$result = mysqli_query($this->conection,"SELECT * FROM tags ORDER BY ID DESC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();

		}
	function obtenerPorID($id){
		$result = mysqli_query($this->conection,"SELECT * FROM tags WHERE ID=$id");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
		
	function guardar(){
		$sql = "UPDATE Tags SET name = '$this->name' WHERE ID = $this->id";
		mysqli_query($this->conection,$sql);	
		}
		
	function crear(){
		$sql = "INSERT INTO Tags (name) VALUES ('New Tag')";
		mysqli_query($this->conection,$sql);	
		}
	
	function crear2($name){
		$sql = "INSERT INTO Tags (name) VALUES ('$name')";
		mysqli_query($this->conection,$sql);
		$id = mysqli_insert_id($this->conection);	
		$this->obtenerPorID($id);
		}
		
	function borrar(){
		//delete all asociated tweets
		$sql = "DELETE FROM tweets WHERE tag = $this->id";
		mysqli_query($this->conection,$sql);
		// delete the tag
		$sql = "DELETE FROM tags WHERE id = $this->id";
		mysqli_query($this->conection,$sql);
	}
	
	function existe($name){
		$esta = 0;
		for($i = 0; $i < $this->total; $i++){
			$this->ir($i);
			if(strnatcasecmp($this->name,$name) == 0){
				$esta = $this->id;
			}
		}
		
		return $esta;
	}
	

	
	
}
?>