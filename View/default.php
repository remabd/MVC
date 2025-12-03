<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>EcoSphere - Shop</title>
    <meta name="viewport" content="width=device-width">
    <link href="View/style.css" rel="stylesheet" type="text/css">
    <!-- <link href="View/style/header-footer.css" rel="stylesheet" type="text/css">
    <link href="View/style/mainSection.css" rel="stylesheet" type="text/css"> -->
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Nunito|Glegoo" rel="stylesheet">
    <!-- Fontawesome -->
    <script src="./View/js/fontawesome-all.min.js"></script>
    <!-- Icon -->
    <link href="./View/img/icon.png" rel="icon">
</head>

<body>
    <?php
    include_once "header.php" ?>
    <section id="main-section">
        <?php
        if (isset($page)) {
            if ($page == 'home')
                require("./View/home.php");
            else
                require("./View/" . $page . ".php");
        }
        ?>
    </section>
    <?php include_once "footer.php" ?>
</body>

</html>