<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarikspizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URLROOT . '/public/css/style.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
    <!-- Vertical Navbar on the left -->
    <nav class="vertical-navbar">
        <div class="ingredient-filter">
            <h3>Filter by Ingredients</h3>
            <form method="post">
                <?php foreach ($data['Ingredients'] as $ingredient) { ?>
                <label>
                    <input type="checkbox" name="selectedIngredients[]" value="<?= $ingredient->ingredientId ?>">
                    <?= $ingredient->ingredientName ?>
                </label>
                <?php } ?>
                <div class="button-container">
                    <button class="apply-filter-button" type="submit">Apply Filter</button>
                    <button class="show-all-button" type="button" onclick="clearFilters()">Show All</button>
                </div>
            </form>

            <?php if (empty($data['Pizzas'])) { ?>
            <p class="error">No pizzas matching the selected ingredients.</p>
            <?php } ?>
        </div>
    </nav>

    <!-- Horizontal Navbar at the top -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URLROOT . '/dashboardscontroller/index' ?>">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Shopping Cart Icon -->
            <a class="navbar-cart-icon" href="<?= URLROOT ?>/cartsController/index">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count" id="cart-count">0</span>
            </a>
        </div>
    </nav>

    <!-- Content container -->
    <div class="content">
        <h1>Our menu</h1>
        <div class="row justify-content-center">
            <?php foreach ($data["Pizzas"] as $pizza) { ?>
            <div class="col-4">
                <div class="card" style="height: 23rem; margin-bottom: 2rem;">
                    <img src="<?= URLROOT . $pizza->pizzaImage ?>" class="card-img-top" alt="<?= $pizza->pizzaName ?>"
                        style="width: 100%; height: 10rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $pizza->pizzaName ?></h5>
                        <p class="card-text"><?= $pizza->pizzaDescription ?></p>
                        <p class="card-text"><?= $pizza->pizzaPrice ?></p>
                        <a href="#" class="button add-to-cart" data-pizza-id="<?= $pizza->pizzaId ?>">Add to cart</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>



    <!-- Shopping Cart Section -->
    <div class="shopping-cart hidden">
        <div class="cart-content">
            <button class="close-cart-button" id="close-cart-button">&times;</button>
            <h2>Shopping Cart</h2>
            <!-- Cart items will be displayed here -->
            <div id="cart-items">

            </div>
            <div id="total-cart-price"></div>
            <a class="checkout-button" id="checkout-button" href="<?= URLROOT; ?>/cartcontroller/index"
                style="display: none;">Checkout</a>

        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <!-- "Previous" button -->
            <li class="page-item <?= ($data['pageNumber'] <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="<?= URLROOT . '/dashboardcontroller/index/' . ($data['pageNumber'] - 1) ?>">Previous</a>
            </li>

            <!-- First page -->
            <li class="page-item <?= ($data['pageNumber'] == 1) ? 'active' : ''; ?>">
                <a class="page-link" href="<?= URLROOT . '/dashboardcontroller/index/1' ?>">1</a>
            </li>

            <!-- Second page (if applicable) -->
            <?php if ($data['totalPages'] >= 2) { ?>
            <li class="page-item <?= ($data['pageNumber'] == 2) ? 'active' : ''; ?>">
                <a class="page-link" href="<?= URLROOT . '/dashboardcontroller/index/2' ?>">2</a>
            </li>
            <?php } ?>

            <!-- Third page (if applicable) -->
            <?php if ($data['totalPages'] >= 3) { ?>
            <li class="page-item <?= ($data['pageNumber'] == 3) ? 'active' : ''; ?>">
                <a class="page-link" href="<?= URLROOT . '/dashboardcontroller/index/3' ?>">3</a>
            </li>
            <?php } ?>

            <!-- "Next" button -->
            <li class="page-item <?= ($data['pageNumber'] >= $data['totalPages']) ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="<?= URLROOT . '/dashboardcontroller/index/' . ($data['pageNumber'] + 1) ?>">Next</a>
            </li>
        </ul>
    </nav>




    <!-- JavaScript -->
    <script>
    const pizzaData = <?= json_encode($data["Pizzas"]) ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="<?= URLROOT . '/public/js/app.js' ?>"></script>
</body>

</html>