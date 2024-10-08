<?php
require_once("authService.php");
class authController
{
    protected $authService;
    function __construct($authService) {
        $this->authService = $authService;
    }
    //ф-ции
    
    //зарегистр -ть пользователя
    public function register($login, $name, $email, $phone, $password)
    {
        $responce = $this->authService->register($login, $name, $email, $phone, $password);
        return $responce;
    
    }
    
    //вход пользов-ля (на логин и пароль)
    public function login($login, $password)
    {
        $responce = $this->authService->login($login, $password);
        return $responce;
    }
   
}
//создаем объект из класса. если один объект из класса создаем, то его можно назвать также
$authController = new authController($authService); 
