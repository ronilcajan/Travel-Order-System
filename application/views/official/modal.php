<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title text-white" id="exampleModalLabel">Create Official</h5>
            </div>
            <form method="POST" action="<?= site_url('officials/save_official') ?>" enctype="multipart/form-data" id="create_official_form">
                <div class="modal-body">
                    <input type="hidden" name="size" value="1000000">
                    <div class="form-group">
                        <label class="control-label">Officer Avatar</label><br>
                        <input name="off_avatar" accept="image/*" type="file" class="dropify" data-height="250" data-default-file="<?= site_url() . '/assets/img/person.png' ?>" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Term Start</label>
                                <input type="date" class="form-control" name="start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Term End</label>
                                <input type="date" class="form-control" name="end" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" class="form-control" placeholder="Enter Fullname" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" required name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chairmanship</label>
                                <select class="form-control" required name="chair">
                                    <option disabled selected>Select Official Chairmanship</option>
                                    <?php foreach ($chair as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" required name="position">
                                    <option disabled selected>Select Official Position</option>
                                    <?php foreach ($pos as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['position'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="pos_id" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
            </div>
            <form method="POST" action="<?= site_url('officials/update_official') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="size" value="1000000">
                    <div class="form-group">
                        <label class="control-label">Officer Avatar</label><br>
                        <input name="off_avatar" accept="image/*" type="file" id="avat" class="dropify" data-height="250" data-default-file="<?= site_url() . 'assets/img/person.png' ?>" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Term Start</label>
                                <input type="date" class="form-control" id="start" name="start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Term End</label>
                                <input type="date" class="form-control" id="end" name="end" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Fullname" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" required name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chairmanship</label>
                                <select class="form-control" id="chair" required name="chair">
                                    <option disabled selected>Select Official Chairmanship</option>
                                    <?php foreach ($chair as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" id="position" required name="position">
                                    <option disabled selected>Select Official Position</option>
                                    <?php foreach ($pos as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['position'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="off_id" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>