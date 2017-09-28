<?php
//установка соединения с СУБД
function connect() {
    return new mysqli(SERVER_NAME, USERNAME, PASSWORD);
}

//удаление и создание новой базы данных
function deleteAndCreateDataBase($conn){
    //удаление БД
    $sqlDropBase = "DROP DATABASE ".NAME_BASE_DATA;
    if ($conn->query($sqlDropBase) === TRUE) {
        echo "base ".NAME_BASE_DATA." dropped\n";
    }

    //создание БД
    $sqlCreateDataBase = "CREATE DATABASE ".NAME_BASE_DATA." CHARACTER SET utf8 COLLATE utf8_general_ci";
    if ($conn->query($sqlCreateDataBase) === TRUE) {
        echo "created ".NAME_BASE_DATA." data base\n";
    }

    //установка использования текущей БД
    $sqlUseDataBase = "USE ".NAME_BASE_DATA;
    if ($conn->query($sqlUseDataBase) === TRUE) {
        echo "use ".NAME_BASE_DATA." data base\n";
    }
}

//создание таблицы товарных позиций
function createTableGoods($conn){
    //создание таблицы
    $sqlCreateTableDataBase = "CREATE TABLE ".NAME_TABLE_STORE_LIST."
    (".STORE_LIST_COLUMN_1." INT(6)UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ".STORE_LIST_COLUMN_2." VARCHAR(20) NOT NULL)";
    if ($conn->query($sqlCreateTableDataBase) === TRUE) {
        echo "created table ".NAME_TABLE_STORE_LIST." with 
    ".STORE_LIST_COLUMN_1." and ".STORE_LIST_COLUMN_2." column\n";
    }

    //заполнение таблицы
    foreach (MASS_OF_GOODS as $value) {
        $sqlInsertInto = "INSERT INTO ".NAME_TABLE_STORE_LIST."(".STORE_LIST_COLUMN_2.") 
          VALUES ('" . $value . "')";
        if ($conn->query($sqlInsertInto) === TRUE) {
            echo "in ".NAME_TABLE_STORE_LIST." table, insert $value value\n";
        }
    }
}

//создание таблицы заказов
function createTableOrderByShop($conn){
    //создание таблицы
    $sqlCreateTableOrder = "CREATE TABLE ".NAME_TABLE_ORDER."(
      ".ORDER_TABLE_COLUMN_1." VARCHAR(20) NOT NULL,
      ".ORDER_TABLE_COLUMN_2." INT(10) NOT NULL ,
      ".ORDER_TABLE_COLUMN_3." INT(10) NOT NULL)";
    if($conn->query($sqlCreateTableOrder) === TRUE){
        echo "create table ".NAME_TABLE_ORDER;
        echo " successful.\n";
    }else{
        echo "$conn->error\n";
    }

    //установка ключа
    $sqlCreatePrimaryKeyOrderTable = "ALTER TABLE ".NAME_TABLE_ORDER." ADD PRIMARY KEY (".ORDER_TABLE_COLUMN_1.", ".ORDER_TABLE_COLUMN_2.")";
    if($conn->query($sqlCreatePrimaryKeyOrderTable) === TRUE){
        echo "primary key is successful.\n";
    }else{
        echo "$conn->error\n";
    }
}