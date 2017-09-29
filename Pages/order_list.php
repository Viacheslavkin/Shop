<?php
    require "../handler.php";
    require "../Data_Base/config.php";
?>
<html>
    <body>
        <table>
            <?php
                foreach (getTableOrder() as $orderId => $goods) {
                    echo "<tr align='center'><td colspan='2'>номер заказа: ".$orderId."</td></tr>";
                    echo "<tr><td>имя товара: </td><td>кол-во: </td></tr>";
                    foreach ($goods as $good) {
                        echo "<tr align='center'><td>".$good['goodName']."</td>";
                        echo "<td>".$good['count']."</td></tr>";
                    }
                }
            ?>
        </table>
        <a href="product_page.php" title="к списку продукции">Back</a>
    </body>
</html>
