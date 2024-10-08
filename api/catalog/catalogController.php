<?php
//добавляем Сервис
require_once("catalogService.php");
class catalogController
{
    protected $catalogService;
    function __construct($catalogService) {
        $this->catalogService = $catalogService;
    }
    
    //ф-ции
    
    //получить все
    public function getAll()
    {
        $responce = $this->catalogService->getAll();
        return $responce;
    }
    
    
    //добавить один
    public function addOne($header, $description, $composition, $weight, $price, $imgSrc)
    {
        $responce = $this->catalogService->addOne($header, $description, $composition, $weight, $price, $imgSrc);
       
        return $responce;
    }
    
    
    //удалить один
    public function deleteOne($id)
    {
        $responce = $this->catalogService->deleteOne($id);
        return $responce;

    }

}
//создаем объект из класса. если один объект из класса создаем, то его можно назвать также
$catalogController = new catalogController($catalogService); 
