<?php
require_once ("./api/db.php");
class authService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    //регистрация
    public function register($login, $name, $phone, $email, $password)
    {   
        //проверить логин нет ли такого в БД
        $query = "
        SELECT * 
        FROM `users` 
        WHERE users.login = '$login'
        ";
        //записываем в перемен рез
        $res = mysqli_query($this->connection, $query);
        //обрабатываем запрос. если кол-во строк больше нуля
        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Такой логин занят"];
        }

        //проверить почту
        $query = "
        SELECT * 
        FROM `users` 
        WHERE users.email = '$email'
        ";
        //записываем в перемен рез
        $res = mysqli_query($this->connection, $query);
        //обрабатываем запрос. если кол-во строк больше нуля
        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Такая почта уже есть"];
        }

        //проверить телефон
        $query = "
        SELECT * 
        FROM `users` 
        WHERE users.phone = '$phone'
        ";
        //записываем в перемен рез
        $res = mysqli_query($this->connection, $query);
        //обрабатываем запрос. если кол-во строк больше нуля
        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Такой телефон уже есть"];
        }

        //добавить пользователя в БД
        $query = "
        INSERT INTO `users`(`login`, `name`, `phone`, `email`, `pass`)
        VALUES ('$login', '$name', '$phone', '$email', '$password')
        ";
        $res = mysqli_query($this->connection, $query);

        //Получить данные только что добавленного пользователя по логину для создания корзины и избранного 
        $query = "
        SELECT `id` 
        FROM `users`
        WHERE users.login = '$login';
        ";
        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows == 0) {
            return ['error' => "Ошибка! Пользователь не был добавлен"];
        }
        //запись в переменную id только что добавленного юзера. row становится массивом строчкой ответом из БД
        $row = mysqli_fetch_assoc($res);
        //$row = ['id'=>1] достаем по ключу id
        $id = $row['id'];

        //Создать корзину для данного нового юзера
        $query = "
        INSERT INTO `basket`(`userId`)
        VALUES ($id);
        ";
        $res = mysqli_query($this->connection, $query);

        //Получить все данные польз-ля + id корзины  и вернуть на фронтенд 
        $query = "
        SELECT U.id AS 'userId', U.login, U.pass, U.name, U.role, U.phone, U.email, B.id AS 'basketId'
        FROM `users` AS U, `basket` AS B
        WHERE U.id = $id AND B.userId = U.id
        ";
        $res = mysqli_query($this->connection, $query); 
        $res = mysqli_fetch_assoc($res);
        //['name' => 'Vasya446'...] превращает в ассоциат массив как строка из users из БД 

        //возвращение поль-ля
        return $res;

    }

    //вход
    public function login($login, $password)
    {
        //$pass = md5($password);
        //Проверка на логин и пароль
        $query = "
        SELECT U.id AS 'userId', U.login, U.pass, U.name, U.role, U.phone, U.email, B.id AS 'basketId'
        FROM `users` AS U, `basket` AS B
        WHERE U.login = '$login' AND U.pass = '$password' AND B.userId = U.id
        ";
        $res = mysqli_query($this->connection, $query); 
        
        if ($res->num_rows == 0) {
            return ['error' => "Ошибка! Неверный пароль или логин"];
        }

        $res = mysqli_fetch_assoc($res);
        //['name' => 'Vasya446'...] превращает в ассоциат массив как строка из users из БД 

        //возвращение поль-ля
        return $res;
    }
}

$authService = new authService($connection);