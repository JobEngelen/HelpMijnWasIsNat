<?php
include __DIR__ . '/../header.php';

// fetch json with php
$json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
$parsed_json = json_decode($json_string, true);

?>

<script> // Automatically load shoppingcart when loading page
    window.onload = function() {
        cartAction('show', '');
    };
</script>

<div id="product-grid row">
    <!--<div class="txt-heading">Products</div>-->
    <div class="col-md-12 text-center pb-5">
        <h1>HelpMijnWasIsNat.nl</h1>
    </div>
    <div class="col-md-4 text-center w-25 bg-light">
        <p>filters</p>
    </div>
    <?php

    if (!empty($parsed_json)) {
    ?>
        <div class="container content col-md-6">
            <div class="product-item row">
                <?php
                foreach ($parsed_json as $key => $value) {
                    $rating = $value['rating'];
                ?>
                    <form id="frmCart" class="card col-sm-4 w-30">
                        <div>
                            <p class="hidden"><?php echo $value['title']; ?></p> <!-- search filter -->
                            <div class="p-3">
                                <div class="product-image thumbnail">
                                    <img src="<?php echo $value['image']; ?>">
                                </div>
                                <h3><?php echo $value['title']; ?></h3>
                                <p><?php echo $value['content']; ?></p>
                                <h4 class="col-md-6 text-warning p-0">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($rating >= 1) {
                                    ?><span class="fas fa-star"></span>
                                        <?php
                                        } else if ($rating == 0.5) {
                                        ?><span class="fas fa-star-half-alt"></span>
                                        <?php
                                        } else {
                                        ?><span class="far fa-star"></span>
                                    <?php
                                        }
                                        $rating -= 1;
                                    }
                                    ?>
                                </h4>
                                <h4 class="product-price col-md-6">
                                    Prijs: €<?php echo $value['price']; ?>
                                </h4>
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
                                    <input type="button" id="add_<?php echo $value['id']; ?>" value='Voeg toe aan winkelwagen' class="btnAddAction cart-action btn btn-primary btn-block" onClick="cartAction('add','<?php echo $value['id']; ?>')" <?php if ($in_session != "0") { ?>style="display:none" <?php } ?> />
                                    <input type="button" id="added_<?php echo $value['id']; ?>" value="In winkelwagen" class="btnAdded btn btn-primary btn-block" <?php if ($in_session != "1") { ?>style="display:none" <?php } ?> />
                                </div>
                    </form>
            </div>
        </div>
<?php
                }
            }
?>
</div>

</div>
<div id="col-md-4 shopping-cart">
    <h3 class="txt-heading w-100">
        <i class="fas fa-shopping-cart"></i> Winkelwagen
        <a id="btnEmpty" class="cart-action btn btn-primary" onClick="cartAction('empty','');">
            <i class="fas fa-trash-alt"></i> Leeg winkelwagen
        </a>
    </h3>
    <div id="cart-item"></div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>

<!-- SEARCH FILTER SCRIPT -->
<script>
    const input = document.querySelector("input");

    const filterFunction = () => {
        const cards = document.querySelectorAll(".card");
        cards.forEach((item) => {
            let whatToSearch = item.querySelector("p");
            if (
                whatToSearch.innerHTML.toUpperCase().indexOf(input.value.toUpperCase()) >
                -1
            ) {
                item.style.display = "";
            } else {
                item.style.display = "none";

            }
        });
    };
    input.addEventListener("keyup", filterFunction);
</script>

<!-- SHOPPING CART SCRIPT -->
<script>
    $(document).ready(function() {
        cartAction('', '');
    })
</script>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
    function showEditBox(editobj, id) {
        $('#frmAdd').hide();
        $(editobj).prop('disabled', 'true');
        var currentMessage = $("#message_" + id + " .message-content").html();
        var editMarkUp = '<textarea rows="5" cols="80" id="txtmessage_' + id + '">' + currentMessage + '</textarea><button name="ok" onClick="callCrudAction(\'edit\',' + id + ')">Save</button><button name="cancel" onClick="cancelEdit(\'' + currentMessage + '\',' + id + ')">Cancel</button>';
        $("#message_" + id + " .message-content").html(editMarkUp);
    }

    function cancelEdit(message, id) {
        $("#message_" + id + " .message-content").html(message);
        $('#frmAdd').show();
    }

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
                case "show":
                    queryString = 'action=' + action;
                    break;
            }
        }
        jQuery.ajax({
            url: "/ajax/shoppingcart",
            data: queryString,
            type: "POST",
            success: function(data) {
                $("#cart-item").html(data);
                if (action != "/ajax/shoppingcart") {
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