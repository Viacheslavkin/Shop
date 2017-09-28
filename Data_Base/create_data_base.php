<?php
require "config.php";
require "database_handler.php";

//устанавливаем соединение с СУБД
$conn = connect(SERVER_NAME, USERNAME, PASSWORD);

//удаляем старую, создаем новую базу данных
deleteAndCreateDataBase($conn, NAME_BASE_DATA);

//создаем таблицы и колонки
createTableGoods($conn, NAME_TABLE_STORE_LIST, STORE_LIST_COLUMN_1, STORE_LIST_COLUMN_2,MASS_OF_GOODS);
createTableOrderByShop($conn, NAME_TABLE_ORDER, ORDER_TABLE_COLUMN_1, ORDER_TABLE_COLUMN_2, ORDER_TABLE_COLUMN_3);

//закрытие соединения с СУБД
$conn->close();
?>