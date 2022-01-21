<?php
include __DIR__ . '/../../../dbconfig.php';

include __DIR__ . '/../header.php';
?>

<h1>Toevoegen product</h1>

<form class="mx-1 mx-md-4 w-50 mt-5" method="post" action="" enctype="multipart/form-data">

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Toevoegen product</p>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Afbeelding</label>
        <input type="file" accept="image/*" id="addProductForm" class="form-control" name="image" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Titel</label>
        <input type="text" id="addProductForm" class="form-control" maxlength="255" name="title" required />
    </div>

    <div class="d-flex flex-row mb-4">
        <label class="form-label me-4 w-25 mt-1" for="addProductForm">Beschrijving</label>
        <textarea id="addProductForm" class="form-control" rows="5" maxlength="2048" name="description" required></textarea>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Rating</label>
        <input type="number" id="addProductForm" class="form-control float-right" min=0 max=5 name="rating" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Prijs</label>
        <input type="number" id="addProductForm" class="form-control" min=0 name="price" required />
    </div>

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <button type="submit" class="btn btn-primary btn-lg" name="add_product">Voeg product toe</button>
    </div>
</form>
</div>

<?php
if (isset($_POST['add_product'])) {
    $title = ($_POST['title']);
    $description = ($_POST['description']);
    $rating = ($_POST['rating']);
    $price = ($_POST['price']);
    $image = "https://images.ctfassets.net/gtq5kcq8pjem/65pcZKuHDqSlS76Q90Qw2U/973124efa30fd55090c7d2d65355af78/1_2x.jpg?w=450&h=450";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products (title, content, rating, price, image) 
        VALUES('" . $title ."','". $description ."','". $rating ."','". $price ."','". $image ."')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;


    /*
    //foto naar mapje sturen
    $fnm = $_FILES["image"]["name"];
    $dst = "/home/" . $fnm;
    //move_uploaded_file($_FILES["image"]["tmp_name"], $dst);

    //foto uit mapje halen en decoden naar base64
    $imagedata = file_get_contents($dst);
    // alternatively specify an URL, if PHP settings allow
    $base64 = base64_encode($imagedata);*/

    //echo $title . " " . $description . " "  . $rating . " " . $price;
}
