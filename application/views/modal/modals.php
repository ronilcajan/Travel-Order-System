<?php
$query = $this->db->query("SELECT * FROM barangay_info WHERE id=1");
$row = $query->row();

$query1 = $this->db->query("SELECT * FROM system_info WHERE id=1");
$ss = $query1->row();

$query2 = $this->db->query("SELECT * FROM cert_settings WHERE id=1");
$certs = $query2->row();

$sess = $this->ion_auth->user()->row();
?>

<!-- Modal -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-light bg-danger error-msg" style="display:none"></div>
                <form method="POST" id="change-pass-form" action="<?= site_url('auth/change_password') ?>">
                    <div class="form-group">
                        <label>Old Password:</label>
                        <input type="password" class="form-control" id="oldpass" placeholder="Enter Old Password"
                            name="old" required>
                        <span toggle="#oldpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>New Password</label>
                        <input type="password" id="new_pass" class="form-control" placeholder="Enter New Password"
                            name="new" required>
                        <span toggle="#new_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Confirm Password</label>
                        <input type="password" id="con_pass" class="form-control" placeholder="Confirm Password"
                            name="new_confirm" required>
                        <span toggle="#con_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $sess->id ?>" name="user_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Restore Database</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('settings/restore') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <div class="form-group form-floating-label">
                        <label>Upload Sql file</label>
                        <input type="file" id="input-file-now" accept=".sql" name="backup_file" required
                            class="dropify" />
                    </div>
                    <small class="form-text text-muted">Note: pls upload sql file only.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="restore-btn">Restore</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-light bg-danger error-msg1" style="display:none"></div>
                <form method="POST" enctype="multipart/form-data" action="<?= site_url('auth/change_profile') ?>"
                    id="update-user-form">
                    <input type="hidden" name="size" value="1000000">
                    <div class="text-center">
                        <div id="myprofile3" class="text-center">
                            <input name="avatar" accept="image/*" type="file" class="dropify" data-height="250"
                                id="input-file-now-custom-6"
                                data-default-file="<?= empty($sess->avatar) ? site_url() . 'assets/img/person.png' : site_url() . 'assets/uploads/avatar/' . $sess->avatar ?>" />
                            <input type="hidden" id="profileData"
                                value="<?= preg_match('/data:image/i', $sess->avatar) ? $sess->avatar : null ?>">
                        </div>
                        <div class="row text-center m-b-40 m-t-10">
                            <button class="btn btn-danger waves-effect btn-rounded waves-light" type="button"
                                id="open_cam3" data-toggle="tooltip" data-original-title="Open Camera"> <i
                                    class="fa fa-camera"></i> </button>
                            <button type="button" class="btn btn-primary waves-effect btn-rounded waves-light"
                                onclick="save_photo3()" data-toggle="tooltip" data-original-title="Capture"><i
                                    class="fa fa-crosshairs"></i></button>
                        </div>

                        <div id="profileImage3">
                            <input type="hidden" name="profileimg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Firstname</label>
                                <input type="text" class="form-control" placeholder="Enter Firstname" name="first_name"
                                    required value="<?= $sess->first_name ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Lastname</label>
                                <input type="text" class="form-control" placeholder="Enter Lastname" name="last_name"
                                    required value="<?= $sess->last_name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email Address" name="email" required
                            value="<?= $sess->email ?>">
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