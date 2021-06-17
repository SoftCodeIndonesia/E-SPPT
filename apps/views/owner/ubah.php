<div class="container">
    <input type="hidden" name="owner_id" id="owner_id" value="<?= $this->param1 ?>">
    <input type="hidden" name="address_id" id="address_id" value="<?= $this->param1 ?>">
    <form class="form-horizontal" id="form-create" method="POST">
        <div class="block">

            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Ubah owner</h2>
                    <p>Isi form di bawah ini</p>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 control-label" for="name">Name</label>
                <div class="col-md-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="name" autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kecamatan</label>
                <div class="col-md-10">
                    <select class="form-control" name="kecamatan" id="option-kecamatan">
                        <option value="0">-- pilih kecamatan --</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Keluarahan/desa</label>
                <div class="col-md-10">
                    <select class="form-control" name="kelurahan" id="option-kelurahan">
                        <option value="0">-- pilih kelurahan/desa --</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="label">RT</label>
                <div class="col-md-10">
                    <input type="text" name="rt" id="rt" class="form-control" placeholder="RT" autocomplete="off">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="route">RW</label>
                <div class="col-md-10">
                    <input type="text" name="rw" id="rw" class="form-control" placeholder="RW" autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="description">Alamat</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="alamat" id="alamat" rows="5"></textarea>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <p><button type="submit" class="btn btn-primary btn-block btn-submit">simpan</button></p>
            </div>
        </div>
    </form>
</div>