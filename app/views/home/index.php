<?php
include __DIR__ . '/../header.php';

// fetch json with php
$json_string = file_get_contents("https://helpmijnwasisnat.herokuapp.com/api/product");
$parsed_json = json_decode($json_string, true);
?>


<div class="row">
    <div class="col-md-12 text-center pb-5">
        <h1>HelpMijnWasIsNat.nl</h1>
    </div>
    <div class="w-25 text-center">
        <p>filters</p>
    </div>
    <div class="container content  w-50">
        <div class="row">
            <?php
            foreach ($parsed_json as $key => $value) {
                $rating = $value['rating'];
            ?>
                <div class="card col-sm-4 w-30">
                    <p class="hidden"><?php echo $value['title']; ?></p> <!-- filter -->
                    <div class="p-3">
                        <div class='thumbnail'>
                            <img src='<?php echo $value['image']; ?>'>
                        </div>
                        <h3> <?php echo $value['title']; ?> </h3>
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
                        <h4 class="col-md-6">
                            Prijs: €<?php echo $value['price'] ?>
                        </h4>
                        <button type='button' class='btn btn-primary btn-block'>
                            <i class='fas fa-plus'></i> Voeg toe aan winkelwagen
                        </button>
                    </div>
                </div>
            <?php
            } ?>

        </div>

    </div>
    <div class="w-25 text-center">
        <p>WINKELMAND</p>
    </div>
</div>
<?php

include __DIR__ . '/../footer.php';
?>


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