<?php

//для отрисовки, заказ его параметры и массив продуктов в нем
class Order {
    public $id;
    public $userName;
    public $adress;
    public $phone;
    public $payOffline;
    public $complited;
    public $products = [];
    function __construct($id, $userName, $adress, $phone, $payOffline, $complited, $products) {
        $this->id = $id;
        $this->userName = $userName;
        $this->adress = $adress;
        $this->phone = $phone;
        $this->payOffline = $payOffline;
        $this->complited = $complited;
        $this->products = $products;
    }
}
