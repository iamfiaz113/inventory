<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Product</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Product</h4>
                </div>
                <?php
                session_start();
                if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
                    echo '<div class="alert alert-danger">';
                    echo '<h4 class="alert-heading">Oops! There are some errors:</h4>';
                    echo '<ol>';
                    foreach ($_SESSION['form_errors'] as $error) {
                        echo '<li>' . $error . '</li>';
                    }
                    echo '</ol>';
                    echo '</div>';
                    unset($_SESSION['form_errors']);
                }
                ?>
                <div class="card-body">
                    <img id="selectedImage" src="<?php echo $_SESSION['show']['image']; ?>" class="img-fluid rounded mb-1" alt="Selected Image" style="max-height: 200px">

                    <form id="jquery-val-form" action="update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['show']['id']; ?>">
                        <!-- Product Type -->
                        <label class="form-label">Type</label>
                        <div class="form-group d-flex">
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="validationRadio3" name="type" value="goods" class="custom-control-input" <?php echo ($_SESSION['show']['type'] == 'goods') ? 'checked' : ''; ?> />
                                <label class="custom-control-label" for="validationRadio3">Goods</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="validationRadio4" name="type" value="service" class="custom-control-input" <?php echo ($_SESSION['show']['type'] == 'service') ? 'checked' : ''; ?> />
                                <label class="custom-control-label" for="validationRadio4">Service</label>
                            </div>
                        </div>
                        
                        <!-- General Information -->
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Product Name" value="<?php echo $_SESSION['show']['name']; ?>" />
                        </div>

                        <!-- Purchase Price -->
                        <div class="form-group">
                            <label class="form-label" for="purchase_price">Purchase Price</label>
                            <input type="text" id="purchase_price" name="purchase_price" class="form-control" placeholder="Purchase Price" value="<?php echo $_SESSION['show']['purchase_price']; ?>" />
                        </div>

                        <!-- Sale Price -->
                        <div class="form-group">
                            <label class="form-label" for="sale_price">Sale Price</label>
                            <input type="text" id="sale_price" name="sale_price" class="form-control" placeholder="Sale Price" value="<?php echo $_SESSION['show']['sale_price']; ?>" />
                        </div>

                        <!-- SKU -->
                        <div class="form-group">
                            <label class="form-label" for="sku">SKU</label>
                            <input type="text" id="sku" name="sku" class="form-control" placeholder="Product SKU" value="<?php echo $_SESSION['show']['sku']; ?>" />
                        </div>

                        <!-- Manufacturer -->
                        <div class="form-group">
                            <label class="form-label" for="manufacturer">Manufacturer</label>
                            <input type="text" id="manufacturer" name="manufacturer" class="form-control" placeholder="Manufacturer" value="<?php echo $_SESSION['show']['manufacturer']; ?>" />
                        </div>

                        <!-- UPC -->
                        <div class="form-group">
                            <label class="form-label" for="upc">UPC</label>
                            <input type="text" id="upc" name="upc" class="form-control" placeholder="UPC" value="<?php echo $_SESSION['show']['upc']; ?>" />
                        </div>

                        <!-- EAN -->
                        <div class="form-group">
                            <label class="form-label" for="ean">EAN</label>
                            <input type="text" id="ean" name="ean" class="form-control" placeholder="EAN" value="<?php echo $_SESSION['show']['ean']; ?>" />
                        </div>

                        <!-- Weight -->
                        <div class="form-group">
                            <label class="form-label" for="weight">Weight</label>
                            <input type="text" id="weight" name="weight" class="form-control" placeholder="Product Weight" value="<?php echo $_SESSION['show']['weight']; ?>" />
                        </div>

                        <!-- Brand -->
                        <div class="form-group">
                            <label class="form-label" for="brand">Brand</label>
                            <input type="text" id="brand" name="brand" class="form-control" placeholder="Product Brand" value="<?php echo $_SESSION['show']['brand']; ?>" />
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label class="form-label" for="qty">Quantity</label>
                            <input type="text" id="qty" name="qty" class="form-control" placeholder="Quantity" value="<?php echo $_SESSION['show']['qty']; ?>" />
                        </div>

                        <!-- ISBN -->
                        <div class="form-group">
                            <label class="form-label" for="isbn">ISBN</label>
                            <input type="text" id="isbn" name="isbn" class="form-control" placeholder="ISBN" value="<?php echo $_SESSION['show']['isbn']; ?>" />
                        </div>

                        <!-- Unit -->
                        <div class="form-group">
                            <label class="form-label" for="unit">Unit</label>
                            <input type="text" id="unit" name="unit" class="form-control" placeholder="Product Unit" value="<?php echo $_SESSION['show']['unit']; ?>" />
                        </div>

                        <!-- Returnable Item -->
                        <div class="form-group">
                            <label class="form-label" for="returnable">Returnable Item</label>
                            <select id="returnable" name="returnable" class="form-control">
                                <option value="yes" <?php echo ($_SESSION['show']['returnable'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                                <option value="no" <?php echo ($_SESSION['show']['returnable'] == 'no') ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <!-- Dimensions -->
                        <div class="form-group">
                            <label class="form-label">Dimensions (Length X Width X Height)</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="length" placeholder="Length" value="<?php echo $_SESSION['show']['length']; ?>" />
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="width" placeholder="Width" value="<?php echo $_SESSION['show']['width']; ?>" />
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="height" placeholder="Height" value="<?php echo $_SESSION['show']['height']; ?>" />
                                </div>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group">
                            <label for="customFile1">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="customFile1" accept="image/*" multiple onchange="displayImage(this)" />
                                <label class="custom-file-label" for="customFile1">Choose product pic</label>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please choose product pictures.</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="d-block" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $_SESSION['show']['description']; ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script>
    function displayImage(input) {
        const selectedImage = document.getElementById('selectedImage');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                selectedImage.src = e.target.result;
                selectedImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            selectedImage.src="<?php echo $_SESSION['show']['image']; ?>";
        }
    }
</script>

</body>
</html>
