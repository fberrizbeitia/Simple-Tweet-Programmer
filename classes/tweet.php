<?php
include_once("dbObjeto.php");

class tweet extends dbObjeto{
	public $id;
	public $text;
	public $tag;
	
	function tweet($conn){
		$this->conection =$conn;
	}
	
	function actualizar(){
		if ($this->total > 0){
				mysqli_data_seek($this->lista,$this->indice);
				$row=mysqli_fetch_row($this->lista);
				$this->id = $row[0];
				$this->text = $row[1];
				$this->tag = $row[2];
			}
	}

	function obtenerTodos(){
		$result = mysqli_query($this->conection,"SELECT * FROM tweets ORDER BY ID DESC");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();

		}
	function obtenerPorID($id){
		$result = mysqli_query($this->conection,"SELECT * FROM tweets WHERE ID=$id");
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
		}
		
	function guardar(){
		$sql = "UPDATE Tweets SET text = '$this->text', tag = $this->tag WHERE ID = $this->id";
		mysqli_query($this->conection,$sql);	
		}
		
	function crear($text,$tag){
		$sql = "INSERT INTO Tweets (text,tag) VALUES ('$text',$tag)";
		mysqli_query($this->conection,$sql);	
		}
		
	function borrar(){
		$sql = "DELETE FROM tweets WHERE id = $this->id";
		mysqli_query($this->conection,$sql);
	}
	
	function buscar($query){
		$sql = "SELECT * FROM tweets WHERE text LIKE '%$query%'";
		$result = mysqli_query($this->conection,$sql);
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
			
	} 
	
	function obtenerPorTag($idTag){
		$sql = "SELECT * FROM tweets WHERE tag = $idTag";
		$result = mysqli_query($this->conection,$sql);
		$this->lista = $result;
		$this->total = mysqli_num_rows($result);
		$this->indice = 0;
		$this->actualizar();
			
	} 
	
}
?>