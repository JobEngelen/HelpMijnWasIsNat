<?php
include __DIR__ . '/header.php';
?>

<h1>Bestellingen</h1>
<h4 class="text-danger" id="warningText"></h4>
<table cellpadding="10" cellspacing="1">
    <tbody>
        <tr>
            <th class="col-md-1">
                <h4><strong>OrderNr</strong></h4>
            </th>
            <th class="col-md-2">
                <h4><strong>Gebruiker</strong></h4>
            </th>
            <th class="col-md-2">
                <h4><strong>Datum aankoop</strong></h4>
            </th>
            <th class="col-md-1">
                <h4 align=right><strong>Totaal</strong></h4>
            </th>
            <th class="col-md-1">
                <h4 align=center><strong>Status</strong></h4>
            </th>
            <th class="col-md-1">
            </th>
        </tr>
    </tbody>
</table>
<?php
foreach ($model as $order) {
?>
    <table cellpadding="10" cellspacing="1" class="w-100">
        <tbody>
            <tr class="bg-light border">
                <th class="col-md-1">
                    <h4><?php echo $order->getId() ?></h4>
                </th>
                <th class="col-md-4">
                    <h4><?php echo $order->getUsername() ?></h4>
                </th>
                <th class="col-md-3">
                    <h4><?php echo $order->getOrderDate() ?></h4>
                </th>
                <th class="col-md-2">
                    <h4 align=right class="pe-5">€<?php echo number_format($order->getTotalPrice(), 2) ?></h4>
                </th>
                <th class="col-md-2 container">
                    <div class="row">
                        <select class="col-9" name="status" id="statusSelect<?php echo $order->getId() ?>" onchange="inputChange<?php echo $order->getId() ?>('edit','')">
                            <option value="1">Nieuw</option>
                            <option value="2" <?php if ($order->getStatus() == 2) { ?> selected="selected" <?php } ?>>Bezorgd</option>
                        </select>
                        <h4 class="text-danger col" id="lblUnsaved<?php echo $order->getId() ?>">
                        </h4>
                    </div>
                </th>
                <th class="col-md-2">
                    <button id="btnDown<?php echo $order->getId() ?>" onclick="dropDownOrderContent<?php echo $order->getId() ?>()">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <button id="btnUp<?php echo $order->getId() ?>" style="display:none" onclick="dropDownOrderContent<?php echo $order->getId() ?>()">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </th>
            </tr>
        </tbody>
    </table>
    <table style="display:none" id="dropdown<?php echo $order->getId() ?>">
        <tbody>
            <tr class="border">
                <th class="col-md-1">
                    <h4><strong>Afbeelding</strong></h4>
                </th>
                <th class="col-md-3">
                    <h4><strong>Product</strong></h4>
                </th>
                <th class="col-md-1">
                    <h4 align=center><strong>Aantal</strong></h4>
                </th>
                <th class="col-md-4">
                    <h4 align=right class="pe-4"><strong>Prijs</strong></h4>
                </th>
                <th class="col-md-3">
                </th>
            </tr>
            <?php
            foreach ($order->getOrderContent() as $content) {
            ?>
                <tr class="border" id="dropdown<?php echo $order->getId() ?>">
                    <td>
                        <div class="thumbnail m-0">
                            <img src="<?php echo $content->getImage(); ?>">
                        </div>
                    </td>
                    <td>
                        <h4 class="px-4"><?php echo $content->getTitle(); ?></h4>
                    </td>
                    <td>
                        <h4 align=center><?php echo $content->getQuantity() ?></h4>
                    </td>
                    <td align=right>
                        <h4 class="pe-3">€<?php echo number_format($content->getPrice() * $content->getQuantity(), 2) ?></h4>
                    </td>
                    <td></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div id="changeOrderStatus"></div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        function dropDownOrderContent<?php echo $order->getId() ?>() {
            var x = document.getElementById("dropdown<?php echo $order->getId() ?>");
            var btnDown = document.getElementById("btnDown<?php echo $order->getId() ?>");
            var btnUp = document.getElementById("btnUp<?php echo $order->getId() ?>");
            if (x.style.display === "none") {
                x.style.display = "block";
                btnDown.style.display = "none";
                btnUp.style.display = "block";
            } else {
                x.style.display = "none";
                btnDown.style.display = "block";
                btnUp.style.display = "none";
            }
        }

        function inputChange<?php echo $order->getId() ?>(action, product_code) {
            var status = document.getElementById("statusSelect<?php echo $order->getId() ?>").value;
            var queryString = "";
            if (action != "") {
                switch (action) {
                    case "edit":
                        queryString = 'action=' + action + '&id=' + <?php echo $order->getId() ?> + '&status=' + status;
                        break;
                }
            }
            jQuery.ajax({
                url: "/admin/editOrder",
                data: queryString,
                type: "POST",
                success: function(data) {
                    $("#changeOrderStatus").html(data);
                },
                error: function() {}
            });
        }
    </script>
<?php
}
?>
</tbody>
</table>

</div>