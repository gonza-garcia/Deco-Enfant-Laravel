<?php



class Size
{

    protected $id; 
    protected $name;

    //CONTRUCTOR
    function __construct(Array $datos){

        if(isset($datos["id"])){
            $this->id= $datos["id"];
        } else {
            $this->id = NULL;
        }
        $this->name = $datos["name"];

    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
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
}
