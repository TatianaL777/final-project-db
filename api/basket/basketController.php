<?php
require_once("basketService.php");
class BasketController 
{
    protected $basketService;
    function __construct($basketService) {
        $this->basketService = $basketService;
    }

    public function getOne($id)
    {
        $responce = $this->basketService->getOne($id);
        return $responce;
  
        // echo "you get $id basket";
    }

    //добавить один в корзину
    public function addOne($basketId, $productsCoffeeId, $count)
    {
        $responce = $this->basketService->addOne($basketId, $productsCoffeeId, $count);
        return $responce;

        // echo "you add $id product";
    }

    // обновить один (не используется в данном случае. кол-во меняем в inpute
    // и идет сразу в заказ)
    public function updateOne($busketToClothId, $newCount)
    {
        $responce = $this->basketService->updateOne($busketToClothId, $newCount);
        return $responce;

    }

    //удалить один
    public function deleteOne($userId, $productsCoffeeId)
    {
        $responce = $this->basketService->deleteOne($userId, $productsCoffeeId);
        return $responce;

        // echo "you delete $id product";
    }

}
//создаем объект из класса. если один объект из класса создаем, то его можно назвать также
$basketController = new BasketController($basketService); 


    
