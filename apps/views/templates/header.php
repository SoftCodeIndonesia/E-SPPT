<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $data['title'] ?></title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/vendor/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= BASE_URL ?>assets/vendor/favicon.ico" type="image/x-icon">
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/styles.css">
    <!-- EOF CSS INCLUDE -->

    <style>
    .border-icon {
        border: 2px solid #0c2740 !important;
    }

    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body>

    <!-- APP WRAPPER -->
    <div class="app">

        <!-- START APP CONTAINER -->
        <div class="app-container">
            <?php include 'sidebar.php' ?>
            <?php include 'navbar.php' ?>