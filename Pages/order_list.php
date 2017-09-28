<?php
    require "../handler.php";
    require "../Data_Base/config.php";
?>
<html>
    <body>
        <table>
                <?php
                    $conn = connectDataBase(SERVER_NAME, USERNAME, PASSWORD, NAME_BASE_DATA);
                    $lastOrder = 0;
                    foreach (getTableOrder($conn,NAME_TABLE_ORDER, ORDER_TABLE_COLUMN_1,
                        NAME_TABLE_STORE_LIST,STORE_LIST_COLUMN_2,ORDER_TABLE_COLUMN_3,
                        STORE_LIST_COLUMN_1,ORDER_TABLE_COLUMN_2) as $key=>$item){
                        if($lastOrder != $item[0]){
                            echo "<tr align='center'><td colspan='2'>Order $item[0]</td></tr>";
                            echo "<tr align='center'><td>Name of product</td><td>Quantity of goods</td></tr>";
                        }
                        echo "<tr align='center'>";
                        echo "<td>$item[1]</td><td>$item[2]</td>";
                        echo "</tr>";
                        $lastOrder = $item[0];
                    }
                ?>
        </table>
        <a href="product_page.php" title="к списку продукции">Back</a>
    </body>
</html>
