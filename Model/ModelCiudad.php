<?php

require_once "Model/Model.php";
class ModelCiudad extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    //EJERCICIO 1 ALTERNATIVA B
    function getCiudad($id){
        $query= $this->db->prepare('SELECT ciudad.* FROM ciudad WHERE id=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
//EJERCICIO 2 ALTERNATIVA A
    function getCiudades(){
        $query= $this->db->prepare('SELECT * FROM ciudad');
        $query->execute([]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
