<p class="m-t-40" style="text-indent: 40px; font-size: 15px;">
    This is to certify that
    <b><?= strtoupper($resident->firstname . ' ' . $resident->middlename . ' ' . $resident->lastname . ' ' . $resident->suffix) ?></b>,
    of legal age, <?= ucwords($resident->gender ?? '') ?>, <?= ucwords($resident->civilstatus ?? '') ?>,
    <?= ucwords($resident->citizenship ?? '') ?> and resident of
    <?= ucwords($house->house_number . ' ' . $resident->purok . ' ' . $resident->address) ?> for more than
    <?= $this->session->flashdata('years') ?>
    years now.
</p>
<p style="text-indent: 40px; font-size: 15px;">
    This certification is issued upon
    <?= $this->session->flashdata('gender') != 'her' ? '<u>his</u>\her' : 'his\<u>her</u>' ?> request for whatever legal
    purpose it may serve.
</p>
<p style="text-indent: 40px; font-size: 15px;">Issued this <?= date('jS') ?> day of <?= date('F') ?>, <?= date('Y') ?>
    at <?= $info->brgy_name . ', ' . $info->town . ', ' . $info->province ?>.</p>
<div style="margin-bottom:50px"></div>