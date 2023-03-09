<div class="row">
    <div class="col-md-9">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="box-title"><?= $title ?></h4>
                </div>
            </div>
            <div class="table-responsive m-t-30">
                <table class="display nowrap color-table info-table" cellspacing="0" width="100%" id="population">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Birthdate</th>
                            <th>Age</th>
                            <th>Civil Status</th>
                            <th class="gender">Gender</th>
                            <th>PWD</th>
                            <th>Voter Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-3">
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
                    <div class="media bg-info" style="background-color:#6861ce">
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
    </div>
</div>