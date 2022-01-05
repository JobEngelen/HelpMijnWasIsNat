<?php
include __DIR__ . '/../header.php';

// fetch json with php (werkt niet)
$json_string = file_get_contents("/api/product");
$parsed_json = json_decode($json_string, true);

foreach ($parsed_json as $key => $value) {
   echo $value['title'] . '<br>';
   echo $value['content'] . '<br>';
   // etc
}

?>

<span class="input-group-btn">
   <!-- placeholder searchbar -->
   <div class="row justify-content-center">
      <div class="card-body align-items-center">
         <div class="input-group">
            <input id="search" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Zoek wasdrogers...">
            <button type="button" class="btn btn-secondary">
               <span class="glyphicon glyphicon-search"></span> Zoek
            </button>
         </div>
      </div>
   </div>
</span>

<table>
   <!-- deze html table wordt vervangen met html code door javascript -->
   <tbody>
      <div id="productListing" class="50"></div>
   </tbody>
</table>

<script>
   /* fetch json met javascript (werkt)
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
         HTML += "<tr><p class='hidden'>" + product[i].title + "</p><td>" +
            "<td>" +
            "<div class='col-md-" + bootstrapColWidth + " border pt-3 pb-3 ml-1 mr-1 mb-2'>" +
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
            "</div>" +
            "</td></tr>";
         if (rowCount % numOfCols == 0) {
            HTML += "</div>";
         }
         div.innerHTML += HTML; // Genereer html met data uit json api
      }
      mainContainer.appendChild(div);
   }
</script>

<table>
   <!-- php geprogrammeerde html, om te testen of filter hier wel mee werkt (werkt) -->
   <tbody>
      <?php
      for ($i = 0; $i < 9; $i++) {
      ?>
         <tr>
            <td class="hidden">titel<?php echo $i ?></td> <!-- is alleen filterbaar als hier een <td> staat met text -->
            <td>
               <div class='col-md-" + bootstrapColWidth + " border pt-3 pb-3 ml-1 mr-1 mb-2'>
                  <div class='thumbnail'>
                     <img src='https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'>
                  </div>
                  <h3> titel<?php echo $i ?> </h3>
                  <p>content</p>
                  <h4 class='col-md-6 text-warning p-0'>
                     sterretjes
                  </h4>
                  <h4 class='col-md-6'>Prijs: 200</h4>
                  <button type='button' class='btn btn-primary btn-block'>
                     <i class='fas fa-plus'></i> Voeg toe aan winkelwagen
                  </button>
               </div>
            </td>
         </tr>
      <?php
      } ?>
   </tbody>
</table>-->

<div id="jsonjavafiltertest"></div>

<script>
   // deze comments was om te testen of filter met javascript-gegenereerde-html werkte (werkt niet)
   //var oneline = "<table>    <tbody>        <tr>            <td class='hidden'>titel1</td>            <td>                <div class='col-md-4 border pt-3 pb-3 ml-1 mr-1 mb-2'>                    <div class='thumbnail'>                        <img src='https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'>                    </div>                    <h3> titel1 </h3>                    <p>content</p>                    <h4 class='col-md-6 text-warning p-0'>                        sterretjes                    </h4>                    <h4 class='col-md-6'>Prijs: 200</h4>                    <button type='button' class='btn btn-primary btn-block'>                        <i class='fas fa-plus'></i> Voeg toe aan winkelwagen                    </button>                </div>            </td>        </tr>        <tr>            <td class='hidden'>titel2</td>            <td>                <div class='col-md-4 border pt-3 pb-3 ml-1 mr-1 mb-2'>                    <div class='thumbnail'>                        <img src='https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'>                    </div>                    <h3> titel2 </h3>                    <p>content</p>                    <h4 class='col-md-6 text-warning p-0'>                        sterretjes                    </h4>                    <h4 class='col-md-6'>Prijs: 200</h4>                    <button type='button' class='btn btn-primary btn-block'>                        <i class='fas fa-plus'></i> Voeg toe aan winkelwagen                    </button>                </div>            </td>        </tr>        <tr>            <td class='hidden'>titel3</td>            <td>                <div class='col-md-4 border pt-3 pb-3 ml-1 mr-1 mb-2'>                    <div class='thumbnail'>                        <img src='https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450'>                    </div>                    <h3> titel3 </h3>                    <p>content</p>                    <h4 class='col-md-6 text-warning p-0'>                        sterretjes                    </h4>                    <h4 class='col-md-6'>Prijs: 200</h4>                    <button type='button' class='btn btn-primary btn-block'>                        <i class='fas fa-plus'></i> Voeg toe aan winkelwagen                    </button>                </div>            </td>        </tr>    </tbody></table>";
   //var testContainer = document.getElementById("jsonjavafiltertest");
   //testContainer.innerHTML += oneline;
   //div.appendChild(testContainer);

   // zoekfilter (werkt alleen met handgeprogrammeerde/php-gegenereerde html)
   const searchInput = document.getElementById("search");
   const rows = document.querySelectorAll("tbody tr");
   console.log(rows);
   searchInput.addEventListener("keyup", function(event) {
      const q = event.target.value.toLowerCase();
      rows.forEach((row) => {
         row.querySelector("td").textContent.toLowerCase().startsWith(q) ?
            (row.style.display = "table-row") :
            (row.style.display = "none");
      });
   });
</script>


<?php

include __DIR__ . '/../footer.php';
?>