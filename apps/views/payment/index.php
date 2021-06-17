<div class="block block-condensed">
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
            <h5><?= $this->menuActived['label'] ?></h5>
            <p>Tabel ini berisi daftar <?= $this->menuActived['label'] ?></p>
        </div>
    </div>
    <!-- END HEADING -->

    <div class="block-content">
        <div class="row">
            <div class="col-sm-6">
                <a href="<?= BASE_URL ?><?= $this->currentController ?>/create" type="button"
                    class="btn btn-primary btn-create"><span class="icon-plus"></span> Tambah Payment</a>
            </div>
        </div>
    </div>

    <div class="block-content">

        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered datatable-extended dataTable no-footer"
                        id="tablePayment" role="grid" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Name: activate to sort column descending" style="width: 154px;">No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                    style="width: 150px;">Nama</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                    colspan="1" aria-label="Office: activate to sort column ascending"
                                    style="width: 119px;">Dibuat pada</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                    colspan="1" aria-label="Age: activate to sort column ascending"
                                    style="width: 251px;">Dibuat oleh</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                    colspan="1" aria-label="Start date: activate to sort column ascending"
                                    style="width: 119px;">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- MODAL BACKDROP DISABLE -->
<div class="modal fade" id="modal-backdrop-disable" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" id="form-create" method="POST">
                    <div class="app-heading app-heading-small app-heading-condensed">
                        <div class="title">
                            <h2>Tambah <?= $this->menuActived['label'] ?></h2>
                            <p>Isi form di bawah ini</p>
                        </div>
                    </div>

                    <input type="hidden" name="payment_id" id="payment_id">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control" placeholder="name"
                                autocomplete="off">
                            <span class="help-block form-error text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-default btn-submit">simpan</button>
                        </div>
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL BACKDROP DISABLE -->