<div class="white-box">
    <div class="row">
        <div class="col-sm-3">
            <h4 class="box-title">Resident Information</h4>
        </div>
        <div class="col-sm-6">
            <form action="" method="GET">
                <ul class="list-inline">
                    <li>
                        <div class="form-group">
                            <input type="number" class="form-control" min="1" name="from" placeholder="Enter minimum age" required value="<?= !empty($_GET['from']) ? $_GET['from'] : null ?>">

                    </li>
                    <li>
                        <div class="form-group">
                            <input type="number" class="form-control" min="1" name="to" placeholder="Enter maximum age" required value="<?= !empty($_GET['to']) ? $_GET['to'] : null ?>">
                        </div>
                    </li>
                    <li>
                        <div class="card-tools">
                            <button type="submit" class=" fcbtn btn btn-outline btn-info btn-1d btn-xs btn-rounded" title="Search" data-toggle="tooltip">
                                Filter
                            </button>
                        </div>
                    </li>
                    <li>
                        <div class="card-tools">
                            <a href="<?= site_url('admin/resident') ?>" class="fcbtn btn btn-outline btn-primary btn-1d btn-xs btn-rounded" title="Refresh Page" data-toggle="tooltip">
                                Reload
                            </a>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="display table-hover table-striped color-table info-table" id="resident_age_table">
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
                </tr>
            </thead>
        </table>
    </div>
</div>