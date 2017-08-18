<?php

class Conex {

    private $con;
    private $stm;
    private $rs;
    

    public function __construct($bd) {
        try {
            $this->con = new PDO('mysql:host=localhost;dbname=' . $bd . ';charset=utf8', 'expresop_user', 'S1st3m4s', array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function desconectar() {
        $this->stm = null;
        $this->rs = null;
        $this->con = null;
    }

    public function findAll($tabla, $cond = "") {
        $this->stm = $this->con->prepare("select * from " . $tabla . $cond);
        $this->stm->execute();
        $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        return $this->rs;
    }

    public function findById($tabla, $fieldId, $id, $mode = "All") {
        $this->stm = $this->con->prepare("select * from " . $tabla . " where " . $fieldId . " = ?");
        $this->stm->execute(array($id));
        if ($mode == "All") {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            $this->rs = $this->stm->fetch(PDO::FETCH_OBJ);
        }
        return $this->rs;
    }

    public function execQuery($query) {
        $this->stm = $this->con->prepare($query);
        return $this->stm->execute();
    }

    public function checkID($tabla, $fieldId, $id) {
        $this->stm = $this->con->prepare("select * from " . $tabla . " where " . $fieldId . " = ?");
        $this->stm->execute(array($id));
        if ($this->stm->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function getTotalFilas() {
        return $this->stm->rowCount();
    }

}

?>
