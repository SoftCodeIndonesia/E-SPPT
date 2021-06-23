<div class="container">
    <form class="form-horizontal" action="<?= BASE_URL ?>esppt/streCreated" method="POST" id="form-create">
        <div class="block">

            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Buat SPPT Baru</h2>
                    <p>Isi form di bawah ini</p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Owner</label>
                <div class="col-md-10">
                    <select class="form-control" name="owner" id="list-owner">
                        <option value="0">
                            pilih owner
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="description"></label>
                <div class="col-md-10" id="address">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="nop">Nomor Object Pajak (NOP)</label>
                <div class="col-md-10">
                    <input type="text" name="nop" id="nop" onkeypress="return hanyaAngka(event)" class="form-control"
                        placeholder="Masukan nomor object pajak" autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="nop">PBB Terhutang</label>
                <div class="col-md-10">
                    <input type="text" name="pbb_terhutang" id="pbb_terhutang" class="form-control" placeholder="0 %"
                        autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="nop">Jatuh tempo</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <input type="date" class="form-control" name="due_date">

                    </div>
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Payment</label>
                <div class="col-md-10">
                    <input type="text" name="payment_bank" id="payment_bank" class="form-control"
                        placeholder="metode pembayaran" autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                    <div id="payment_option_list"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered datatable-basic dataTable no-footer"
                        id="DataTables_Table_0" role="grid">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 144px;">
                                    Aksi</th>
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
                        <tbody id="tbody">
                            <tr role="row" class="odd">
                                <td class="">
                                    <button type="button" disabled
                                        class="btn btn-default btn-icon btn-danger text-white"><span
                                            class="icon-trash2 color-white"></span></button>
                                </td>
                                <td class="">
                                    <input type="text" name="nama_object_pajak[0]" data-index="0"
                                        id="fild_object_pajak_0" class="form-control nama-object-pajak"
                                        placeholder="Nama object pajak" autocomplete="off">
                                    <div id="nama_object_pajak_0"></div>
                                </td>
                                <td class="sorting_1">
                                    <input type="text" name="luas[0]" id="luas_0" data-index="0"
                                        class="form-control luas" placeholder="0" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" name="kelas[0]" id="kelas_0" data-index="0"
                                        class="form-control kelas" placeholder="0" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" name="njop[0]" id="njop_0" data-index="0"
                                        class="form-control njop" placeholder="0" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" name="total_njop[0]" id="total_njop_0" data-index="0"
                                        class="form-control total_njop" placeholder="0" autocomplete="off">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan='3'>
                                    <a href="" id="add-new-colom">Tambahkan kolom </a>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-md-2 control-label" for="label">Label</label>
                <div class="col-md-10">
                    <input type="text" name="label" id="label" class="form-control" placeholder="label"
                        autocomplete="off">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="route">Route</label>
                <div class="col-md-10">
                    <input type="text" name="route" id="route" class="form-control" placeholder="route name"
                        autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="description">Description</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                </div>
            </div> -->


        </div>



        <div class="row">
            <div class="col-md-12">
                <p><button type="submit" class="btn btn-primary btn-block btn-submit">simpan</button></p>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="modal-full" tabindex="-1" role="dialog" aria-labelledby="modal-full-header">
    <div class="modal-dialog modal-fw" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-full-header">Full Width</h4>
            </div>
            <div class="modal-body">

                <?= $this->icons ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>