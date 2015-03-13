<?php
include_once("dbObjeto.php");

class quenue extends dbObjeto{
	public $idTask;
	public $idTweet;
	public $pos;
	public $posted;
	
	function quenue($conn){
		$this->conection =$conn;
	}
	
	function actualizar(){
		if ($this->total > 0){
				mysqli_data_seek($this->lista,$this->indice);
				$row=mysqli_fetch_row($this->lista);
				$this->idTask = $row[0];
				$this->idTweet = $row[1];
				$this->pos = $row[2];
				$this->posted = $row[3];
			}
	}

	function obtenerTodos(){
		$result = mysqli_query($this->conection,"SELECT * FROM quenue ORDER BY pos ASC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();

		}
	function obtenerPorID($id){
		$result = mysqli_query($this->conection,"SELECT * FROM quenue WHERE idTask=$id ORDER BY pos ASC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
	
	function obtenerNoEnviadosPorID($id){
		$result = mysqli_query($this->conection,"SELECT * FROM quenue WHERE idTask=$id AND posted = 0 ORDER BY pos ASC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
		
	function obtenerPorIDs($idTask,$idTweet){
		$result = mysqli_query($this->conection,"SELECT * FROM quenue WHERE idTask=$idTask AND idTweet = $idTweet");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}	
		
	function guardar(){
		$sql = "UPDATE quenue SET pos = '$this->pos',posted = '$this->posted' WHERE idTask = $this->idTask and idTweet=$this->idTweet";
		mysqli_query($this->conection,$sql);	
		}
		
	function crear($idTask,$idTweet){
		$sql = "INSERT INTO quenue (idTask,idTweet,pos,posted) VALUES ($idTask,$idTweet,0,0)";
		mysqli_query($this->conection,$sql);	
		}
		
	function borrar(){
		$sql = "DELETE FROM quenue WHERE idTask = $this->idTask and idTweet=$this->idTweet";
		mysqli_query($this->conection,$sql);
	}
	
	
}
?>