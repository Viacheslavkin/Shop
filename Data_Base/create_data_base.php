<?php
require "config.php";
require "database_handler.php";
require "initial_data.php";

//устанавливаем соединение с СУБД
$conn = connect();

//удаляем старую, создаем новую базу данных
deleteAndCreateDataBase($conn);

//создаем таблицы и колонки
createTableGoods($conn);
createTableOrderByShop($conn);

//закрытие соединения с СУБД
$conn->close();
?>