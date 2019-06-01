<?


class Product
{

    protected $id;
    protected $name;
    protected $short_desc;
    protected $long_desc;
    protected $price;
    protected $thumbnail;
    protected $color_id;
    protected $size_id;
    protected $stock;
    protected $date_upload;
    protected $date_update;
    protected $discount_off;
    protected $category_id;

    //CONTRUCTOR
    function __construct(array $datos)
    {

        if (isset($datos["id"])) {
            $this->id = $datos["id"];
        } else {
            $this->id = NULL;
        }
        if (isset($datos["short_desc"])) {
            $this->short_desc = $datos["short_desc"];
        } else {
            $this->short_desc = NULL;
        }
        if (isset($datos["long_desc"])) {
            $this->long_desc = $datos["long_desc"];
        } else {
            $this->long_desc = NULL;
        }
        if (isset($datos["color_id"])) {
            $this->color_id = $datos["color_id"];
        } else {
            $this->color_id = NULL;
        }
        if (isset($datos["seize_id"])) {
            $this->size_id = $datos["seize_id"];
        } else {
            $this->size_id = NULL;
        }
        if (isset($datos["date_update"])) {
            $this->date_update = $datos["date_update"];
        } else {
            $this->date_update = NULL;
        }
        if (isset($datos["discount_off"])) {
            $this->discount_off = $datos["discount_off"];
        } else {
            $this->discount_off = NULL;
        }
        $this->name = $datos["name"];
        $this->price = $datos["price"];
        $this->thumbnail = $datos["thumbnail"];
        $this->stock = $datos["stock"];
        $this->date_upload = $datos["date_upload"];
        $this->category_id = $datos["category_id"];
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getShort_desc()
    {
        return $this->short_desc;
    }

    public function getLong_desc()
    {
        return $this->long_desc;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getColor_id()
    {
        return $this->color_id;
    }

    public function getSize_id()
    {
        return $this->size_id;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getDate_upload()
    {
        return $this->date_upload;
    }

    public function getDate_update()
    {
        return $this->date_update;
    }

    public function getDiscount_off()
    {
        return $this->discount_off;
    }

    public function getCategory_id()
    {
        return $this->category_id;
    }


    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setShort_desc($short_desc)
    {
        $this->short_desc = $short_desc;
        return $this;
    }
    public function setLong_desc($long_desc)
    {
        $this->long_desc = $long_desc;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function setColor_id($color_id)
    {
        $this->color_id = $color_id;
        return $this;
    }

    public function setSize_id($size_id)
    {
        $this->size_id = $size_id;
        return $this;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    public function setDate_upload($date_upload)
    {
        $this->date_upload = $date_upload;
        return $this;
    }

    public function setDate_update($date_update)
    {
        $this->date_update = $date_update;
        return $this;
    }

    public function setDiscount_off($discount_off)
    {
        $this->discount_off = $discount_off;
        return $this;
    }

    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }
}
