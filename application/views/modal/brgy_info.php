<?php
$query = $this->db->query("SELECT * FROM barangay_info WHERE id=1");
$row = $query->row();

$query1 = $this->db->query("SELECT * FROM system_info WHERE id=1");
$info = $query1->row();
?>

<!-- Modal -->
<div class="modal fade" id="system" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">System Info</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('settings/updateSystem') ?>" enctype="multipart/form-data"
                    id="system_info_form">
                    <input type="hidden" name="size" value="1000000">
                    <div class="alert alert-danger text-light bg-danger brgy-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <label class="control-label">System Name</label>
                        <input type="text" class="form-control" placeholder="Enter System Name" name="name"
                            value="<?= empty($info->sname) ? null : $info->sname ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">System Acronym</label>
                        <input type="text" class="form-control" placeholder="Enter System Acronym" name="acronym"
                            value="<?= empty($info->acronym) ? null : $info->acronym ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Powered By:</label>
                        <input type="text" class="form-control" name="powered_b"
                            value="<?= empty($info->powered_b) ? null : $info->powered_b ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">System Logo</label><br>
                        <input name="login_bg" accept="image/*" type="file" class="dropify" data-height="250"
                            data-default-file="<?= empty($info->login_bg) ? site_url() . '/assets/uploads/images/login-register.jpg' : site_url() . 'assets/uploads/bg/' . $info->login_bg ?>" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>