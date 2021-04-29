<div class="container">
    <form class="form-horizontal" id="form-create">
        <div class="block">

            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Menu baru</h2>
                    <p>Isi form di bawah ini</p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Parent menu</label>
                <div class="col-md-10">
                    <select class="form-control" name="parent_id" id="option-parent">
                        <option value="0">This parent</option>
                    </select>
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
            </div>


            <div class="form-group">
                <label class="col-md-2 control-label" for="description">Select Icon</label>
                <div class="col-md-10">
                    <input type="text" data-toggle="modal" data-target="#modal-full" class="form-control"
                        placeholder="click to select icons" readonly="">
                </div>
            </div>


        </div>

        <div class="content-permission">

        </div>

        <button type="button" class="btn btn-default" id="add-permission" style="margin-bottom: 15px;">Tambahkan
            permission <span class="icon-plus-circle pull-right"></span></button>

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
                <button type="button" class="btn btn-default">Submit</button>
            </div>
        </div>
    </div>
</div>