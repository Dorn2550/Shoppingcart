<link rel="stylesheet" href="header.css">
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="<?php echo $base_url; ?>/index.php" class="nav-link px-2 link-dark">Home</a></li>
        <li class="nav-item"><a href="<?php echo $base_url; ?>/product-list.php" class="nav-link px-2 link-dark">Product List</a></li>
        <li class="nav-item"><a href="<?php echo $base_url; ?>/cart.php" class="nav-link px-2 link-dark">Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
    </ul>
</header>
