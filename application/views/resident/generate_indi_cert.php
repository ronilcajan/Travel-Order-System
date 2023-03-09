<p class="m-t-40" style="font-size: 15px;">TO WHOM IT MAY CONCERN:</p>
<p style="text-indent: 40px; font-size: 15px;">
    This is to certify that
    <b>
        <?= strtoupper($resident->firstname . ' ' . $resident->middlename . ' ' . $resident->lastname . ' ' . $resident->suffix) ?>
    </b>,
    <?= ucwords($resident->gender ?? '') ?>, <?= floor((time() - strtotime($resident->birthdate)) / 31556926); ?>
    years old,
    <?= ucwords($resident->civilstatus ?? '') ?>, <?= ucwords($resident->citizenship) ?>
    and a duly resident of this barangay belongs to the indigent family.
</p>
<p style="text-indent: 40px; font-size: 15px;">
    This certification is issued upon
    <?= $this->session->flashdata('gender') != 'her' ? '<u>his</u>\her' : 'his\<u>her</u>' ?> request for whatever legal
    purpose it may serve.
</p>
<p style="text-indent: 40px; font-size: 15px;">
    Issued this <?= date('jS') ?> day of
    <?= date('F') ?>, <?= date('Y') ?> at <?= $info->brgy_name . ', ' . $info->town . ', ' . $info->province ?>.</p>
<div style="margin-bottom:50px"></div>