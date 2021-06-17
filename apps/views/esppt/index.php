<div class="container">
    <div class="block block-condensed">
        <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>Table E-SPPT</h5>
                <p>Table ini berisi daftar E-SPPT</p>
            </div>
        </div>
        <!-- END HEADING -->

        <div class="block-content">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= BASE_URL ?><?= $this->currentController ?>/create" type="button"
                        class="btn btn-primary"><span class="icon-plus"></span> Tambah E-SPPT</a>
                </div>
            </div>
        </div>

        <div class="block-content">

            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered datatable-extended dataTable no-footer"
                            id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 154px;">
                                        No E-Sppt
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 200px;">
                                        Pemilik
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 50px;">Metode pembayaran</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 300px;">NOP</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 251px;">Jatuh tempo</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Salary: activate to sort column ascending"
                                        style="width: 94px;">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>