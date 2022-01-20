<?php
require __DIR__ . '/../services/userservice.php';

class AjaxController
{

    private $ajaxService;

    function __construct()
    {
        //$this->ajaxService = new AjaxService();
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
                        //$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
                        if (!empty($parsed_json)) {
                            foreach ($parsed_json as $key => $value) {
                                if ($value['id'] == $_POST["code"]) {
                                    $itemArray = array($value["id"] => array('name' => $value["title"], 'code' => $value["id"], 'quantity' => $_POST["quantity"], 'price' => $value["price"]));
                                    if (!empty($_SESSION["cart_item"])) {
                                        if (in_array($value["id"], $_SESSION["cart_item"])) {
                                            foreach ($_SESSION["cart_item"] as $k => $v) {
                                                if ($value["id"] == $k)
                                                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                                            }
                                        } else {
                                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
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
            }
        }

?>
        <table cellpadding="10" cellspacing="1" class="table w-25">
            <tbody>
                <?php
                if (isset($_SESSION["cart_item"])) {
                    $item_total = 0;
                ?>
                    <tr>
                        <th scope="col">
                            <h4>Name</h4>
                        </th>
                        <th scope="col">
                            <h4>Quantity</h4>
                        </th>
                        <th scope="col">
                            <h4>Price</h4>
                        </th>
                        <th scope="col">
                            <h4>Action</h4>
                        </th>
                    </tr>
                    <?php
                    foreach ($_SESSION["cart_item"] as $item) {
                    ?>
                        <tr>
                            <td>
                                <h4><?php echo $item["name"]; ?></h4>
                            </td>
                            <td>
                                <h4><?php echo $item["quantity"]; ?></h4>
                            </td>
                            <td>
                                <h4><?php echo "€" . $item["price"]; ?></h4>
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
                            <h4><strong>Total:</strong></h4>
                        </td>
                        <td>
                            <h4><?php echo "$" . $item_total; ?></h4>
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align=right>
                            <a class="btn btn-success w-100">
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