<?php 


class Order
{

    protected $id;
    protected $number;
    protected $product_id;
    protected $product_qty;
    protected $product_price_unit;
    protected $order_date;
    protected $order_status_id;
    protected $shipping_status;
    protected $user_id;

    //CONTRUCTOR
    function __construct(array $datos)
    {

        if (isset($datos["id"])) {
            $this->id = $datos["id"];
        } else {
            $this->id = NULL;
        }
        if (isset($datos["number"])) {
            $this->number = $datos["number"];
        } else {
            $this->number = NULL;
        }
        if (isset($datos["order_date"])) {
            $this->order_date = $datos["order_date"];
        } else {
            $this->order_date = NULL;
        }
        if (isset($datos["shipping_status"])) {
            $this->shipping_status = $datos["shipping_status"];
        } else {
            $this->shipping_status = NULL;
        }
        $this->product_id = $datos["product_id"];
        $this->product_qty = $datos["product_qty"];
        $this->product_price_unit = $datos["product_price_unit"];
        $this->order_status_id = $datos["order_status_id"];
        $this->user_id = $datos["user_id"];
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getProduct_id()
    {
        return $this->product_id;
    }

    public function getProduct_qty()
    {
        return $this->product_qty;
    }

    public function getProduct_price_unit()
    {
        return $this->product_price_unit;
    }

    public function getOrder_date()
    {
        return $this->order_date;
    }

    public function getOrder_status_id()
    {
        return $this->order_status_id;
    }

    public function getShipping_status()
    {
        return $this->shipping_status;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    // SETTERS
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function setProduct_id (int $product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }
    
    public function setProduct_qty (int $product_qty)
    {
        $this->product_qty = $product_qty;
        return $this;
    }

    public function setProduct_price_unit($product_price_unit)
    {
        $this->product_price_unit = $product_price_unit;
        return $this;
    }

    public function setOrder_date($order_date)
    {
        $this->order_date = $order_date;
        return $this;
    }

    public function setOrder_status_id($order_status_id)
    {
        $this->order_status_id = $order_status_id;
        return $this;
    }

    public function setShipping_status($shipping_status)
    {
        $this->shipping_status = $shipping_status;
        return $this;
    }

    public function setProvince_id($province_id)
    {
        $this->province_id = $province_id;
        return $this;
    }

    public function setUser_id($user_id)

    {
        $this->user_id = $user_id;
        return $user_id;
    }
}
