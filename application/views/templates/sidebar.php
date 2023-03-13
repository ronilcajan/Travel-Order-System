<?php
$sess = $this->ion_auth->user()->row();
$current_page = $this->uri->segment(2);
$sk = $this->uri->segment(3);
?>
<aside class="sidebar" role="navigation">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div class="profile-image">
                    <?php if (!empty($sess->avatar)) : ?>
                    <img src="<?= preg_match('/data:image/i', $sess->avatar) ? $sess->avatar : site_url() . 'assets/uploads/avatar/' . $sess->avatar ?>"
                        alt="User Image" class="img-circle">
                    <?php else : ?>
                    <img src="<?= site_url() ?>assets/img/person.png" alt="User Image" class="img-circle">
                    <?php endif ?>
                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-success">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="#edit_profile" data-toggle="modal"><i class="fa fa-user"></i> Edit Profile</a></li>
                        <li><a href="#changepass" data-toggle="modal"><i class="icon-lock-open"></i> Change Password</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('auth/logout') ?>" class="text-danger"><i class="fa fa-power-off"></i>
                                Logout</a></li>
                    </ul>
                </div>
                <p class="profile-text m-t-15 m-b-0 font-16" style="color:#8d9498"><a href="javascript:void(0);">
                        <?= ucwords($sess->first_name . ' ' . $sess->last_name) ?></a></p>
                <small class="profile-text"><a href="javascript:void(0);"> <span
                            class="user-level"><?= ucfirst($this->session->name ?? '') ?></a></small>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="side-menu" class="m-b-40">
                <li>
                    <a href="<?= site_url('admin/dashboard') ?>" aria-expanded="false"
                        class="<?= $current_page == 'dashboard' || $current_page == 'resident_info' ||  $current_page == 'population' ? 'active' : null ?>">
                        <i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/resident') ?>" aria-expanded="false"
                        class="<?= $current_page == 'resident' || $current_page == 'search' || $current_page == 'generate_profile' || $current_page == 'create_resident' || $current_page == 'edit_resident' || $current_page == 'generate_id' ? 'active' : null ?>">
                        <i class="icon-people fa-fw"></i> <span class="hide-menu"> EMPLOYEES</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/officials') ?>" aria-expanded="false"><i class="icon-docs fa-fw"></i>
                        <span class="hide-menu">TRAVEL ORDERS</span></a>
                </li>
                <li>
                    <a href="<?= site_url('admin/officials') ?>" aria-expanded="false"><i
                            class="icon-user-following fa-fw"></i> <span class="hide-menu">OFFICIALS</span></a>
                </li>
                <li>
                    <a href="<?= site_url('admin/user') ?>" aria-expanded="false"><i class="icon-user fa-fw"></i>
                        <span class="hide-menu">USERS</span></a>
                </li>
                <?php if ($this->ion_auth->in_group(1)) : ?>
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-wrench fa-fw"></i> <span class="hide-menu"> SETTINGS<span
                                class="caret pull-right m-t-10"></span></span></a>
                    <ul aria-expanded="false" class="collapse m-b-40 p-b-40">
                        <li><a href="<?= site_url('admin/position') ?>">POSITIONS</a></li>
                        <li><a href="<?= site_url('admin/roles') ?>">ROLES</a></li>
                        <li><a href="#restore" data-toggle="modal">RESTORE</a></li>
                        <li><a href="<?= site_url('backup') ?>" data-toggle="modal">BACKUP</a></li>
                        <li><a href="#system" data-toggle="modal">SYSTEM</a></li>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</aside>