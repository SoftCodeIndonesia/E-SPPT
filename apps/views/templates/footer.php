</div>
</div>
<!-- END APP CONTAINER -->

<!-- START APP FOOTER -->
<div class="app-footer app-footer-default" id="footer">


    <div class="app-footer-line darken">
        <div class="copyright wide text-center">&copy; 2016 Boooya. All right reserved in the Ukraine and other
            countries.</div>
    </div>
</div>
<!-- END APP FOOTER -->



<!-- APP OVERLAY -->
<div class="app-overlay"></div>
<!-- END APP OVERLAY -->
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
<script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/form-validator/jquery.form-validator.min.js">
</script>

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
<script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js">
</script>

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
<script type="text/javascript" src="<?= BASE_URL ?>assets/vendor/js/app_demo_dashboard.js"></script>
<!-- <script type="text/javascript" src="<?= BASE_URL ?>assets/js/menu/index.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>assets/js/menu/create.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/sweetAlert.js"></script>
<script>
var base_url = "<?= BASE_URL ?>";

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    console.log(charCode);
    if (charCode !== 32 && (charCode < 48 || charCode > 57) && charCode !== 46 && charCode !== 45)

        return false;
    return true;
}

function failledCallback(title) {
    return swal(title);
}


function callbackAlert(titleSweet, descriptionSweet, typeAlert) {
    return swal(titleSweet, descriptionSweet, typeAlert);
}

function alertConfirm(title, text, icon, buttons, dangerMode, deleted, canceled) {
    return swal({
            title: title,
            text: text,
            icon: icon,
            buttons: buttons,
            dangerMode: dangerMode,
        })
        .then((willDelete) => {
            if (willDelete) {
                deleted();
            } else {
                canceled;
            }
        });
}

const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}
</script>
<?php if ($this->js) : ?>
<?php foreach ($this->js as $value) : ?>
<script type="text/javascript" src="<?= BASE_URL ?>assets/js/<?= $value ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
</body>

</html>