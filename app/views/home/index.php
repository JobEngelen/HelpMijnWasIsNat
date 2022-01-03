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
    <div class="col-md-8">
        <div id="productListing" class="50"></div>

        <script>
            fetch('http://localhost/api/product')
                .then(function(response) {
                    return response.json();
                })
                .then(function(product) {
                    appendData(product);
                })
                .catch(function(err) {
                    console.log('error: ' + err);
                });

            function appendData(product) {
                var mainContainer = document.getElementById("productListing");

                var HTML = "";

                var numOfCols = 3;
                var rowCount = 0;

                var bootstrapColWidth = 12 / numOfCols;

                for (var i = 0; i < product.length; i++) {
                    var div = document.createElement("div");

                    if (rowCount % numOfCols == 0) {
                        HTML += "<div class='row'>";
                    }
                    rowCount++;
                    // Star rating
                    var rating = product[i].rating;
                    var starRating = "";
                    for (var r = 0; r < 5; r++) {
                        if (rating >= 1) {
                            starRating += "<span class='fas fa-star'></span>"
                        } else if (rating == 0.5) {
                            starRating += "<span class='fas fa-star-half-alt'></span>";
                        } else {
                            starRating += "<span class='far fa-star'></span>";
                        }
                        rating -= 1;
                    }

                    HTML += "<div class='col-md-" + bootstrapColWidth + " border pt-3 pb-3 ml-1 mr-1 mb-2'>" +
                        "<div class='thumbnail'>" +
                        "<img src='https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'>" +
                        "</div>" +
                        "<h3>" + product[i].title + "</h3>" +
                        "<p>" + product[i].content + "</p>";
                    HTML += "<h4 class='col-md-6 text-warning p-0'>" +
                        starRating +
                        "</h4>" +
                        "<h4 class='col-md-6'>Prijs: " + product[i].price + "</h4>" +
                        "<button type='button' class='btn btn-primary btn-block'>" +
                        "<i class='fas fa-plus'></i> Voeg toe aan winkelwagen" +
                        "</button>" +
                        "</div>";
                    if (rowCount % numOfCols == 0) {
                        HTML += "</div>";
                    }
                    div.innerHTML += HTML;
                }
                mainContainer.appendChild(div);

            }
        </script>
    </div>
    <div class="col-md-2">
        <p>WINKELMAND</p>
    </div>
    <?php

    include __DIR__ . '/../footer.php';
    ?>