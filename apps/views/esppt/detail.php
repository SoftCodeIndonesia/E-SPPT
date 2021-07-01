<div class="container">
    <div class="block block-condensed">


        <div class="block-content">
            <div class="row">
                <div class="col-md-12">

                    <div class="tile-basic">
                        <div class="tile-content text-center">
                            <span class="tile-subtitle"><?= Date('d M Y') ?></span>
                            <h3 class="tile-title">PEMBERITAHUAN PAJAK TERHUTANG PAJAK BUMI DAN BANGUNAN TAHUN
                                <?= Date('Y') ?></h3>
                            <p id="nop">NOP - </p>
                            <input type="hidden" name="sppt_id" id="sppt_id" value="<?= $this->param1 ?>">
                        </div>
                    </div>

                </div>
            </div>

            <div class="app-heading app-heading-small" style="margin-bottom: 100px">
                <div class="title">
                    <h5 id="pemilik">Pemilik</h5>
                    <p id="alamat">Alamat.</p>
                </div>
            </div>


            <table class="table table-striped table-bordered datatable-basic dataTable no-footer"
                id="DataTables_Table_0" role="grid">
                <thead>
                    <tr role="row">

                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 144px;">Object
                            pajak</th>
                        <th class="sorting_desc" tabindex="0" rowspan="1" colspan="1" style="width: 254px;">Luas
                            (m<sup>2</sup>)</th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 70px;">Kelas
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 127;">
                            NJOP Per m<sup>2</sip> (Rp)</th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 123px;">
                            Total NJOP (Rp)</th>

                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th colspan='3'>
                            <a href="" id="add-new-colom">Tambahkan kolom </a>
                        </th>
                    </tr>
                </tfoot>
            </table>


            <div class="row" style="margin-top: 50px">
                <div class="col-sm-6">
                    <p id="pemilik">NJOP Sebagai dasar pengernaan PBB</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="total_njop" class="">0</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p id="nilai_kena_pajak">NJKP (Nilai jual kena pajak)</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="njkp" class="">0</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p id="pemilik">PBB Yang terhutang</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="pbb" class="">0</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p id="pemilik">Total</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="total" class="">0</h5>
                </div>
            </div>

            <div class="row" style="margin-top: 50px">
                <div class="col-sm-6">
                    <p id="pemilik">Jatuh tempo</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="jatuh_tempo" class="">-</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p id="pemilik">Metode pembayaran</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 id="metode" class="">-</h5>
                </div>
            </div>

        </div>


    </div>
</div>