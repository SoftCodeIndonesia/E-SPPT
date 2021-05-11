<div class="container">
    <input type="hidden" id="menu_id" name="menu_id" value="<?= $this->param1 ?>">
    <form action="" id="add-permission">
        <div class="block permission-content-'+index+'">
            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Permission</h2>
                    <p>Isi form di bawah ini</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="permission_name">Name</label>
                <div class="col-md-10">
                    <input type="text" name="permission_name" id="permission_name" class="form-control"
                        placeholder="name" autocomplete="off">
                    <span class="help-block form-error text-danger"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="description_permission">Description</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="description_permission" id="description_permission"
                        rows="5"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><button type="submit" class="btn btn-primary btn-block btn-submit">simpan</button></p>
                </div>
            </div>
        </div>
    </form>
</div>