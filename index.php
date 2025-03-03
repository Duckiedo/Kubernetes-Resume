<?php
// Load environment variables
function loadEnv($path)
{
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        putenv(sprintf('%s=%s', $name, $value));
    }
    return true;
}

// Load .env file
loadEnv(__DIR__ . '/.env');

// Get dark mode setting from environment variable
$darkMode = getenv('DARK_MODE');
$classVariable = ($darkMode === 'true') ? "dark-mode" : "light-mode";

// Retrieve database connection details from environment variables
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');

// Attempt to connect to the database
$link = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kodekloud E-Commerce</title>

    <!-- Favicon -->
    <link rel="icon" href="learning-app-ecommerce/img/favicon.png" type="image/png" />
    <!-- CSS Files -->
    <link href="learning-app-ecommerce/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="learning-app-ecommerce/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="learning-app-ecommerce/vendors/linearicons/linearicons-1.0.0.css">
    <link rel="stylesheet" href="learning-app-ecommerce/vendors/wow-js/animate.css">
    <link rel="stylesheet" href="learning-app-ecommerce/vendors/owl_carousel/owl.carousel.css">
    <link href="learning-app-ecommerce/css/style.css" rel="stylesheet">
</head>
<body class="<?php echo $classVariable; ?>">

    <!--==========Main Header==========-->
    <header class="main_header_area">
        <nav class="navbar navbar-default navbar-fixed-top" id="main_navbar">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <img src="learning-app-ecommerce/img/logo.png" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav main_nav">
                        <li><a href="#">Laptops</a></li>
                        <li><a href="#">Drones</a></li>
                        <li><a href="#">Gadgets</a></li>
                        <li><a href="#">Phones</a></li>
                        <li><a href="#">VR</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--==========End Main Header==========-->

    <!--==========Slider Area==========-->
    <section class="slider_area row m0">
        <div class="slider_inner">
            <div class="camera_caption">
                <h2 class="wow fadeInUp animated">Make Your Shopping Easy</h2>
                <h5 class="wow fadeIn animated" data-wow-delay="0.3s">Find everything accordingly</h5>
                <a class="learn_mor wow fadeInU" data-wow-delay="0.6s" href="#product-list">Shop Now!</a>
            </div>
        </div>
    </section>
    <!--==========End Slider Area==========-->

    <section class="best_business_area row" id="product-list">
        <div class="check_tittle wow fadeInUp" data-wow-delay="0.7s">
            <h2>Product List</h2>
        </div>
        <div class="row it_works">
            <?php
            if (!$link) {
                echo "<div style='color: red; text-align: center;'>
                    <h3>Database Connection Error</h3>
                    <p>" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>
                </div>";
            } else {
                $query = "SELECT * FROM products;";
                $res = mysqli_query($link, $query);

                if (!$res) {
                    echo "<div style='color: red; text-align: center;'>
                        <h3>Query Error</h3>
                        <p>" . mysqli_error($link) . "</p>
                    </div>";
                } else {
                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <div class="col-md-3 col-sm-6 business_content">
                            <img src="learning-app-ecommerce/img/<?php echo htmlspecialchars($row['ImageUrl']); ?>" alt="">
                            <div class="media">
                                <div class="media-body">
                                    <a href="#"><?php echo htmlspecialchars($row['Name']); ?></a>
                                    <p>Purchase <?php echo htmlspecialchars($row['Name']); ?> at the lowest price <span><?php echo htmlspecialchars($row['Price']); ?>$</span></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                mysqli_close($link);
            }
            ?>
        </div>
    </section>
    <!--==========End Product List==========-->

    <footer class="footer_area row">
        <div class="container custom-container">
            <div class="copy_right_area">
                <h4 class="copy_right">© Copyright 2019 Kodekloud Ecommerce | All Rights Reserved</h4>
            </div>
        </div>
    </footer>
    <!--==========End Footer==========-->

    <!-- Scripts -->
    <script src="learning-app-ecommerce/js/jquery-1.12.4.min.js"></script>
    <script src="learning-app-ecommerce/js/bootstrap.min.js"></script>
    <script src="learning-app-ecommerce/vendors/wow-js/wow.min.js"></script>
    <script src="learning-app-ecommerce/vendors/owl_carousel/owl.carousel.min.js"></script>
    <script src="learning-app-ecommerce/js/theme.js"></script>
</body>
</html>
