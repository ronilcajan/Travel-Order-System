<div class="white-box">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="box-title"><?= $title ?></h4>
        </div>
    </div>

    <div class="table-responsive m-t-30">
        <table class="display table-hover table-striped color-table info-table" id="purokTable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Action</th>
                    <th scope="col">Username</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($history)) : ?>
                <?php $no = 1;
                    foreach ($history as $row) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->activity ?></td>
                    <td><?= $row->action ?></td>
                    <td><?= $row->username ?></td>
                    <td><?= date('F d, Y h:i A', strtotime($row->created_at)) ?></td>
                </tr>
                <?php $no++;
                    endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>