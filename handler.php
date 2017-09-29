<?php
//соединение с базой данных
function connectDataBase(){
    return new mysqli(SERVER_NAME, USERNAME, PASSWORD, NAME_BASE_DATA);
}

//извлечение массива названий товаров
function receive_the_goods (){
    $conn = connectDataBase();

    $sqlGetGoods = "SELECT ".STORE_LIST_COLUMN_2." FROM ".NAME_TABLE_STORE_LIST;
    $result = $conn->query($sqlGetGoods);

    $row = $result->fetch_all();
    $conn->close();

    //преобразование к удобному виду
    $r = [];
    foreach ($row as $key => $item) {
        $r[$key] =$item[0];
    }
    return $r;
}

//получение названия продукции по ключу
function getNameGoods($key){
    $conn = connectDataBase();
    $ret = receive_the_goods ()[$key];
    $conn->close();
    return $ret;
}

//добавление единицы продукции
function add_product($key){
    $cart = getCookieGoods();
    if(!isset($cart[$key])){
        $cart[$key] = 0;
    }
    $cart[$key] += 1;
    setCookieGoods($cart);
}

//получение количества продуктов из COOKIE-ов
function getCookieGoods (){
    if(!isset($_COOKIE[NAME_LOCAL_STORAGE])){
        return [];
    }
    return json_decode($_COOKIE[NAME_LOCAL_STORAGE],true);
}

//сохранение количества продуктов в COOKIE-ах
function setCookieGoods($data){
    setcookie(NAME_LOCAL_STORAGE, json_encode($data));
}

//очистка корзины
function clear_cart(){
    setcookie(NAME_LOCAL_STORAGE, '');
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
function checkoutOrderTable(){
    $conn = connectDataBase();
    $orderNumber = guid();
    foreach(receive_the_goods() as $key=>$value) {
        $goodId = $key+1;
        if (isset(getCookieGoods()[$key])) {
            $sql = "INSERT INTO ".NAME_TABLE_ORDER."(".ORDER_TABLE_COLUMN_1.",".ORDER_TABLE_COLUMN_2.",
            ".ORDER_TABLE_COLUMN_3.")VALUES('".$orderNumber."','".$goodId."',
            '".getCookieGoods()[$key]."')";

            $conn->query($sql);
        }
    }
    $conn->close();
}

//асс массив заказов из БД
function getTableOrder(){

    $conn = connectDataBase();

    $sql = "SELECT ".NAME_TABLE_ORDER.".".ORDER_TABLE_COLUMN_1.",". NAME_TABLE_STORE_LIST.".".STORE_LIST_COLUMN_2.",". NAME_TABLE_ORDER.".".ORDER_TABLE_COLUMN_3." 
        FROM ".NAME_TABLE_ORDER." 
        JOIN ".NAME_TABLE_STORE_LIST."
        ON ".NAME_TABLE_STORE_LIST.".".STORE_LIST_COLUMN_1." = ".NAME_TABLE_ORDER.".".ORDER_TABLE_COLUMN_2;
    $result = $conn->query($sql);
    $row = $result->fetch_all();
    $conn->close();

    //преобразование к удобному виду
    $ret = [];
    foreach ($row as $key => $item) {
        if (!isset($r[$item[0]])) {
            $ret[$item[0]] = [];
        }
        $ret[$item[0]][] = [
            'goodName' => $item[1],
            'count' => $item[2]
        ];
    }
    return $ret;
}
