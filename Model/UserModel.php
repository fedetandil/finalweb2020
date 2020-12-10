<?php

require_once "Model/Model.php";

class UserModel
{
    function __construct()
    {
        parent::__construct();
    }
    //EJERCICIO 1 ALTERNATIVA B
    function getUser($email){
        $query= $this->db->prepare('SELECT FROM users WHERE email=?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
