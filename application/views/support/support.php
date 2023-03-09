<div class="white-box">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="box-title"><?= $title ?></h4>
        </div>
    </div>

    <div class="table-responsive m-t-30">
        <table class="display nowrap color-table info-table" id="supportTable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ticket)) : ?>
                    <?php $no = 1;
                    foreach ($ticket as $row) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></td>
                            <td><a href="tel:<?= $row['number'] ?>"><?= $row['number'] ?></a></td>
                            <td><?= $row['subject'] ?></td>
                            <td><?= $row['message'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <a href="<?= site_url('settings/delete/') . $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this psupport/ticket?');" data-toggle="tooltip" data-original-title="Remove">
                                    <i class="fa fa-close text-danger"></i> </a>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>