<?php
    require "../handler.php";
    require "../Data_Base/config.php";
?>
<html>
    <body>
        <table>
                <?php
                    $lastOrder = 0;
                    foreach (getTableOrder() as $key=>$item){
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
