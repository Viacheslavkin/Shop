<?php
//соединение с базой данных
function connectDataBase($server_name, $username, $password, $nameBD){
    return new mysqli($server_name, $username, $password, $nameBD);
}

//извлечение массива названий товаров
function receive_the_goods ($conn, $nameTableStoreList){

    $sqlGetGoods = "SELECT ".STORE_LIST_COLUMN_2." FROM $nameTableStoreList";
    $result = $conn->query($sqlGetGoods);

    $row = $result->fetch_all();

    return $row;
}

//получение названия продукции по ключу
function getNameGoods($conn, $key){
    return (receive_the_goods ($conn, NAME_TABLE_STORE_LIST)[$key][0]);
}

//добавление единицы продукции
function add_product($key){
    $cart = getCookieGoods();
    if(!isset($cart[$key])){
        $cart[$key] = 0;
    }
    $cart[$key] += 1;
    setCookieGoods(NAME_LOCAL_STORAGE, $cart);
}

//получение количества продуктов из COOKIE-ов
function getCookieGoods (){
    if(!isset($_COOKIE[NAME_LOCAL_STORAGE])){
        return [];
    }
    return json_decode($_COOKIE[NAME_LOCAL_STORAGE],true);
}

//сохранение количества продуктов в COOKIE-ах
function setCookieGoods($name, $data){
    setcookie("$name", json_encode($data));
}

//очистка корзины
function clear_cart($name_cart_in_cookie){
    setcookie("$name_cart_in_cookie", '');
}

//возвращает уникальный номер для номера заказа
function guid(){
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s', str_split(bin2hex($data), 4));
}

//присвоение номера заказа и сохранение в таблице Order БД
function checkoutOrderTable($conn, $orderNumber){
    foreach(receive_the_goods($conn, NAME_TABLE_STORE_LIST) as $key=>$value) {
        $goodId = $key+1;
        if (isset(getCookieGoods(NAME_LOCAL_STORAGE)[$key])) {
            $sql = "INSERT INTO ".NAME_TABLE_ORDER."(".ORDER_TABLE_COLUMN_1.",".ORDER_TABLE_COLUMN_2.",
            ".ORDER_TABLE_COLUMN_3.")VALUES('".$orderNumber."','".$goodId."',
            '".getCookieGoods(NAME_LOCAL_STORAGE)[$key]."')";

            $conn->query($sql);
        }
    }
}

//асс массив заказов из БД
function getTableOrder($conn,$nameTableOrderTable, $orderTableColumn1, $nameTableStoreList,
                       $storeListColumn2, $orderTableColumn3, $storeListColumn1, $orderTableColumn2){
    $sql = "SELECT $nameTableOrderTable.$orderTableColumn1,  
        $nameTableStoreList.$storeListColumn2, $nameTableOrderTable.$orderTableColumn3
        FROM $nameTableOrderTable 
        JOIN $nameTableStoreList
        ON $nameTableStoreList.$storeListColumn1 = $nameTableOrderTable.$orderTableColumn2
        ";

    $result = $conn->query($sql);
    $row = $result->fetch_all();

    return $row;
}
?>