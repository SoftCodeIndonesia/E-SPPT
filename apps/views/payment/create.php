<div class="container">
    <form class="form-horizontal" id="form-create" method="POST">
        <div class="block">

            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Tambah <?= $this->menuActived['label'] ?></h2>
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

        </div>
        <div class="row">
            <div class="col-md-12">
                <p><button type="submit" class="btn btn-primary btn-block btn-submit">simpan</button></p>
            </div>
        </div>
    </form>
</div>