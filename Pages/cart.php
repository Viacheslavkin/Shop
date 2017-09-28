<?php
require "../handler.php";
require "../config.php";
require "../Data_Base/config.php";
?>
<html>
    <body>
        <form action="../request_handler.php" method="post">
            <table>
                <?php
                    foreach (getCookieGoods() as $goodId => $goodCount){
                        echo "<tr>";
                        echo "<td>".getNameGoods($goodId)."</td><td>".$goodCount."</td>";
                        echo "</tr>";
                    }
                ?>
                <tr><td><button name="clear_cart" title="Очистка корзины">Clear</button></td>
                <td><button name="checkout" title="Сохранить с базу данных">Checkout</button></td></tr>
                <tr><td><a href="product_page.php" title="возврат">Back</a></td></tr>
            </table>
        </form>
    </body>
</html>
