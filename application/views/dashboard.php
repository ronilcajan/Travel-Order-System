<div class="row colorbox-group-widget">
    <div class="col-lg-3 col-md-6 col-sm-6 info-color-box">
        <div class="white-box">
            <div class="media bg-primary">
                <div class="media-body">
                    <h3 class="info-count" id="total"><span
                            style="font-size: 40px;"><?= number_format($population) ?></span> <span
                            class="pull-right"><i class="icon-people"></i></span></h3>
                    <p class="info-text font-bold">Population</p>
                    <p class="info-ot font-13"><a href="<?= site_url('admin/population') ?>" class="text-white">GENERATE
                            REPORT</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 info-color-box">
        <div class="white-box">
            <div class="media bg-success">
                <div class="media-body">
                    <h3 class="info-count"><span style="font-size: 40px;"><?= number_format(count($voters)) ?></span>
                        <span class="pull-right"><i class="icon-user-following"></i></span>
                    </h3>
                    <p class="info-text font-bold">Voters</p>
                    <p class="info-ot font-13"><a href="<?= site_url('admin/resident_info/voters') ?>"
                            class="text-white">GENERATE REPORT</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 info-color-box">
        <div class="white-box">
            <div class="media bg-warning">
                <div class="media-body">
                    <h3 class="info-count"><span style="font-size: 40px;"><?= number_format(count($nonvoters)) ?></span>
                        <span class="pull-right"><i class="icon-user-unfollow"></i></span>
                    </h3>
                    <p class="info-text font-bold">Non Voters</p>
                    <p class="info-ot font-13"><a href="<?= site_url('admin/resident_info/non-voters') ?>"
                            class="text-white">GENERATE REPORT</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 info-color-box">
        <div class="white-box">
            <div class="media" style="background-color:#6861ce">
                <div class="media-body">
                    <h3 class="info-count"><span style="font-size: 40px;"><?= number_format(count($pwd)) ?></span> <span
                            class="pull-right"><i class="fa fa-wheelchair"></i></span></h3>
                    <p class="info-text font-bold text-white">PWD</p>
                    <p class="info-ot font-13"><a href="<?= site_url('admin/resident_info/pwd') ?>"
                            class="text-white">GENERATE REPORT</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-lg-8 col-xs-12">
        <div class="white-box sc-widget">
            <h4 class="box-title">This Week Revenue Chart</h4>
            <ul class="list-inline text-right">
                <li>
                    <h6><i class="fa fa-circle text-info m-r-5 "></i>Brgy Clearance</h6>
                </li>
                <li>
                    <h6><i class="fa fa-circle text-primary m-r-5"></i>Indigency Certificate</h6>
                </li>
                <li>
                    <h6><i class="fa fa-circle text-warning m-r-5"></i>Residency Certificate</h6>
                </li>
                <li>
                    <h6><i class="fa fa-circle m-r-5" style="color:#d27906"></i>Business Permit</h6>
                </li>
                <li>
                    <h6><i class="fa fa-circle text-dark m-r-5"></i>Others</h6>
                </li>
            </ul>
            <div class="chartist-sales-chart chart-pos m-t-20"></div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Resident Chart</h3>
            <div id="morris-donut-chart"></div>
        </div>
    </div>
</div>
<div class="white-box">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="box-title">BARANGAY MISSION AND VISION</h4>
        </div>
    </div>
    <p class="m-b-20">
        <?= !empty($info->dashboard_text) ? $info->dashboard_text : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.' ?>
    </p>
    <img src="<?= !empty($info->dashboard_img) ? base_url() . 'assets/uploads/' . $info->dashboard_img : base_url() . 'assets/img/bg-abstract.png' ?>"
        style="width: 100%" />
</div>