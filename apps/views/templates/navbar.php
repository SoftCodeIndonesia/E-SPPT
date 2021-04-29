<!-- START APP CONTENT -->
<div class="app-content app-sidebar-left">
    <!-- START APP HEADER -->
    <div class="app-header">
        <ul class="app-header-buttons">
            <li class="visible-mobile"><a href="<?= BASE_URL ?>assets/vendor/#" class="btn btn-link btn-icon"
                    data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
            <li class="hidden-mobile"><a href="<?= BASE_URL ?>assets/vendor/#" class="btn btn-link btn-icon"
                    data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-list4"></span></a></li>
        </ul>

        <ul class="app-header-buttons pull-right">
            <li>
                <div class="contact contact-lg contact-ps-controls">
                    <?php if ($_SESSION['userdata']) : ?>
                    <div class="contact-container">
                        <a href="<?= BASE_URL ?>assets/vendor/#"><?= $_SESSION['userdata']['username'] ?></a>
                        <span><?= $_SESSION['userdata']['rule'] ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="contact-controls">
                        <div class="dropdown">

                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span
                                    class="icon-cog"></span></button>

                            <ul class="dropdown-menu dropdown-left">
                                <?php if ($_SESSION['userdata']) : ?>
                                <li><a href="<?= BASE_URL ?>assets/vendor/#"><span class="icon-cog"></span>
                                        Settings</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['userdata']) : ?>
                                <li><a href="<?= BASE_URL ?>login/logOut"><span class="icon-exit-right"></span> Log
                                        Out</a></li>
                                <?php else : ?>
                                <li><a href="<?= BASE_URL ?>login"><span class="icon-enter-right"></span> Log
                                        In</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- END APP HEADER  -->

    <!-- START PAGE HEADING -->

    <div class="app-heading-container app-heading-bordered bottom">
        <ul class="breadcrumb">
            <li><a href="<?= BASE_URL . $_SESSION['backword'] ?>"><?= $_SESSION['backword'] ?></a></li>
            <li class="active"><?= $_SESSION['current_state'] ?></li>
        </ul>
    </div>
    <!-- END PAGE HEADING -->