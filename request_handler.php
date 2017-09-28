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
    clear_cart();
    header("Location: Pages/product_page.php");
}

//обработчик нажатия занесения заказа в базу данных
if(isset($_POST['checkout'])){
    checkoutOrderTable();
    header("Location: Pages/product_page.php");
}
?>