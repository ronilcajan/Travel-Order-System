<?php
$query = $this->db->query("SELECT * FROM id_settings WHERE id=1");
$id = $query->row();
$query2 = $this->db->query("SELECT * FROM cert_settings WHERE id=1");
$certs = $query2->row();
?>
<div class="text-right m-b-10">
    <?php if ($this->session->flashdata('paid') !== null) : ?>
    <button class="btn btn-danger btn-outline" type="button" id="print"> <span><i class="fa fa-print"></i> Print</span>
    </button>
    <?php else : ?>
    <a href="#id_payment" class="btn btn-success btn-outline" type="button" data-toggle="modal"> <span><i
                class="fa fa-check"></i> Payment</span> </a>
    <?php endif ?>
    <a class="btn btn-primary btn-outline" type="button" href="#editID" data-toggle="modal"> <span><i
                class="fa fa-pencil"></i> Edit</span> </a>
</div>

<div class="white-box printableArea" id="printThis">
    <div id="frontpage" style="background-color: <?= $id->bg_color ?> !important;">
        <div class="col-md-12">
            <div class="pull-left">
                <img src="<?= site_url() . 'assets/uploads/' . $info->city_logo ?>" width="50">
            </div>
            <div class="pull-right">
                <img src="<?= site_url() . 'assets/uploads/' . $info->brgy_logo ?>" width="50">
            </div>
            <div class="center-block text-center">
                <p class="m-b-5 font-bold font-12">Republic of the Philippines</p>
                <p class="m-b-5 font-bold font-10" style="margin-top:-10px; ">Municipality of
                    <?= $info->town . ', ' . $info->province ?></p>
                <p class="m-b-0 font-bold font-12" style="margin-top:-10px;"><?= $info->brgy_name ?></p>
            </div>
        </div>
        <div class="col-md-12">
            <p class="m-b-0 font-bold font-10 text-center">Barangay ID Card No.: <?= $resident->id + 1000000 ?></p>
            <?php if (empty($this->session->flashdata('watermark')) || $this->session->flashdata('watermark') == 'On') : ?>
            <img src="<?= site_url() . 'assets/uploads/' . $id->front ?>" class="img-fluid id_settings"
                style="margin-top:-20px; margin-left:20px" width="200" height="200">
            <?php endif ?>
            <div class="table-responsive m-t-5" style="clear: both;">
                <table class="m-b-5" style="width:100%">
                    <tr>
                        <td style="vertical-align: text-top; padding:0">
                            <?php if (empty($resident->picture)) : ?>
                            <img class="img-fluid b-all m-t-5" width="100" alt="Resident"
                                src="<?= site_url() ?>assets/img/person.png" />
                            <?php else : ?>
                            <img class="img-fluid b-all" width="100" alt="Resident"
                                src="<?= preg_match('/data:image/i', $resident->picture) ? $resident->picture : site_url() . 'assets/uploads/resident_profile/' . $resident->picture ?>" />
                            <?php endif ?>
                        </td>
                        <td style="padding:0">
                            <p class="font-10" style="font-size: 10px">LAST NAME: <span
                                    class="font-bold"><?= strtoupper($resident->firstname ?? '') . ' ' . strtoupper($resident->suffix) ?></span>
                                <span class="font-bold"><?= strtoupper($resident->lastname ) ?></span>
                            </p>
                            <p class="font-10" style="margin-top:-9px;">FIRST NAME: <span
                                    class="font-bold"><?= strtoupper($resident->firstname ?? '') . ' ' . strtoupper($resident->suffix) ?></span>
                            </p>
                            <p class="font-10" style="margin-top:-9px;">MIDDLE NAME: <span
                                    class="font-bold"><?= strtoupper($resident->middlename ?? '') ?></span></p>
                            <p class="font-10" style="margin-top:-9px;">GENDER: <span
                                    class="font-bold"><?= strtoupper($resident->gender ?? '') ?></span></p>
                            <p class="font-10" style="margin-top:-9px;">BIRTHDATE: <span
                                    class="font-bold"><?= date('F d, Y', strtotime($resident->birthdate ?? '')) ?></span>
                            </p>
                            <p class="font-10" style="margin-top:-9px;">BIRTHPLACE: <span
                                    class="font-bold"><?= strtoupper($resident->birthplace ?? '') ?></span></p>
                            <p class="font-10" style="margin-top:-9px;">CIVIL STATUS: <span
                                    class="font-bold"><?= strtoupper($resident->civilstatus ?? '') ?></span></p>
                        </td>
                    </tr>
                </table>

                <p class="m-b-5 font-10">ADDRESS:</p>
                <p class="m-b-5 font-10 font-bold" style="margin-top:-5px;line-height: 1;">
                    <?= strtoupper($house->house_number . ' ' . $resident->purok . ' ' . $resident->address) ?></p>
            </div>

        </div>
    </div>
    <div class="m-t-20" id="backpage">

        <div class="col-md-12" style="position:relative">
            <img src="<?= site_url() . 'assets/uploads/' . $id->back ?>" class="img-fluid id_settings m-t-10"
                width="200" height="200">
            <div class="table-responsive" style="clear: both;">
                <table class="m-b-10" style="width:100%">
                    <tr>
                        <td style="padding:0">
                            <p class="m-b-0" style="font-size: 10px">CITIZENSHIP:</p>
                            <p class="m-b-0 font-bold" style="margin-top:-2px;font-size: 11px; line-height: 1;">
                                <?= strtoupper($resident->citizenship ?? '') ?></p>
                            <p class="m-b-0" style="font-size: 10px">OCCUPATION:</p>
                            <p class="m-b-0 font-bold" style="margin-top:-2px;font-size: 11px; line-height: 1;">
                                <?= strtoupper($resident->occupation ?? '') ?></p>
                            <p class="m-b-0" style="font-size: 10px">BLOOD TYPE:</p>
                            <p class="m-b-0 font-bold" style="margin-top:-2px;font-size: 11px; line-height: 1;">
                                <?= strtoupper($resident->blood ?? '') ?></p>
                            <p class="m-b-0" style="font-size: 10px; line-height: 1;">DATE ISSUED:</p>
                            <p class="m-b-10 font-bold" style="margin-top:0px;font-size: 11px; line-height: 1;">
                                <?= date('d F Y') ?></p>
                            <p class="m-b-20" style="font-size: 10px; line-height: 1;">AUTHENTICATED BY:</p>
                            <div style="position:relative">
                                <?php if (empty($this->session->flashdata('signature')) || $this->session->flashdata('signature') == 'On') : ?>
                                <img src="<?= site_url() . '/assets/uploads/' . $certs->signature ?>"
                                    class="m-t-40 m-b-0" width="60" style="position:absolute; top:-55px; left:20%">
                                <?php endif ?>
                                <p class="m-b-5 font-bold" style="margin-top:0px;font-size: 11px; line-height: 1;">HON.
                                    <?= $capt->name ?></p>
                                <p class="m-b-5 m-l-10" style="font-size: 10px; line-height: 1;">PUNONG BARANGAY</p>
                            </div>

                        </td>
                        <td style="vertical-align: bottom;padding:0">
                            <img style="z-index:2;" class="b-all" id="qrcode" src="<?= $qrCode ?>" width="140">
                        </td>
                    </tr>
                </table>
                <p class="m-b-0 font-10">IN CASE OF EMERGENCY:</p>
                <p class="m-b-0 font-10" style="margin-top:0;line-height: 1;">NAME:
                    <b><?= $this->session->flashdata('name') ?></b>
                </p>
                <p class="m-b-0 font-10" style="margin-top:0;line-height: 1;">CONTACT:
                    <b><?= $this->session->flashdata('number') ?></b>
                </p>
                <p class="m-b-0 font-10" style="margin-top:0;line-height: 1;">ADDRESS:
                    <b><?= $this->session->flashdata('address') ?></b>
                </p>
                <div class="text-center" style="width:100px; display: block;  margin-left: auto; margin-right: auto;">
                    <p class="m-t-15 font-10 text-center"
                        style="border-top: 1px solid black; margin-top:0;line-height: 1;">Signature</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('resident/modal') ?>