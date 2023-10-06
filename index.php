<?php
require_once ("include/database.php");
require_once("include/validate.php");

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>cost accounting</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="" method="get">
            <label for="">выберите продукт</label>
            <select name="product">
                <?php
                    foreach ((mysqli_query($connection, "SELECT * FROM products")->fetch_all()) as $product) {?>
                        <option value="<?php echo $product[0] ?>"><?php echo $product[1] ?></option><?php
                    }
                ?>
            </select>
            <label for="">введите название материала</label>
            <input type="text" name="material">
            <label for="">введите начальную дату</label>
            <input type="text" name="date_start" placeholder="2000-01-01">
            <label for="">введите конечную дату</label>
            <input type="text" name="date_end" placeholder="2000-01-01">
            <button type="submit">найти</button>
        </form>
    <?php

    if (!empty($_GET)) {

        if (validate($_GET) == null) {
            $material = ($_GET['material']);
            $product = ($_GET['product']);
            $date_start = date('Y-m-d',strtotime($_GET['date_start']));
            $date_end = date('Y-m-d',strtotime($_GET['date_end']));

            $sql = "SELECT products.title as product_title, materials.title as material_title, purchases.cost, purchases.purchase_date FROM purchases 
                                JOIN product_material ON product_material.id = purchases.purchase_id
                                LEFT JOIN materials ON product_material.material_id = materials.id
                                LEFT JOIN products ON products.id = product_material.product_id
                                WHERE products.id LIKE '$product' AND materials.title LIKE '%$material%' AND purchases.purchase_date >= '$date_start' AND purchases.purchase_date <= '$date_end'";

            $products = mysqli_query($connection, $sql)->fetch_all(MYSQLI_ASSOC);

            if (empty($products)) { ?>
                <label for=""><?php echo "Записи не найдены"; ?></label>
                <?php
            } else {
                $result = array();
                foreach ($products as $product) {
                    $result[$product['material_title']][] = $product;
                }

                ?>
                <table>
                    <thead>
                    <tr>
                        <th>изделие</th>
                        <th>материал</th>
                        <th>стоимость на начало периода</th>
                        <th>стоимость на конец периода</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($result as $products) {
                        $date_start = array(
                            'cost' => $products[0]['cost'],
                            'date' => $products[0]['purchase_date']
                        );
                        $date_end = array(
                            'cost' => $products[0]['cost'],
                            'date' => $products[0]['purchase_date']
                        );

                        foreach ($products as $product) {
                            if (date('Y-m-d', strtotime($product['purchase_date'])) > date('Y-m-d', strtotime($date_end['date']))) {
                                $date_end['date'] = $product['purchase_date'];
                                $date_end['cost'] = $product['cost'];
                            }
                            if (date('Y-m-d', strtotime($product['purchase_date'])) < date('Y-m-d', strtotime($date_start['date']))) {
                                $date_start['date'] = $product['purchase_date'];
                                $date_start['cost'] = $product['cost'];
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo $products[0]['product_title']?></td>
                            <td><?php echo $products[0]['material_title']?></td>
                            <td><?php echo $date_start['cost']?></td>
                            <td><?php echo $date_end['cost']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
        } else { ?>
            <label class="error" "><?php echo validate($_GET); ?></label>
            <?php
        }
    }
    ?>
    </div>
</body>
</html>