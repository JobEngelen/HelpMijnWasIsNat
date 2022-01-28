<?php
include __DIR__ . '/../header.php';

// fetch json with php
$json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
$parsed_json = json_decode($json_string, true);

?>

<script>
    // Automatically load shoppingcart when loading page
    window.onload = function() {
        cartAction('show', '');
    };
</script>

<div id="product-grid row">
    <!--<div class="txt-heading">Products</div>-->
    <div class="col-md-12 text-center pb-5">
        <h1>HelpMijnWasIsNat.nl</h1>
    </div>
    <div class="col-md-4 w-25">
        <h3><i class="fas fa-sliders-h pb-5 px-5"></i> Filters</h3>
        <div class="slidecontainer px-5">
            <h4>Minimum prijs: €<i id="minPrice"></i></h4>
            <input type="range" name="filterPrice" default="0" min="0" max="1000" value="0" class="slider" id="filterPrice">
            <h4 class="mt-4">Minimum rating <i id="minRating" class="text-warning"></i></h4>
            <input type="range" name="filterRating" default="0" min="0" max="5" value="0" step="0.5" class="slider" id="filterRating">
        </div>
    </div>
    <?php

    if (!empty($parsed_json)) {
    ?>
        <div class="container content col-md-6">
            <div class="product-item row">
                <div id="noProductMessage"></div>
                <?php
                foreach ($parsed_json as $key => $value) {
                    $rating = $value['rating'];
                ?>
                    <div id="frmCart" class="card col-sm-4 w-30 px-0">
                        <div class="p-3">
                            <div class="product-image thumbnail">
                                <img src="<?php echo $value['image']; ?>">
                            </div>
                            <h3 name="title"><?php echo $value['title']; ?></h3>
                            <p><?php echo $value['content']; ?></p>
                            <h4 name="rating" id="<?php echo $rating ?>" class="col-md-5 text-warning p-0">
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
                            <h4 class="product-price col-md-7" align=right>
                                Prijs: €<i name="price"><?php echo number_format($value["price"], 2); ?></i>
                            </h4>
                            <div>
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
                            </div>
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
                <i class="fas fa-shopping-cart px-5"></i> Winkelwagen
                <a id="btnEmpty" class="cart-action btn btn-primary mx-5" onClick="cartAction('empty','');">
                    <i class="fas fa-trash-alt"></i> Leeg winkelwagen
                </a>
            </h3>
            <div id="cart-item"></div>
        </div>

        <?php
        include __DIR__ . '/../footer.php';
        ?>

        <!-- FILTER SCRIPT -->
        <script>
            // Search-filter
            const searchInput = document.querySelector("input[name=searchBar]");
            searchInput.addEventListener("keyup", filterCards);

            // Price-filter
            var sliderPrice = document.getElementById("filterPrice");
            var outputPrice = document.getElementById("minPrice");
            outputPrice.innerHTML = sliderPrice.value;

            sliderPrice.oninput = function() {
                outputPrice.innerHTML = this.value;
                filterCards();
            };

            // Rating-filter
            var sliderRating = document.getElementById("filterRating");
            var outputRating = document.getElementById("minRating");
            outputRating.innerHTML = "<span class='far fa-star'></span><span class='far fa-star'></span><span class='far fa-star'></span><span class='far fa-star'></span><span class='far fa-star'></span>";

            sliderRating.oninput = function() {
                outputRating.innerHTML = "";
                var rating = this.value;
                for (var i = 0; i < 5; i++) {
                    if (rating >= 1) {
                        outputRating.innerHTML += "<span class='fas fa-star'></span>";
                    } else if (rating == 0.5) {
                        outputRating.innerHTML += "<span class='fas fa-star-half-alt'></span>";
                    } else {
                        outputRating.innerHTML += "<span class='far fa-star'></span>";
                    }
                    rating -= 1;
                }
                filterCards();
            };

            // Filter function
            function filterCards() {
                noProductMessage = document.getElementById("noProductMessage");
                const cards = document.querySelectorAll(".card");
                var visibleCount = 0;
                cards.forEach((item) => {
                    let whatToSearch = item.querySelector("h3[name=title]");
                    let cardPrice = parseInt(item.querySelector("i[name=price]").innerHTML);
                    let cardRating = parseFloat(item.querySelector("h4[name=rating]").id);
                    if (whatToSearch.innerHTML.toUpperCase().indexOf(searchInput.value.toUpperCase()) > -1 && cardPrice >= sliderPrice.value && cardRating >= sliderRating.value) {
                        item.style.display = "";
                        visibleCount++;
                    } else {
                        item.style.display = "none";
                    }
                });
                if (visibleCount <= 0) {
                    noProductMessage.style.display = "";
                    noProductMessage.innerHTML = "<h2 class='text-center my-5 text-secondary'>Geen producten gevonden</h2>";
                } else {
                    noProductMessage.style.display = "none";
                }
            }
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
                            queryString = 'action=' + action + '&code=' + product_code + '&quantity=1';
                            break;
                        case "remove":
                            queryString = 'action=' + action + '&code=' + product_code;
                            break;
                        case "empty":
                            queryString = 'action=' + action;
                            break;
                        case "minusQ":
                            queryString = 'action=' + action + '&code=' + product_code;
                            break;
                        case "addQ":
                            queryString = 'action=' + action + '&code=' + product_code;
                            break;
                        case "show":
                            queryString = 'action=' + action;
                            break;
                        case "order":
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
                    },
                    error: function() {}
                });
            }
        </script>