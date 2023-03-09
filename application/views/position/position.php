<div class="white-box">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="box-title"><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ul class="list-inline pull-right">
                <li>
                    <div class="card-tools">
                        <a href="#add" data-toggle="modal" class="fcbtn btn btn-outline btn-primary btn-1d btn-xs btn-rounded">
                            <i class="fa fa-plus"></i>
                            Position
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-responsive m-t-30">
        <table class="display table-hover table-striped color-table info-table" id="positionTable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Position</th>
                    <th scope="col">Order</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($position)) : ?>
                    <?php $no = 1;
                    foreach ($position as $row) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['position'] ?></td>
                            <td><?= $row['pos_order'] ?></td>
                            <td>
                                <a type="button" href="#edit" data-toggle="modal" onclick="editPos(this)" title="Edit Position" data-pos="<?= $row['position'] ?>" data-order="<?= $row['pos_order'] ?>" data-id="<?= $row['id'] ?>">
                                    <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="<?= site_url('position/delete/') . $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this position?');" data-toggle="tooltip" data-original-title="Remove">
                                    <i class="fa fa-close text-danger"></i> </a>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No Available Data</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('position/modal') ?>