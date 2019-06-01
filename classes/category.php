<?php



class Category
{

    protected $id; 
    protected $name;
    protected $id_parent;

    //CONTRUCTOR
    function __construct(Array $datos){

        if(isset($datos["id"])){
            $this->id= $datos["id"];
        } else {
            $this->id = NULL;
        }
        $this->name = $datos["name"];
        $this->id_parent = $datos["id_parent"];

    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getId_parent() {
        return $this->id_parent;
    }

    // SETTERS
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setId_parent($id_parent) {
        $this->id_parent = $id_parent;
        return $this;
    }
}


?>