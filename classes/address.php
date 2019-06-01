<?

// include_once("user.php");
// include_once("province.php");
// include_once("country.php");

class Address
{

    protected $id;
    protected $user_id; //ver
    protected $street;
    protected $street_2;
    protected $number;
    protected $piso;
    protected $dpto;
    protected $city;
    protected $cp;
    protected $province_id; //ver
    protected $country_id; //ver

    //CONTRUCTOR
    function __construct(array $datos)
    {

        if (isset($datos["id"])) {
            $this->id = $datos["id"];
        } else {
            $this->id = NULL;
        }
        if (isset($datos["street_2"])) {
            $this->street_2 = $datos["street_2"];
        } else {
            $this->street_2 = NULL;
        }
        if (isset($datos["number"])) {
            $this->number = $datos["number"];
        } else {
            $this->number = NULL;
        }
        if (isset($datos["piso"])) {
            $this->piso = $datos["piso"];
        } else {
            $this->piso = NULL;
        }
        if (isset($datos["dpto"])) {
            $this->dpto = $datos["dpto"];
        } else {
            $this->dpto = NULL;
        }
        $this->street = $datos["street"];
        $this->city = $datos["city"];
        $this->cp = $datos["cp"];
        $this->province_id = $datos["province_id"];
        $this->country_id = $datos["country_id"];
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getStreet_2()
    {
        return $this->street_2;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPiso()
    {
        return $this->piso;
    }

    public function getDpto()
    {
        return $this->dpto;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCp()
    {
        return $this->cp;
    }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function setStreet_2($street_2)
    {
        $this->street_2 = $street_2;
        return $this;
    }
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setPiso($piso)
    {
        $this->piso = $piso;
        return $this;
    }

    public function setDpto($dpto)
    {
        $this->dpto = $dpto;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
        return $this;
    }
    public function setProvince_id($province_id)
    {
        $this->province_id = $province_id;
        return $this;
    }
}
