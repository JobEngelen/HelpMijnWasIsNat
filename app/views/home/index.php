<?php
include __DIR__ . '/../header.php';
?>


<div class="row">
    <div class="col-md-12">
        <h1>HelpMijnWasIsNat.nl</h1>
    </div>
    <div class="col-md-2">
        <p>filters</p>
    </div>
    <div class="col-md-9">
        <?php

        //$row = placeholder
        $rows = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

        //Columns must be a factor of 12 (1,2,3,4,6,12)
        $numOfCols = 3;
        $rowCount = 0;

        $bootstrapColWidth = 12 / $numOfCols;
        foreach ($rows as $row) {
            $rating = 3.5;

            if ($rowCount % $numOfCols == 0) { ?> <div class="row">
                <?php
            }
            $rowCount++;
                ?>
                <div class="col-md-<?php echo $bootstrapColWidth; ?> border pt-3 pb-3 ml-1 mr-1 mb-2">
                    <div class="thumbnail">
                        <img src="https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450">
                    </div>
                    <h3>Wasdroger <?php echo "" . $row ?></h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at
                        tincidunt justo. Nam rutrum diam quis ante ornare, non dictum sem
                        tempus...
                    </p>
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
                    <h4 class="col-md-6">
                        Prijs: €200,-
                    </h4>
                    <button type="button" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Voeg toe aan winkelwagen
                    </button>
                </div>
                <?php
                if ($rowCount % $numOfCols == 0) { ?>
                </div> <?php }
                } ?>
    </div>
    <div class="col-md-1">
        <p>WINKELMAND</p>
    </div>
    <?php

    include __DIR__ . '/../footer.php';
    ?>