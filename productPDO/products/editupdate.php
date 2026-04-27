<?php
require_once(__DIR__ . '/../config/Database.php');
$dbObj = new Database();
$conn = $dbObj->getConnection();

// check for id in the url
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
// fetch the item from DB based on Id 
$sql = "SELECT * FROM products WHERE id= :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$fetchResult = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="css/create.css">

</head>

<body>

    <!-- Page Header -->
    <div class="page-header">
        <a href="index.php" class="back-btn" title="Back to products">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1>Edit <span>Product</span></h1>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="create.php" method="POST" enctype="multipart/form-data" id="productForm" novalidate>

            <!-- ── Section 1: Basic Info ── -->
            <div class="form-section">
                <div class="section-label"><i class="bi bi-box"></i> Basic Info</div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label" for="name">Product Name <span class="req">*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="e.g. Classic Cotton T-Shirt"
                            required
                            maxlength="50"
                            value="<?php if (!empty($fetchResult)) {
                                        echo $fetchResult['name'];
                                    } ?>">
                        <div class="invalid-feedback">Product name is required.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="category">Category <span class="req">*</span></label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="" disabled selected>Select...</option>
                            <option value="Tops" <?php echo ($fetchResult['category'] === 'Tops') ? 'selected' : ''; ?>>Tops</option>
                            <option value="Bottoms" <?php echo ($fetchResult['category'] === 'Bottoms') ? 'selected' : ''; ?>>Bottoms</option>
                            <option value="Footwear" <?php echo ($fetchResult['category'] === 'Footwear') ? 'selected' : ''; ?>>Footwear</option>
                            <option value="Accessories" <?php echo ($fetchResult['category'] === 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
                            <option value="Outerwear" <?php echo ($fetchResult['category'] === 'Outerwear') ? 'selected' : ''; ?>>Outerwear</option>
                        </select>
                        <div class="invalid-feedback">Please select a category.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            placeholder="Brief product description..."
                            maxlength="1000"><?php if (!empty($fetchResult)) {
                                                    echo $fetchResult['description'];
                                                } ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ── Section 2: Pricing & Stock ── -->
            <div class="form-section">
                <div class="section-label"><i class="bi bi-tag"></i> Pricing & Stock</div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="price">Price <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                class="form-control"
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                value="<?php if (!empty($fetchResult)) {
                                            echo $fetchResult['price'];
                                        } ?>"
                                required>
                        </div>
                        <div class="invalid-feedback">Enter a valid price.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="stock">Stock Quantity <span class="req">*</span></label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            class="form-control"
                            placeholder="0"
                            min="0"
                            value="<?php if (!empty($fetchResult)) {
                                        echo $fetchResult['stock'];
                                    } ?>"
                            required>
                        <div class="invalid-feedback">Enter a valid stock quantity.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="sku">SKU <small class="text-muted">(optional)</small></label>
                        <input
                            type="text"
                            id="sku"
                            name="sku"
                            class="form-control"
                            placeholder="e.g. TSHIRT-RED-L"
                            maxlength="100"
                            value="<?php if (!empty($fetchResult)) {
                                        echo $fetchResult['sku'];
                                    } ?>">
                    </div>
                </div>
            </div>

            <!-- ── Section 3: Variants ── -->
            <div class="form-section">
                <div class="section-label"><i class="bi bi-palette"></i> Variants</div>

                <div class="row g-4">
                    <!-- Size -->
                    <div class="col-12">
                        <label class="form-label d-block">Size</label>
                        <div class="size-pills">
                            <?php
                            $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                            foreach ($sizes as $s): ?>
                                <div class="size-pill">
                                    <input type="radio" name="size" id="size_<?php echo $s; ?>" value="<?php echo $s; ?>" <?php if ($fetchResult['size'] === $s) {
                                                echo 'checked';
                                            } else {
                                                echo '';
                                            } ?>>
                                    <label for="size_<?php echo $s; ?>"><?php echo $s; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="col-12">
                        <label class="form-label d-block">Color</label>
                        <div class="color-swatches">
                            <?php
                            $colors = [
                                'Red'    => '#ef4444',
                                'Blue'   => '#3b82f6',
                                'Green'  => '#22c55e',
                                'Black'  => '#1f2937',
                                'White'  => '#f3f4f6',
                                'Yellow' => '#eab308',
                                'Purple' => '#a855f7',
                                'Orange' => '#f97316',
                            ];
                            foreach ($colors as $name => $hex): ?>
                                <div class="color-swatch" title="<?php echo $name ?>">
                                    <input type="radio" name="color" id="color_<?php echo $name ?>" value="<?php echo $name ?>" <?php if ($fetchResult['color'] === $name) {
                                                                                                                                    echo 'checked';
                                                                                                                                } else {
                                                                                                                                    echo '';
                                                                                                                                } ?>>
                                    <label for="color_<?php echo $name ?>" style="background:<?php echo $hex ?>"></label>
                                </div>
                            <?php endforeach; ?>

                            <!-- Selected color text display -->
                            <span id="selectedColor" style="font-size:0.8rem;color:var(--muted);margin-left:0.5rem;">
                                <?php echo (!empty($fetchResult['color'])) ? htmlspecialchars($fetchResult['color']) : ''; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Section 4: Image ── -->
            <div class="form-section">
                <div class="section-label"><i class="bi bi-image"></i> Product Image <small style="font-weight:400;text-transform:none;letter-spacing:0">(optional)</small></div>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/webp">
                    <i class="bi bi-cloud-arrow-up upload-icon"></i>
                    <p>Drop image here or <span>browse</span></p>
                    <p style="margin-top:0.25rem;font-size:0.75rem;">JPG, PNG, WEBP · Max 3MB</p>
                </div>
                <?php $currentImage = !empty($fetchResult['image']) ? $fetchResult['image'] : '' ;?>
                <img id="imagePreview" src="../uploads/<?php echo htmlspecialchars($currentImage); ?>" alt="Preview">
            </div>

            <!-- ── Footer ── -->
            <div class="form-footer">
                <a href="index.php" class="btn-cancel">
                    <i class="bi bi-x"></i> Cancel
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-plus-circle"></i> Update Product
                </button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── Image preview ──
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadZone = document.getElementById('uploadZone');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        // drag-over highlight
        uploadZone.addEventListener('dragover', () => uploadZone.classList.add('dragover'));
        uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('dragover'));
        uploadZone.addEventListener('drop', () => uploadZone.classList.remove('dragover'));

        // ── Show selected color name ──
        document.querySelectorAll('input[name="color"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('selectedColor').textContent = this.value;
            });
        });

        // ── Client-side validation ──
        document.getElementById('productForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    </script>
</body>

</html>