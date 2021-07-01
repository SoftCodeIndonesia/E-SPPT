<div class="container">
    <div class="block block-condensed">

        <div class="block-content">

            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=<?= $_SESSION['lat'] . ',' . $_SESSION['lng'] ?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                        href="https://fmovies2.org">fmovies2.org</a><br>
                    <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 500px;
                        width: 100%;
                    }
                    </style><a href="https://www.embedgooglemap.net"></a>
                    <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 500px;
                        width: 100%;
                    }
                    </style>
                </div>
            </div>

        </div>

    </div>
</div>