 <?php 
 session_start();
 include 'config2.php';

 $productIds = [];
 foreach(($_SESSION['cart'] ?? []) as $cartId => $cartValue) {
    $productIds[] = $cartId;
 }

 $ids = 0;
 if(count($productIds) > 0) {
    $ids = implode(',', $productIds);
 }

 //products all
 $query = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");
 $rows = mysqli_num_rows($query);

 ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" type="icon" href="the planet of apes.jpg">

    <title>Checkout</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">
    <?php include 'menu.php' ?>
<div class="container" style="margin-top: 30px;">
    <?php if(!empty($_SESSION['message'])) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <h4 class="mb-3">Checkout</h4>
    <form action="<?php echo $base_url; ?>/checkout-form.php" method="post">
        <div class="row g-5">
            <div class="col-md-6 col-lg-7">
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label class="form-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" placeholder="" value="">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label">Tel.</label>
                        <input type="text" name="tel" class="form-control" placeholder="" value="">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class=form-control placeholder="" value="">
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-end">
                    <a href="<?php echo $base_url; ?>/product-list.php" class="btn btn-secondary btn-lg" role="button">Back to Product</a>
                        <button class="btn btn-primart btn-lg" type="submit">Continue to checkout</button>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $rows; ?> </span>
                </h4>

                <?php if($rows > 0): ?>
                    <ul class="list-group mb-3">
                        <?php $grand_total = 0; ?>
                        <?php while($product = mysqli_fetch_assoc($query)): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?php echo $product['product_name']; ?> (<?php echo $_SESSION['cart'][$product['id']]; ?>)</h6>
                                    <small class="text-body-secondary"><?php echo nl2br($product['detail']); ?></small>
                                    <input type="hidden" name="product[<?php echo $product['id']; ?>][price]" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="product[<?php echo $product['id']; ?>][name]" value="<?php echo $product['product_name' ]; ?>">
                                </div>
                                <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$product['id']] * $product['price'], 2); ?></span>
                            </li>
                            <?php $grand_total += $_SESSION['cart'][$product['id']] * $product['price']; ?>
                            <?php endwhile; ?>
                            <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                <div class="text-success">
                                    <h6 class="my-0">Grand Total</h6>
                                    <small>amount</small>
                                </div>
                                <span class="text-success"><strong>฿<?php echo number_format($grand_total, 2); ?></strong></span>
                            </li>
                    </ul>
                    <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
            </div>
        </div>
        <?php endif ?>