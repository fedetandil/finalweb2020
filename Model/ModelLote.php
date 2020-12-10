<?php
require_once "Model/Model.php";

class ModelLote extends Model
{

    function __construct()
    {
        parent::__construct();
    }
    //EJERCICIO 1 ALTERNATIVA B
    function addLote($nrolote,$vencimiento,$idciudad,$idlaboratorio){
        $query= $this->db->prepare('INSERT INTO lote(nro_lote,año_vencimiento,id_ciudad,id_laboratorio) VALUES(?,?,?,?)');
        $query->execute([$nrolote,$vencimiento,$idciudad,$idlaboratorio]);
        return $query->rowCount();
    }
    //EJERCICIO 2 ALTERNATIVA A
    function getLotesById($id){
        $query = $this->db->prepare('SELECT lote.*,ciudad.nombre as nombre_ciudad FROM lote INNER JOIN ciudad ON lote.id_ciudad=ciudad.id WHERE id=?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
