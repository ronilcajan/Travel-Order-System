<div class="white-box">
    <div class="row">
        <div class="col-sm-3">
            <h4 class="box-title">Resident Information</h4>
        </div>
        <div class="col-sm-6">
            <form action="" method="GET">
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-btn">
                            <button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" name="qr_code" class="form-control" placeholder="Enter QR code here" required value="<?= !empty($_GET['qr_code']) ? $_GET['qr_code'] : null ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
    <div class="table-responsive">
        <table class="display table-hover table-striped color-table info-table" id="restable">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>National ID</th>
                    <th>Alias</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Civil Status</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($res)) : ?>
                    <?php foreach ($res as $row) : ?>
                        <tr>
                            <td>
                                <a href="<?= site_url('admin/generate_profile/') . $row->id ?>">
                                    <?php if (empty($row->picture)) : ?>
                                        <img width="30" height="30" class="img-circle" alt="user" src="<?= site_url() ?>assets/img/person.png" />
                                    <?php else : ?>
                                        <img width="30" height="30" class="img-circle" alt="user" src="<?= preg_match('/data:image/i', $row->picture) ? $row->picture : site_url() . 'assets/uploads/resident_profile/' . $row->picture ?>" />
                                    <?php endif ?>

                                    <?= ucwords($row->lastname . ' ' . $row->suffix . ', ' . $row->firstname . ' ' . $row->middlename) ?>
                                </a>
                            </td>
                            <td><?= $row->national_id ?></td>
                            <td><?= $row->alias ?></td>
                            <td><?= date('M. d, Y', strtotime($row->birthdate)) ?></td>
                            <td><?= floor((time() - strtotime($row->birthdate)) / 31556926) ?></td>
                            <td><?= $row->civilstatus ?></td>
                            <td><?= $row->gender ?></td>
                            <td><?= $row->resident_type == "Alive" ? '<span class="label label-success">Alive</span>' : '<span class="label label-danger">Deceased</span>' ?></td>
                            <td>

                                <a type='button' data-remarks='<?= $row->id ?>' href='<?= site_url("admin/edit_resident/") . $row->id ?>' onclick='editOfficial(this)' data-toggle='tooltip' data-original-title='Edit Resident'> <i class='fa fa-pencil text-inverse m-r-10'></i> </a>
                                <a type='button' href='<?= site_url(' admin/generate_profile/') . $row->id ?>' data-toggle='tooltip' data-original-title='View Profile'> <i class='fa fa-user text-info m-r-10'></i> </a>
                                <a type='button' href='<?= site_url(' admin/generate_id/') . $row->id ?>' data-toggle='tooltip' data-original-title='Generate ID'> <i class='fa fa-file-photo-o text-inverse m-r-10'></i> </a>
                                <a type="button" href="<?= site_url('admin/generate_brgy_cert/') . $row->id  ?>" data-toggle="tooltip" title="Generate Barangay Certificate"><i class="fa fa-file-text-o text-inverse m-r-10"></i> </a>
                                <a type="button" href="<?= site_url('admin/generate_indi_cert/') . $row->id  ?>" data-toggle="tooltip" title="Generate Indigency Certificate"><i class="fa fa-file-text-o text-info m-r-10"></i> </a>
                                <a type="button" href="<?= site_url('admin/generate_resi_cert/') . $row->id  ?>" data-toggle="tooltip" title="Generate Residency Certificate"><i class="fa fa-file-text-o text-success m-r-10"></i> </a>
                                <a type='button' href='#covidUpdate' data-toggle='modal' title='COVID Update' data-id='<?= $row->id ?>' data-remarks='<?= $row->remarks ?>' data-status='<?= $row->status ?>' data-dose='<?= $row->date_vaccinated ?>' data-name='<?= $row->vaccinator_name ?>' data-manu='<?= $row->manufacturer ?>' data-batch='<?= $row->batch_no ?>' data-lot='<?= $row->lot_no ?>' data-dose1='<?= $row->date_vaccinated_1 ?>' data-name1='<?= $row->vaccinator_name_1 ?>' data-manu1='<?= $row->manufacturer_1 ?>' data-batch1='<?= $row->batch_no_1 ?>' data-lot1='<?= $row->lot_no_1 ?>' onclick='updateCovid(this)'> <i class='fa fa-certificate text-inverse m-r-10'></i> </a>
                                <?php if ($this->session->role == 'administrator' || $this->session->role == 'power user') : ?>
                                    <a type='button' href='<?= site_url('resident/delete/') . $row->id ?>' onclick='return confirm(&quot;Are you sure you want to delete this resident?&quot);' data-toggle='tooltip' data-original-title='Remove'> <i class='fa fa-times text-danger m-r-10'></i> </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('resident/modal') ?>