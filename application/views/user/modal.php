<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-light bg-danger error-msg" style="display:none"></div>
                <form method="POST" action="<?= site_url(uri_string()) ?>" enctype="multipart/form-data" id="user-form">
                    <input type="hidden" name="size" value="1000000">

                    <div class="text-center">
                        <div id="userCam" class="text-center">
                            <input name="avatar" accept="image/*" type="file" class="dropify" data-height="250" id="input-file-now-custom-7" data-default-file="<?= site_url() ?>assets/img/person.png" />
                        </div>
                        <div class="row text-center m-b-20 m-t-10">
                            <button class="btn btn-danger waves-effect btn-rounded waves-light" type="button" id="open_cam2" data-toggle="tooltip" data-original-title="Open Camera"> <i class="fa fa-camera"></i> </button>
                            <button type="button" class="btn btn-primary waves-effect btn-rounded waves-light" onclick="save_photo2()" data-toggle="tooltip" data-original-title="Capture"><i class="fa fa-crosshairs"></i></button>
                        </div>
                        <div id="profileImage">
                            <input type="hidden" name="profileimg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Firstname</label>
                                <input type="text" class="form-control" placeholder="Enter Firstname" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Lastname</label>
                                <input type="text" class="form-control" placeholder="Enter Lastname" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Identity</label>
                                <input type="text" class="form-control" placeholder="Enter Username" name="identity" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group form-floating-label">
                                    <label>User Role</label>
                                    <select class="form-control" name="group" required>
                                        <?php foreach ($this->ion_auth->groups()->result() as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email Address" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Enter Password" name="password" required>
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>