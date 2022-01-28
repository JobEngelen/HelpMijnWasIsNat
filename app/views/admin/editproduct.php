<?php
include __DIR__ . '/header.php';

// fetch json with php
$json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
$parsed_json = json_decode($json_string, true);

//$row = placeholder
$rows = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 3;
$rowCount = 0;

$bootstrapColWidth = 12 / $numOfCols;

//foreach ($model as $product) {
?>
<h1>Wijzig producten</h1>
<?php
if (!empty($parsed_json)) {
    foreach ($parsed_json as $key => $value) {
        $rating = $value["rating"];

        if ($rowCount % $numOfCols == 0) { ?> <div class="row">
            <?php
        }
        $rowCount++;
            ?>
            <div class="col-md-<?php echo $bootstrapColWidth; ?> border pt-3 pb-3 card" id="product<?php echo $value["id"]; ?>">
                <div class="thumbnail">
                    <button type="button" onclick='deleteProduct<?php echo $value["id"]; ?>()' class="btn btn-danger pull-right">
                        <i class="fas fa-times"></i>
                    </button>
                    <p class="text-danger" id="unsavedMsg<?php echo $value["id"]; ?>"></p>
                    <img src='<?php echo $value["image"] ?>' class="w-100 h-100">
                </div>
                <input type="text" name="title<?php echo $value["id"]; ?>" value="<?php echo $value["title"]; ?>" class="form-control" maxlength="255" name="title" required />
                <textarea name="desc<?php echo $value["id"]; ?>" class="form-control" rows="5" maxlength="2048" required><?php echo $value["content"]; ?></textarea>
                <div class="row px-4 mt-2 mb-1 align-items-center">
                    <div class="d-flex flex-row align-items-center mb-4 col-md-6 mt-3">
                        <label class="form-label w-100" for="addProductForm">Rating (1-5): </label>
                        <input type="number" name="rating<?php echo $value["id"]; ?>" step="0.5" value="<?php echo $value["rating"]; ?>" id="addProductForm" class="form-control w-50 p-0" min=0 max=5 name="rating" required />
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4 col-md-6 mt-3">
                        <label class="form-label me-4 w-25" for="addProductForm">Prijs: </label>
                        <input type="number" name="price<?php echo $value["id"]; ?>" step="0.01" value="<?php echo number_format($value["price"], 2); ?>" id="addProductForm" class="form-control w-75" min=0 name="price" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 w-50 px-2">
                        <button type="button" onclick="revertChanges<?php echo $value['id']; ?>()" class="btn btn-primary w-100" name="btnR<?php echo $value["id"]; ?>" disabled>
                            <i class="fas fa-redo"></i> Revert changes
                        </button>
                    </div>
                    <div class="col-md-6 w-50 px-2">
                        <button type="button" onclick="updateProduct<?php echo $value['id']; ?>('update')" class="btn btn-success w-100" name="btnS<?php echo $value["id"]; ?>" disabled>
                            <i class="fas fa-save"></i> Save changes
                        </button>
                    </div>
                </div>
                <div id="updateProduct"></div>
            </div>
            <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script>
                const btnRevert<?php echo $value["id"]; ?> = document.querySelector('button[name=btnR<?php echo $value["id"]; ?>]');
                const btnSave<?php echo $value["id"]; ?> = document.querySelector('button[name=btnS<?php echo $value["id"]; ?>]');
                const unsavedMsg<?php echo $value["id"]; ?> = document.getElementById("unsavedMsg<?php echo $value["id"]; ?>");

                const changeTitle<?php echo $value["id"]; ?> = document.querySelector("input[name=title<?php echo $value["id"]; ?>]");
                changeTitle<?php echo $value["id"]; ?>.addEventListener("keyup", enableButtons);
                const changeDesc<?php echo $value["id"]; ?> = document.querySelector("textarea[name=desc<?php echo $value["id"]; ?>]");
                changeDesc<?php echo $value["id"]; ?>.addEventListener("keyup", enableButtons);
                const changeRating<?php echo $value["id"]; ?> = document.querySelector("input[name=rating<?php echo $value["id"]; ?>]");
                changeRating<?php echo $value["id"]; ?>.addEventListener("keyup", enableButtons);
                changeRating<?php echo $value["id"]; ?>.addEventListener("change", enableButtons);
                const changePrice<?php echo $value["id"]; ?> = document.querySelector("input[name=price<?php echo $value["id"]; ?>]");
                changePrice<?php echo $value["id"]; ?>.addEventListener("keyup", enableButtons);
                changePrice<?php echo $value["id"]; ?>.addEventListener("change", enableButtons);

                // delete product script
                function deleteProduct<?php echo $value["id"]; ?>() {

                    if (confirm("Weet u zeker dat u product: '<?php echo $value["title"]; ?>' wilt verwijderen?")) {
                        document.getElementById('product<?php echo $value["id"]; ?>').style.display = "none";
                        updateProduct<?php echo $value["id"]; ?>('delete');
                    }
                }

                // update product script
                function updateProduct<?php echo $value["id"]; ?>(action) {
                    var queryString = "";
                    if (action != "") {
                        switch (action) {
                            case "delete":
                                queryString = 'action=' + action + '&id=<?php echo $value["id"]; ?>';
                                break;
                            case "update":
                                queryString = 'action=' + action + '&id=<?php echo $value["id"]; ?>&title=' + changeTitle<?php echo $value["id"]; ?>.value + '&content=' + changeDesc<?php echo $value["id"]; ?>.value + '&rating=' + changeRating<?php echo $value["id"]; ?>.value + '&price=' + changePrice<?php echo $value["id"]; ?>.value;
                                break;
                        }
                    }
                    jQuery.ajax({
                        url: "/admin/updateProduct",
                        data: queryString,
                        type: "POST",
                        success: function(data) {
                            $("#updateProduct").html(data);
                        },
                        error: function() {}
                    });

                    btnRevert<?php echo $value["id"]; ?>.disabled = true;
                    btnSave<?php echo $value["id"]; ?>.disabled = true;
                    unsavedMsg<?php echo $value["id"]; ?>.innerHTML = "";
                }

                // alert/revert changes
                function enableButtons() {
                    if (changeTitle<?php echo $value["id"]; ?>.value != "<?php echo $value["title"]; ?>" ||
                        changeDesc<?php echo $value["id"]; ?>.value != "<?php echo $value["content"]; ?>" ||
                        changeRating<?php echo $value["id"]; ?>.value != "<?php echo $value["rating"]; ?>" ||
                        changePrice<?php echo $value["id"]; ?>.value != "<?php echo $value["price"]; ?>") {
                        btnRevert<?php echo $value["id"]; ?>.disabled = false;
                        btnSave<?php echo $value["id"]; ?>.disabled = false;
                        unsavedMsg<?php echo $value["id"]; ?>.innerHTML = "Niet-opgeslagen wijzigingen gemaakt";
                    } else {
                        btnRevert<?php echo $value["id"]; ?>.disabled = true;
                        btnSave<?php echo $value["id"]; ?>.disabled = true;
                        unsavedMsg<?php echo $value["id"]; ?>.innerHTML = "";
                    }
                }

                function revertChanges<?php echo $value["id"]; ?>() {
                    changeTitle<?php echo $value["id"]; ?>.value = "<?php echo $value["title"]; ?>";
                    changeDesc<?php echo $value["id"]; ?>.value = "<?php echo $value["content"]; ?>";
                    changeRating<?php echo $value["id"]; ?>.value = "<?php echo $value["rating"]; ?>";
                    changePrice<?php echo $value["id"]; ?>.value = "<?php echo $value["price"]; ?>";

                    btnRevert<?php echo $value["id"]; ?>.disabled = true;
                    btnSave<?php echo $value["id"]; ?>.disabled = true;
                    unsavedMsg<?php echo $value["id"]; ?>.innerHTML = "";
                }
            </script>
            <?php
            if ($rowCount % $numOfCols == 0) { ?>
            </div> <?php }
            }
        } ?>
</div>