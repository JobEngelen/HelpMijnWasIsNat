<?php
include __DIR__ . '/../header.php';

// fetch json with php
$json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
$parsed_json = json_decode($json_string, true);

?>

<div id="product-grid">
    <div class="txt-heading">Products</div>
    <?php

    if (!empty($parsed_json)) {
        foreach ($parsed_json as $key => $value) {
    ?>
            <div class="product-item">
                <form id="frmCart">
                    <div class="product-image"><img src="<?php echo $value['image']; ?>"></div>
                    <div><strong><?php echo $value['title']; ?></strong></div>
                    <div class="product-price"><?php echo "$" . $value['price']; ?></div>
                    <div><input type="text" id="qty_<?php echo $value['id']; ?>" name="quantity" value="1" size="2" />
                        <?php
                        $in_session = "0";
                        if (!empty($_SESSION["cart_item"])) {
                            $session_code_array = array_keys($_SESSION["cart_item"]);
                            if (in_array($value['id'], $session_code_array)) {
                                $in_session = "1";
                            }
                        }
                        ?>
                        <input type="button" id="add_<?php echo $value['id']; ?>" value="Add to cart" class="btnAddAction cart-action" onClick="cartAction('add','<?php echo $value['id']; ?>')" <?php if ($in_session != "0") { ?>style="display:none" <?php } ?> />
                        <input type="button" id="added_<?php echo $value['id']; ?>" value="Added" class="btnAdded" <?php if ($in_session != "1") { ?>style="display:none" <?php } ?> />
                    </div>
                </form>
            </div>
    <?php
        }
    }
    ?>
</div>



<?php
include __DIR__ . '/../footer.php';
?>

<script>
    function cartAction(action, product_code) {
        var queryString = "";
        if (action != "") {
            switch (action) {
                case "add":
                    queryString = 'action=' + action + '&code=' + product_code + '&quantity=' + $("#qty_" + product_code).val();
                    break;
                case "remove":
                    queryString = 'action=' + action + '&code=' + product_code;
                    break;
                case "empty":
                    queryString = 'action=' + action;
                    break;
            }
        }
        jQuery.ajax({
            url: "ajax_action.php",
            data: queryString,
            type: "POST",
            success: function(data) {
                $("#cart-item").html(data);
                if (action != "") {
                    switch (action) {
                        case "add":
                            $("#add_" + product_code).hide();
                            $("#added_" + product_code).show();
                            break;
                        case "remove":
                            $("#add_" + product_code).show();
                            $("#added_" + product_code).hide();
                            break;
                        case "empty":
                            $(".btnAddAction").show();
                            $(".btnAdded").hide();
                            break;
                    }
                }
            },
            error: function() {}
        });
    }
</script>