<p class="m-t-30 m-b-10">TO WHOM IT MAY CONCERN:</p>
<p class="m-t-0 m-b-0" style="text-indent: 40px; line-height:1.4">This is to CERTIFY that
    <u><b><?= strtoupper($resident->firstname.' '.$resident->middlename.' '.$resident->lastname.' '.$resident->suffix ) ?></b></u>,
    <b><u><?= floor((time() - strtotime($resident->birthdate)) / 31556926) ?></u></b> year/s of age,
    <?= ucwords($resident->civilstatus ?? '') ?>, a <?= ucwords($resident->citizenship ?? '') ?>, a residents of
    <?= ucwords($house->house_number . ' ' . $resident->purok . ' ' . $resident->address) ?>.
</p>

<p class="m-t-10 m-b-0" style="text-indent: 40px; line-height:1.4">
    As per record of this Office, the above-mentioned person whose signature appears below has no Criminal, Civil, or
    Administrative Charges before this office and has good moral
    standing in the community.
</p>

<p class="m-t-10 m-b-0" style="text-indent: 40px; line-height:1.4">
    This certification is issued upon the request of
    <u><b><?= strtoupper($resident->firstname.' '.$resident->middlename.' '.$resident->lastname.' '.$resident->suffix ) ?></b></u>,
    for whatever legal purpose it may serve
    <?= $this->session->flashdata('gender') != 'her' ? '<u>his</u>\her' : 'his\<u>her</u>' ?> best.
</p>

<p class="m-t-10 m-b-0" style="text-indent: 40px; line-height:1.4">
    <b>WITNESS MY HAND AND SEAL</b> this <?= date('jS') ?> day of
    <?= date('F') ?>, <?= date('Y') ?> at <?= $info->brgy_name.', ' .$info->town.', ' . $info->province ?>.
</p>
<div style="margin-bottom:50px"></div>