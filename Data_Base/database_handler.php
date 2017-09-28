<?php
//установка соединения с СУБД
function connect($server_name, $username, $password) {
    return new mysqli($server_name, $username, $password);
}

//удаление и создание новой базы данных
function deleteAndCreateDataBase($conn, $nameBD){
    //удаление БД
    $sqlDropBase = "DROP DATABASE $nameBD";
    if ($conn->query($sqlDropBase) === TRUE) {
        echo "base $nameBD dropped\n";
    }

    //создание БД
    $sqlCreateDataBase = "CREATE DATABASE $nameBD CHARACTER SET utf8 COLLATE utf8_general_ci";
    if ($conn->query($sqlCreateDataBase) === TRUE) {
        echo "created $nameBD data base\n";
    }

    //установка использования текущей БД
    $sqlUseDataBase = "USE $nameBD";
    if ($conn->query($sqlUseDataBase) === TRUE) {
        echo "use $nameBD data base\n";
    }
}

//создание таблицы товарных позиций
function createTableGoods($conn, $nameTableStoreList, $storeListColumn1, $storeListColumn2, $massOfGoods){
    //создание таблицы
    $sqlCreateTableDataBase = "CREATE TABLE $nameTableStoreList
    ($storeListColumn1 INT(6)UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    $storeListColumn2 VARCHAR(20) NOT NULL)";
    if ($conn->query($sqlCreateTableDataBase) === TRUE) {
        echo "created table $nameTableStoreList with 
    $storeListColumn1 and $storeListColumn2 column\n";
    }

    //заполнение таблицы
    foreach ($massOfGoods as $value) {
        $sqlInsertInto = "INSERT INTO $nameTableStoreList($storeListColumn2) 
          VALUES ('" . $value . "')";
        if ($conn->query($sqlInsertInto) === TRUE) {
            echo "in $nameTableStoreList table, insert $value value\n";
        }
    }
}

//создание таблицы заказов
function createTableOrderByShop($conn, $nameTableOrderTable, $orderTableColumn1, $orderTableColumn2, $orderTableColumn3){
    //создание таблицы
    $sqlCreateTableOrder = "CREATE TABLE $nameTableOrderTable(
      $orderTableColumn1 VARCHAR(20) NOT NULL,
      $orderTableColumn2 INT(10) NOT NULL ,
      $orderTableColumn3 INT(10) NOT NULL)";
    if($conn->query($sqlCreateTableOrder) === TRUE){
        echo "create table $nameTableOrderTable successful. \n";
    }else{
        echo "$conn->error\n";
    }

    //установка ключа
    $sqlCreatePrimaryKeyOrderTable = "ALTER TABLE $nameTableOrderTable ADD PRIMARY KEY ($orderTableColumn1, $orderTableColumn2)";
    if($conn->query($sqlCreatePrimaryKeyOrderTable) === TRUE){
        echo "primary key is successful.\n";
    }else{
        echo "$conn->error\n";
    }
}