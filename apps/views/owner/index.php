<div class="container">
    <div class="block block-condensed">
        <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>Table Owner</h5>
                <p>Table ini berisi daftar owner</p>
            </div>
        </div>
        <!-- END HEADING -->

        <div class="block-content">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= BASE_URL ?><?= $this->currentController ?>/create" type="button"
                        class="btn btn-primary"><span class="icon-plus"></span> Tambah Owner</a>
                </div>
            </div>
        </div>

        <div class="block-content">

            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered datatable-extended dataTable no-footer"
                            id="tableOwner" role="grid" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 154px;">Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 251px;">Address</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Age: activate to sort column ascending"
                                        style="width: 100px;">Created At</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                                        colspan="1" aria-label="Start date: activate to sort column ascending"
                                        style="width: 119px;">Created By</th>
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

<!-- MODAL BACKDROP DISABLE -->
<div class="modal fade" id="modal-backdrop-disable" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="app-heading app-heading-small app-heading-condensed">
                    <div class="title">
                        <h5 id="title-name">Disable Backdrop</h5>
                        <p id="address">Aenean quis quam diam. Nam fringilla arcu ipsum.</p>
                    </div>
                </div>


                <div class="content-address">

                </div>

                <p class="text-right"><button class="btn btn-default" data-dismiss="modal">Close</button></p>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL BACKDROP DISABLE -->