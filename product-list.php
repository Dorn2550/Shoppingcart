<?php
session_start();
include 'config2.php';

//product all
$query = mysqli_query($conn, "SELECT * FROM products");
$rows = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="shortcut icon" type="icon" href="the planet of apes.jpg">
    <link rel="stylesheet" href="shoppingcart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>body 
        {
            overflow-x: hidden;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            width: auto;
        }
        .container5 {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}
body {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
}
img {
  max-width: 100%;
  height: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}

td, th {
  padding: 10px;
  text-align: left;
}
        </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container5" style="margin-top: 30px;">
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>

        <?php endif; ?>

        <h4 class="text-center mb-4">Product List</h4>
        <div class="row d-flex justify-content-center">
            <?php if($rows > 0): ?>
            <?php while($product = mysqli_fetch_assoc($query)): ?>
            <div class="col-3 mb-3 ml-5">
                <div class="card" style="width: 18rem;">
                    <?php if(!empty($product['profile_image'])): ?>
                    <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top" width="100" alt="Product Image">
                    <?php else: ?>
                    <img src="<?php echo $base_url; ?>/assets/images/no-image.png" class="card-img-top" width="100" alt="Product Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                        <p class="card-text text-success fw-bold mb-0"><?php echo number_format($product['price'], 2); ?>฿</p>
                        <p class="card-text text-muted"><?php echo nl2br($product['detail']); ?></p>
                        <a href="<?php echo $base_url; ?>/cart-add.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100"><i class="fa-solid fa-cart-plus me-1"></i>Add Cart</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <h4 class="text-danger">ไม่มีรายการสินค้า</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>