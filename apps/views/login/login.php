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
    <style type="text/css">
    .jqstooltip {
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0, 0, 0, 0.6);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        z-index: 10000;
    }

    .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
    }
    </style>
</head>

<body>

    <!-- APP WRAPPER -->
    <div class="app app-loaded">

        <!-- START APP CONTAINER -->
        <div class="app-container">

            <div class="app-login-box">
                <div class="app-login-box-title padding-top-30">
                    <div class="title">Log In</div>
                </div>
                <div class="app-login-box-container margin-top-20">
                    <div class="title">Sign in with email</div>
                    <form action="<?= BASE_URL ?>login/storeLogin" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email Address"
                                autocomplete="off" id="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                autocomplete="off" id="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block btn-login">Login</button>
                        </div>

                    </form>
                </div>
                <div class="col-md-12" id="alert_validation">

                </div>
            </div>

        </div>
        <!-- END APP CONTAINER -->

    </div>
    <!-- END APP WRAPPER -->

    <!-- START SCRIPTS -->
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/moment/moment.min.js"></script>

    <script type="text/javascript"
        src="<?= BASE_URL ?>assets/vendor/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/bootstrap-select/bootstrap-select.js">
    </script>
    <script type="text/javascript"
        src="<?= BASE_URL ?>assets/vendor/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/maskedinput/jquery.maskedinput.min.js">
    </script>
    <script type="text/javascript"
        src="<?= BASE_URL ?>assets/vendor/js/vendor/form-validator/jquery.form-validator.min.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/noty/jquery.noty.packaged.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/datatables/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/datatables/dataTables.bootstrap.min.js">
    </script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/knob/jquery.knob.min.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/jvectormap/jquery-jvectormap.min.js">
    </script>
    <script type="text/javascript"
        src="<?= BASE_URL ?>assets/vendor/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript"
        src="<?= BASE_URL ?>assets/vendor/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/sparkline/jquery.sparkline.min.js">
    </script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/morris/raphael.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/morris/morris.min.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/rickshaw/d3.v3.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/rickshaw/rickshaw.min.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/isotope/isotope.pkgd.min.js"></script>

    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/app.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/app_plugins.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/app_demo.js"></script>
    <!-- END SCRIPTS -->

    <script>
    var base_url = "<?= BASE_URL ?>";
    </script>
    <?php if ($data['js']) : ?>
    <?php foreach ($data['js'] as $value) : ?>
    <script type="text/javascript" src="<?= BASE_URL ?>assets/js/<?= $value ?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>


</body>

</html>