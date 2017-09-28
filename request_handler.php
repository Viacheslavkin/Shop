<?php
require "handler.php";
require "config.php";
require "Data_Base/config.php";

//обработчик нажатия кнопки добавить товар
if(isset($_POST['add_product_to_cart'])){
    add_product($_POST['add_product_to_cart']);
    header("Location: Pages/product_page.php");
}

//обработчик нажатия кнопки очистить корзину
if(isset($_POST['clear_cart'])){
    clear_cart(NAME_LOCAL_STORAGE);
    header("Location: Pages/product_page.php");
}

//обработчик нажатия занесения заказа в базу данных
if(isset($_POST['checkout'])){
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, NAME_BASE_DATA);
    $orderNumber = guid();
    checkoutOrderTable($conn,$orderNumber);
    $conn->close();
    header("Location: Pages/product_page.php");
}
?>