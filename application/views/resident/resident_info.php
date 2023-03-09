<div class="row">
    <div class="col-md-9">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="box-title" id="title">
                        <?php
                        if ($state == 'male') {
                            echo 'All Male Resident';
                        } elseif ($state == 'female') {
                            echo 'All Female Resident';
                        } elseif ($state == 'voters') {
                            echo 'All Voters';
                        } elseif ($state == 'non_voters') {
                            echo 'All Non Voters';
                        } else {
                            echo 'All Resident';
                        }
                        ?>
                    </h4>
                </div>
            </div>
            <div class="table-responsive m-t-30">
                <table class="display nowrap color-table info-table" cellspacing="0" width="100%" id="resinfotable">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Birthdate</th>
                            <th>Age</th>
                            <th>Civil Status</th>
                            <th>Gender</th>
                            <th>Purok</th>
                            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(3)) : ?>
                                <th>Voter Status</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($resident)) : ?>
                            <?php foreach ($resident as $row) : ?>
                                <tr>
                                    <td>
                                        <a href="<?= site_url('generate_profile/') . $row['id'] ?>">
                                            <?php if (empty($row['picture'])) : ?>
                                                <img width="30" height="30" class="img-circle" alt="user" src="<?= site_url() ?>assets/img/person.png" />
                                            <?php else : ?>
                                                <img width="30" height="30" class="img-circle" alt="user" src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : site_url() . 'assets/uploads/resident_profile/' . $row['picture'] ?>" />
                                            <?php endif ?>

                                            <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                        </a>
                                    </td>
                                    <td><?= date('M. d, Y', strtotime($row['birthdate'])) ?></td>
                                    <td><?= floor((time() - strtotime($row['birthdate'])) / 31556926); ?></td>
                                    <td><?= $row['civilstatus'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['purok'] ?></td>
                                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(3)) : ?>
                                        <td><?= $row['voterstatus'] ?></td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-3">

        <?php if ($state == 'non-voters' || $state == 'voters' || $state == 'pwd' || $state == 'senior') : ?>

            <div class="row colorbox-group-widget">
                <div class="col-md-12 col-sm-12 info-color-box">
                    <div class="white-box">
                        <div class="media <?= $state == 'senior' ? 'bg-info' : null ?><?= $state == 'voters' ? 'bg-success' : null ?><?= $state == 'non-voters' ? 'bg-warning' : null ?>" <?= $state == 'pwd' ? 'style="background-color:#6861ce"' : null ?>>
                            <div class="media-body">
                                <h3 class="info-count"><?= number_format(count($resident)) ?>
                                    <span class="pull-right">
                                        <?php
                                        if ($state == 'voters') {
                                            echo ' <i class="icon-user-following"></i>';
                                        } elseif ($state == 'non_voters') {
                                            echo ' <i class="icon-user-following"></i>';
                                        } elseif ($state == 'pwd') {
                                            echo ' <i class="fa fa-wheelchair"></i>';
                                        } elseif ($state == 'senior') {
                                            echo ' <i class="fa fa-users"></i>';
                                        } else {
                                            echo '<i class="icon-people"></i>';
                                        }
                                        ?>
                                    </span>
                                </h3>
                                <p class="info-text font-16 text-white">
                                    <?= $state == 'pwd' ? 'All PWD Residents' : null ?>
                                    <?= $state == 'senior' ? 'All Senior Citizens' : null ?>
                                    <?= $state == 'voters' ? 'All Voters' : null ?>
                                    <?= $state == 'non-voters' ? 'All Non Voters' : null ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row colorbox-group-widget">
                <div class="col-md-12 col-sm-12 info-color-box">
                    <div class="white-box">
                        <div class="media bg-primary">
                            <div class="media-body">
                                <h3 class="info-count"><?= number_format(count($resident)) ?>
                                    <span class="pull-right"><i class="icon-people"></i></span>
                                </h3>
                                <p class="info-text font-16 text-white">Residents</p>
                                <p class="info-ot font-13"><a href="javascript:void(0)" id="allRes" class="text-white">All Residents</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 info-color-box">
                    <div class="white-box">
                        <div class="media bg-info" <?= $state == 'male' ? 'style="background-color:#6861ce"' : null ?>>
                            <div class="media-body">
                                <h3 class="info-count"><?= number_format(count($male)) ?>
                                    <span class="pull-right"><i class="icon-user"></i></span>
                                </h3>
                                <p class="info-text font-16 text-white">Male Residents</p>
                                <p class="info-ot font-13"><a href="javascript:void(0)" id="maleRes" class="text-white">Male Residents</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 info-color-box">
                    <div class="white-box">
                        <div class="media bg-warning">
                            <div class="media-body">
                                <h3 class="info-count"><?= number_format(count($female)) ?>
                                    <span class="pull-right"><i class="icon-user-female"></i></span>
                                </h3>
                                <p class="info-text font-16 text-white">Female Residents</p>
                                <p class="info-ot font-13"><a href="javascript:void(0)" id="femaleRes" class="text-white">Female Residents</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ?>
    </div>
</div>