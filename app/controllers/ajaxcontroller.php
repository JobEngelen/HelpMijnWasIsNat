<?php
//require __DIR__ . '/../services/userservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';

class AjaxController
{
    private $shoppingCartService;

    function __construct()
    {
        $this->shoppingCartService = new ShoppingCartService();
    }

    public function shoppingCart()
    {
        session_start();
        $json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
        $parsed_json = json_decode($json_string, true);

        if (!empty($_POST["action"])) {
            switch ($_POST["action"]) {
                case "add":
                    if (!empty($_POST["quantity"])) {
                        if (!empty($parsed_json)) {
                            foreach ($parsed_json as $key => $value) {
                                if ($value['id'] == $_POST["code"]) {
                                    $itemArray = array($value["id"] => array('name' => $value["title"], 'code' => $value["id"], 'quantity' => $_POST["quantity"], 'price' => $value["price"]));
                                    if (!empty($_SESSION["cart_item"])) {
                                        if (!in_array($value["id"], $_SESSION["cart_item"])) {
                                            $inCart = false;
                                            foreach ($_SESSION["cart_item"] as $k => $v) {
                                                if ($value["id"] == $v["code"]) {
                                                    $_SESSION["cart_item"][$k]["quantity"]++;
                                                    $inCart = true;
                                                    break;
                                                }
                                            }
                                            if (!$inCart) {
                                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                            }
                                        }
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                                }
                            }
                        }
                    }
                    break;
                case "remove":
                    if (!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($_POST["code"] == $_SESSION["cart_item"][$k]["code"]) {
                                unset($_SESSION["cart_item"][$k]);
                            }
                            if (empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                    break;
                case "empty":
                    unset($_SESSION["cart_item"]);
                    break;
                case "minusQ":
                    if (!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($_POST["code"] == $_SESSION["cart_item"][$k]["code"] && $_SESSION["cart_item"][$k]["quantity"] > 1) {
                                $_SESSION["cart_item"][$k]["quantity"]--;
                            } else if ($_POST["code"] == $_SESSION["cart_item"][$k]["code"] && $_SESSION["cart_item"][$k]["quantity"] == 1) {
                                unset($_SESSION["cart_item"][$k]);
                            }
                            if (empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                    break;
                case "addQ":
                    if (!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($_POST["code"] == $_SESSION["cart_item"][$k]["code"]) {
                                $_SESSION["cart_item"][$k]["quantity"]++;
                            }
                        }
                    }
                    break;
                case "order":
                    if (!empty($_SESSION["cart_item"])) {
                        $this->shoppingCartService->order();
                    }
                    break;
            }
        }
?>
        <table align=right cellpadding="10" cellspacing="1" class="table w-25">
            <tbody>
                <?php
                if (isset($_SESSION["cart_item"])) {
                    $item_total = 0;
                ?>
                    <tr>
                        <th class="col-md-4">
                            <h4>Naam</h4>
                        </th>
                        <th class="col-md-3">
                            <h4>Aantal</h4>
                        </th>
                        <th class="col-md-2">
                            <h4>Prijs</h4>
                        </th>
                        <th class="col-md-1">
                            <h4>Actie</h4>
                        </th>
                    </tr>
                    <?php
                    foreach ($_SESSION["cart_item"] as $item) {
                    ?>
                        <tr>
                            <td>
                                <h4><?php echo $item["name"]; ?></h4>
                            </td>
                            <td class="container">
                                <div class="row">
                                    <div class="col">
                                        <a onClick="cartAction('minusQ','<?php echo $item["code"]; ?>')" class="btnMinusQAction cart-action btn btn-secondary">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <h4><?php echo $item["quantity"]; ?></h4>
                                    </div>
                                    <div class="col">
                                        <a onClick="cartAction('addQ','<?php echo $item["code"]; ?>')" class="btnAddQAction cart-action btn btn-secondary">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td align=right>
                                <h4><?php echo "€" . $item["price"] * $item["quantity"]; ?></h4>
                            </td>
                            <td>
                                <a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action btn btn-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td align=right>
                            <h4><strong>Totaal:</strong></h4>
                        </td>
                        <td align=right>
                            <h4><?php echo "€" . $item_total; ?></h4>
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align=right>
                            <a onClick="cartAction('order','')" class="btn btn-success w-100">
                                <h4>Bestelling afronden</h4>
                            </a>
                        </td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <th scope="col">
                            <h3 class="text-muted text-center">Winkelwagen is leeg</h3>
                        </th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    }
}
?>