<div class="white-box">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="box-title">Current Barangay Officials</h4>
        </div>
        <div class="col-sm-6">
            <ul class="list-inline pull-right">
                <li>
                    <div class="card-tools">
                        <a href="#add" data-toggle="modal"
                            class="fcbtn btn btn-outline btn-primary btn-1d btn-xs btn-rounded">
                            <i class="fa fa-plus"></i>
                            Official
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="switchery-demo m-b-30">
    </div>
    <div class="table-responsive m-t-30">
        <table class="display nowrap color-table info-table" cellspacing="0" width="100%" id="officialTable">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th class="noPrint">Hide/Show</th>
                    <th class="noPrint">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($officials)) : ?>
                <?php foreach ($officials as $row) : ?>
                <tr>
                    <td>
                        <?php if (!empty($row['avatar'])) : ?>
                        <img width='30' height='30' class='img-circle' alt='user'
                            src='<?= site_url() ?>assets/uploads/avatar/<?= $row["avatar"] ?>'>
                        <?php else : ?>
                        <img width='30' height='30' class='img-circle' alt='user'
                            src='<?= site_url() ?>assets/img/person.png' />
                        <?php endif ?>
                        <?= ucwords($row['name']) ?>
                    </td>
                    <td><?= $row['position'] ?></td>
                    <td><?= $row['status'] == 'Active' ? '<span class="label label-table label-primary">Active</span>' : '<span class="label label-danger">Inactive</span>' ?>
                    </td>
                    <td class="noPrint"><input type="checkbox" onchange="showOfficial(this);"
                            data-id="<?= $row['id'] ?>" data-check="<?= $row['name_show'] ?>" data-size="small"
                            <?= $row['name_show'] == 1 ? 'checked' : null ?> class="js-switch" data-color="#99d683" />
                    </td>
                    <td class="text-nowrap noPrint">
                        <a type=" button" href="#edit" data-toggle="modal" onclick="editOfficial(this)"
                            title="Edit Official" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>"
                            data-pos="<?= $row['pos_id'] ?>" data-start="<?= $row['termstart'] ?>"
                            data-end="<?= $row['termend'] ?>" data-status="<?= $row['status'] ?>"
                            data-avatar="<?= $row['avatar'] ?>">
                            <i class="fa fa-pencil text-inverse m-r-10"></i> </a>

                        <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(1)) : ?>
                        <a href="<?= site_url('officials/delete/') . $row['id'] ?>"
                            onclick="return confirm('Are you sure you want to delete this official?');"
                            data-toggle="tooltip" data-original-title="Remove"> <i class="fa fa-close text-danger"></i>
                        </a>
                        <?php endif ?>
                    </td>
                </tr>

                <?php endforeach ?>
                <?php else : ?>
                <tr>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('Power User')) : ?>
                    <td colspan="5" class="text-center">No Available Data</td>
                    <?php else : ?>
                    <td colspan="3" class="text-center">No Available Data</td>
                    <?php endif ?>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('official/modal') ?>