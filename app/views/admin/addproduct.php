<?php
include __DIR__ . '/header.php';
?>

<h1>Toevoegen product</h1>

<form class="mx-1 mx-md-4 w-50 mt-5" method="post" action="/admin/_addProduct" enctype="multipart/form-data">
    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Afbeelding</label>
        <!-- input is disabled want je kan geen images op heroku uploaden (werkt localhost) -->
        <input type="file" accept="image/*" id="addProductForm" class="form-control" name="image[]" required disabled/>
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
        <input type="number" id="addProductForm" step="0.5" class="form-control float-right" min=0 max=5 name="rating" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="addProductForm">Prijs</label>
        <input type="number" id="addProductForm" step="0.01" class="form-control" min=0 name="price" required />
    </div>

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <button type="submit" class="btn btn-primary btn-lg" name="add_product">Voeg product toe</button>
    </div>
</form>
</div>