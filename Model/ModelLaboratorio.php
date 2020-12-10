<?php

require_once "Model/Model.php";
class ModelLaboratorio extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    //EJERCICIO 1 ALTERNATIVA B
    function getLaboratorio($id){
        $query= $this->db->prepare('SELECT laboratorio.* FROM laboratorio WHERE id=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
