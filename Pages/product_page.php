<?php
require "../handler.php";
require "../Data_Base/config.php";
?>
<html>
    <body>
        <form action="../request_handler.php" method="post">
            <table>
                <?php
                    foreach (receive_the_goods() as $goodId => $goods){
                    echo "<tr>";
                    echo "<td>".$goods."</td><td><button name='add_product_to_cart'
                    value='$goodId' title='Добавить в корзину'> Add to Cart </button></td>";
                    echo "</tr>";
                    }
                ?>
            <tr><td><a href="cart.php" title="корзина">Cart </a></td>
            <td><a href="order_list.php" title="список заказов">Order list</a></td></tr>
            </table>
        </form>
    </body>
</html>
