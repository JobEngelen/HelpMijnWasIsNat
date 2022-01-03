<?php
include __DIR__ . '/../header.php';

//$row = placeholder
$rows = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 3;
$rowCount = 0;

$bootstrapColWidth = 12 / $numOfCols;

foreach ($model as $product) {
    $rating = $product->rating;

    if ($rowCount % $numOfCols == 0) { ?> <div class="row">
        <?php
    }
    $rowCount++;
        ?>
        <div class="col-md-<?php echo $bootstrapColWidth; ?> border pt-3 pb-3">
            <div class="thumbnail">
                <img src='<?php echo $product->image ?>' class="w-100 h-100">
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <input type="text" value="<?php echo $product->title ?>" id="addProductForm" class="form-control" maxlength="255" name="title" required />
            <textarea id="addProductForm" class="form-control" rows="5" maxlength="2048" name="description" required><?php echo $product->content ?></textarea>
            <div class="row px-4 mt-2 mb-1 align-items-center">
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
                <div class="d-flex flex-row align-items-center mb-4 col-md-6 mt-3">
                    <label class="form-label me-4 w-25" for="addProductForm">Prijs: </label>
                    <input type="number" value="<?php echo $product->price ?>" id="addProductForm" class="form-control w-75" min=0 name="price" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 w-50 px-2">
                    <button type="button" class="btn btn-primary w-100">
                        <i class="fas fa-redo"></i> Revert changes
                    </button>
                </div>
                <div class="col-md-6 w-50 px-2">
                    <button type="button" class="btn btn-success w-100">
                        <i class="fas fa-save"></i> Save changes
                    </button>
                </div>


            </div>
        </div>
        <?php
        if ($rowCount % $numOfCols == 0) { ?>
        </div> <?php }
        } ?>
</div>