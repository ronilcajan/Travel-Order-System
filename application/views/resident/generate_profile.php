<?php
$query2 = $this->db->query("SELECT * FROM cert_settings WHERE id=1");
$certs = $query2->row();

$sess = $this->ion_auth->user()->row();
?>
<div class="text-right m-b-10">
    <a href="<?= site_url('admin/generate_brgy_cert/') . $res->id ?>" class="btn btn-primary btn-outline" type="button">
        <span><i class="fa fa-file-text-o"></i> Generate Barangay Certificate</span> </a>
    <a href="<?= site_url('admin/generate_indi_cert/') . $res->id ?>" class="btn btn-info btn-outline" type="button">
        <span><i class="fa fa-file-text-o"></i> Generate Indigency Certificate</span> </a>
    <a href="<?= site_url('admin/generate_resi_cert/') . $res->id ?>" class="btn btn-success btn-outline" type="button">
        <span><i class="fa fa-file-text-o"></i> Generate Residency Certificate</span> </a>
    <a href="<?= site_url('admin/generate_id/') . $res->id ?>" class="btn btn-info btn-outline" type="button"> <span><i
                class="fa fa-file-photo-o"></i> Generate Barangay ID</span> </a>
    <button id="print" class="btn btn-danger btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span>
    </button>
</div>

<div class="white-box printableArea">
    <div class="row" style="margin-bottom:2px;">
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <img src="<?= site_url() . 'assets/uploads/' . $info->city_logo ?>" class="img-fluid" width="100">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-center">
            <h5 class="m-b-0" style="line-height:1.2">Republic of the Philippines <br>Province of
                <?= ucwords($info->province) ?> <br> <?= $info->town ?></h5>
            <h3 class="font-bold m-b-0 m-t-0"><?= ucwords($info->brgy_name) ?></i></h2>
                <p class="m-t-0 font-12 font-bold">Contact No. <?= $info->number ?>/Email:<?= $info->email ?></p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <img src="<?= site_url() . 'assets/uploads/' . $info->brgy_logo ?>" class="img-fluid" width="100">
        </div>
    </div>
    <div>
        <div class="text-center">
            <h1 class="font-bold">CERTIFICATION</h1>
        </div>
        <?php if ($res->blocklisted == 'No') : ?>
        <p>This is to certify that the person whose name, picture signature and thumbprint appearing below is a legit
            resident of this barangay:</p>
        <?php else : ?>
        <p class="text-danger">Blocklisted Resident</p>
        <?php endif ?>
    </div>

    <div class="row m-t-30">
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <p class="m-0">DOCUMENT CODE</p>
                <h4 class="m-0"><?= strtoupper($code) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">FAMILY NAME</p>
                <h4 class="m-0"><?= strtoupper($res->lastname) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">MIDDLE NAME</p>
                <h4 class="m-0"><?= strtoupper($res->middlename) ?></h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <p class="m-0">VALID UNTIL</p>
                <h4 class="m-0"><?= strtoupper(date('F d, Y', strtotime('+6 months'))) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">FIRST NAME</p>
                <h4 class="m-0"><?= strtoupper($res->firstname) . ' ' . strtoupper($res->suffix) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">GENDER</p>
                <h4 class="m-0"><?= strtoupper($res->gender ?? '') ?></h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
            <?php if (empty($res->picture)) : ?>
            <img class="img-fluid b-all m-t-5" width="150" alt="Resident"
                src="<?= site_url() ?>assets/img/person.png" />
            <?php else : ?>
            <img class="img-fluid b-all" width="150" alt="Resident"
                src="<?= preg_match('/data:image/i', $res->picture) ? $res->picture : site_url() . 'assets/uploads/resident_profile/' . $res->picture ?>" />
            <?php endif ?>
            <p class="m-0">SIGNATURE</p>
        </div>
    </div>
    <div class="form-group">
        <p class="m-0">ADDRESS</p>
        <h4 class="m-0"><?= strtoupper($house->house_number . ' ' . $res->purok . ' ' . $res->address) ?></h4>
    </div>
    <div class="row m-t-30">
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <p class="m-0">DATE OF BIRTH</p>
                <h4 class="m-0"><?= strtoupper(date('F m, Y', strtotime($res->birthdate))) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">CITIZENSHIP</p>
                <h4 class="m-0"><?= strtoupper($res->citizenship) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">PURPOSE</p>
                <h4 class="m-0">MULTI-PURPOSE</h4>
            </div>
            <div class="form-group">
                <p class="m-0">REMARKS</p>
                <h4 class="m-0"><?= strtoupper($res->remarks ?? '') ?></h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
                <p class="m-0">PLACE OF BIRTH</p>
                <h4 class="m-0"><?= strtoupper($res->birthplace) ?></h4>
            </div>
            <div class="form-group">
                <p class="m-0">CIVIL STATUS</p>
                <h4 class="m-0"><?= strtoupper($res->civilstatus ?? '') ?></h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-left p-l-0">
            <div class="row b-all">
                <img id="qrcode" src="<?= $qrCode ?>" width="150">
            </div>
            <small class="m-t-10" style="font-size: 9px;">Date Printed: <?= date('l, F d, Y h:i A') ?></small>
            <div class="row">
                <div class="col-xs-6">
                    <small style="font-size: 9px;">Agency: Barangay</small>
                </div>
                <div class="col-xs-6">
                    <small style="font-size: 9px;">DATAID: <?= $sess->username ?></small>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <small style="font-size: 9px;">O.R. ID: </small>
                </div>
                <div class="col-xs-6">
                    <small style="font-size: 9px;">DST PAID</small>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <small style="font-size: 9px;">O.R. Date:</small>
                </div>
                <div class="col-xs-6">
                    <small style="font-size: 9px;">System: ABM System</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <img class="img-fluid" id="barcode" src="<?= site_url('resident/barCode/') . $res->id ?>"><br>
            <small class="m-0"><?= strtoupper($code) ?></small>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-center">
            <?php if (empty($this->session->flashdata('signature')) || $this->session->flashdata('signature') == 'On') : ?>
            <img src="<?= site_url() . '/assets/uploads/' . $certs->signature ?>" class="m-t-40 m-b-0" width="150"
                style="position:absolute; top:-70px; left:30%">
            <?php endif ?>
            <div class="p-2 text-bottom mt-5">
                <h6 class="font-bold m-b-0 ">
                    <?= empty($captain->name) ? 'No Barangay Captain selected' : strtoupper($captain->name) ?></h6>
                <p class="">PUNONG BARANGAY</p>
            </div>
        </div>
    </div>
</div>