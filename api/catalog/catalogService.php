<?php
require_once ("./api/db.php");
class catalogService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    //получить все
    public function getAll()
    {
        //все товары
        $query = "SELECT * FROM `productsCoffee`";

        $res = mysqli_query($this->connection, $query);

        $productsCoffee = []; //создали пустой массив, чтоб вернуть. чтоб на фронте записать в перемн и с ней работать

        if ($res->num_rows > 0) {
            //перебирает каждую строчку ф-я
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($productsCoffee, $row); //заполняем массив строчками из ответа из БД
                // print_r($row);
                // echo "<br>";
            }

        }
        // print_r($productsCoffee);
        return $productsCoffee;

        // print_r($res);

    }
}
$catalogService = new catalogService($connection); 