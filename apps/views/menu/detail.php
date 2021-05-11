<div class="container">
    <input type="hidden" name="menu_id" id="menu_id" value="<?= $this->param1 ?>">
    <div class="col-md-12">
        <form action="" id="form-permission">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="icon-pencil-ruler2 title-menu"></span>
                    </h3>
                    <div class="panel-elements pull-right">
                        <button class="btn btn-default">Edit</button>
                    </div>
                    <div class="panel-elements pull-right" style="margin-right: 10px">
                        <a href="<?= BASE_URL . 'menu/add_permission/' . $this->param1 ?>" class="btn btn-default">Add
                            permission</a>
                    </div>
                </div>

                <div class="panel-body list-permission">

                </div>
            </div>
        </form>
    </div>
</div>