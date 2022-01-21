<?php
//include __DIR__ . '/../../../dbconfig.php';

include __DIR__ . '/../header.php';
?>

<h1>Bestellingen</h1>
<table cellpadding="10" cellspacing="1">
            <tbody>

                    <tr>
                        <th class="col-md-1">
                            <h4>OrderNr</h4>
                        </th>
                        <th class="col-md-1">
                            <h4>Gebruiker</h4>
                        </th>
                        <th class="col-md-4">
                            <h4>Totaal</h4>
                        </th>
                        <th class="col-md-1">
                            <h4>Datum</h4>
                        </th>
                        <th class="col-md-1">
                            <h4>Status</h4>
                        </th>
                    </tr>
                    <?php
                    /*foreach () {
                    ?>
                        <tr>
                            <td>
                                <h4><?php echo $item["name"]; ?></h4>
                            </td>
                            <td class="container">
                                <div class="row">
                                    <div class="col">
                                        <a onClick="cartAction('minusQ','<?php echo $item["code"]; ?>')" class="btnMinusQAction cart-action btn btn-secondary">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <h4><?php echo $item["quantity"]; ?></h4>
                                    </div>
                                    <div class="col">
                                        <a onClick="cartAction('addQ','<?php echo $item["code"]; ?>')" class="btnAddQAction cart-action btn btn-secondary">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td align=right>
                                <h4><?php echo "€" . $item["price"] * $item["quantity"]; ?></h4>
                            </td>
                            <td>
                                <a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action btn btn-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td align=right>
                            <h4><strong>Totaal:</strong></h4>
                        </td>
                        <td align=right>
                            <h4><?php echo "€" . $item_total; ?></h4>
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align=right>
                            <a onClick="cartAction('order','')" class="btn btn-success w-100">
                                <h4>Bestelling afronden</h4>
                            </a>
                        </td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <th scope="col">
                            <h3 class="text-muted text-center">Winkelwagen is leeg</h3>
                        </th>
                    </tr>
                <?php
                }*/
                ?>
            </tbody>
        </table>

</div>


