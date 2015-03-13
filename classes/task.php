<?php
include_once("dbObjeto.php");

class task extends dbObjeto{
	public $id;
	public $name;
	public $beginDate;
	public $endDate;
	public $interval;
	
	function task($conn){
		$this->conection =$conn;
	}
	
	function actualizar(){
		if ($this->total > 0){
				mysqli_data_seek($this->lista,$this->indice);
				$row=mysqli_fetch_row($this->lista);
				$this->id = $row[0];
				$this->name = $row[1];
				$this->beginDate = $row[2];
				$this->endDate = $row[3];
				$this->interval = $row[4];
			}
	}

	function obtenerTodos(){
		$result = mysqli_query($this->conection,"SELECT * FROM tasks ORDER BY ID DESC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();

		}
	function obtenerPorID($id){
		$result = mysqli_query($this->conection,"SELECT * FROM tasks WHERE ID=$id");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
		
	function obtenerActuales(){
		$sql = "SELECT * FROM `tasks` where curdate() >= begindate and curdate() <= endDate";
		$result = mysqli_query($this->conection,$sql);
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
		
	function guardar(){
		$sql = "UPDATE tasks SET name = '$this->name',beginDate = '$this->beginDate', endDate = '$this->endDate', inter = '$this->interval'  WHERE ID = $this->id";
		mysqli_query($this->conection,$sql);	
		}
		
	function crear($name,$beginDate,$endDate,$interval){
		$sql = "INSERT INTO tasks (name,beginDate,endDate,inter) VALUES ('$name','$beginDate','$endDate',$interval)";
		mysqli_query($this->conection,$sql);	
		}
		
	function borrar(){
		$sql = "DELETE FROM quenue WHERE idTask = $this->id";
		mysqli_query($this->conection,$sql);
		$sql = "DELETE FROM tasks WHERE id = $this->id";
		mysqli_query($this->conection,$sql);
	}
	 
	
}
?>