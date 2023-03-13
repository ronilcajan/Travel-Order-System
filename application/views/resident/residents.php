<div class="white-box">
    <div class="row">
        <div class="col-sm-3">
            <h4 class="box-title">Resident Information</h4>
        </div>
        <div class="col-sm-9">
            <ul class="list-inline pull-right">
                <li>
                    <div class="card-tools">
                        <a href="<?= site_url('admin/search') ?>"
                            class="fcbtn btn btn-outline btn-primary btn-1d btn-xs btn-rounded"
                            title="Search Resident using QR Code" data-toggle="tooltip">
                            <i class="fa fa-qrcode"></i>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="card-tools">
                        <a href="<?= site_url('admin/create_resident') ?>"
                            class="fcbtn btn btn-outline btn-primary btn-1d btn-xs btn-rounded"
                            title="Create New Resident" data-toggle="tooltip">
                            <i class="fa fa-plus"></i>
                            Resident
                        </a>
                    </div>
                </li>
                <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(3)) : ?>
                <li>
                    <div class="card-tools">
                        <a href="<?= site_url('resident/exportCSV') ?>"
                            class="fcbtn btn btn-outline btn-danger btn-1d btn-xs btn-rounded"
                            title="Export Resident in CSV Format" data-toggle="tooltip">
                            <i class="fa fa-file"></i>
                            Export CSV
                        </a>
                    </div>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
    <div class="table-responsive">
        <table class="display table-hover table-striped color-table info-table" id="residenttable">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>National ID</th>
                    <th>Alias</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Civil Status</th>
                    <th>Gender</th>
                    <th>Purok</th>
                    <th>Blocklisted</th>
                    <th>Status</th>
                    <th>PWD</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>