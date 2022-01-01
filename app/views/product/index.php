<?php
include __DIR__ . '/../header.php';

echo "<h1>Products!</h1>";

foreach ($model as $product) {
    echo "<h2>$product->id</h2>";
    echo "<div class='thumbnail'>";
    echo "<img src='$product->image'>";
    echo "</div>";
    echo "<h2>$product->title</h2>";
    echo "<p>$product->content</p>";
    echo "<h2>$product->rating</h2>";
    echo "<h2>$product->price";
}

include __DIR__ . '/../footer.php';
