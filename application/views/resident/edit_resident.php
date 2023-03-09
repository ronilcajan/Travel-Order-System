<div class="alert alert-danger error-msg alert-dismissable" style="display:none">
    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
    <div id="display"></div>
</div>

<div class="white-box">
    <h4 class="box-title">Resident Information</h4>
    <form method="POST" enctype="multipart/form-data" id="update-resident-form">
        <input type="hidden" name="size" value="1000000">
        <div class="row m-t-30">
            <div class="col-md-4 col-sm-12">
                <div class="text-center">
                    <div id="my_camera">
                        <input name="editimg" accept="image/*" type="file" class="dropify" data-height="350"
                            id="input-file-now-custom-1"
                            data-default-file="<?= empty($res->picture) ? site_url() . 'assets/img/person.png' : site_url() . 'assets/uploads/resident_profile/' . $res->picture ?>" />
                        <input type="hidden" id="picData"
                            value="<?= preg_match('/data:image/i', $res->picture ?? '') ? $res->picture : null ?>">
                    </div>
                </div>
                <div class="row text-center m-b-40 m-t-10">
                    <button class="btn btn-danger waves-effect btn-rounded waves-light" type="button" id="open_cam"
                        data-toggle="tooltip" data-original-title="Open Camera"> <i class="fa fa-camera"></i> </button>
                    <button type="button" class="btn btn-primary waves-effect btn-rounded waves-light"
                        onclick="save_photo()" data-toggle="tooltip" data-original-title="Capture"><i
                            class="fa fa-crosshairs"></i></button>
                </div>
                <div id="profileImage4">
                    <input type="hidden" name="profileimg">
                </div>
                <div class="row m-b-10">
                    <div class="col-md-4">
                        <div class="radio radio-success">
                            <input type="radio" name="deceased" id="radio1"
                                <?= $res->resident_type == 'Alive' ? 'checked' : null ?> value="Alive">
                            <label class="control-label" for="radio1"> Alive </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="radio radio-danger">
                            <input type="radio" name="deceased" id="radio2"
                                <?= $res->resident_type == 'Deceased' ? 'checked' : null ?> value="Deceased">
                            <label class="control-label" for="radio2"> Deceased </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="radio radio-warning">
                            <input type="radio" name="deceased" id="radio3"
                                <?= $res->resident_type == 'Non-resident' ? 'checked' : null ?> value="Non-resident">
                            <label class="control-label" for="radio3"> Non-resident </label>
                        </div>
                    </div>
                </div>

                <div id="profileImage">
                    <input type="hidden" name="profileimg">
                </div>
                <div class="form-group">
                    <label class="control-label">National ID No.</label>
                    <input type="text" class="form-control" name="national" placeholder="Enter National ID No."
                        value="<?= $res->national_id ?>">
                </div>
                <div class="form-group">
                    <label class="control-label">Citizenship</label>
                    <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship"
                        value="<?= $res->citizenship ?>">
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Firstname</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required
                                value="<?= $res->firstname ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Middlename</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" name="mname"
                                value="<?= $res->middlename ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Lastname</label>
                            <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required
                                value="<?= $res->lastname ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Suffix</label>
                            <input type="text" class="form-control" placeholder="Enter Suffix" name="suffix"
                                value="<?= $res->suffix ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Alias</label>
                            <input type="text" class="form-control" placeholder="Enter Alias" name="alias"
                                value="<?= $res->alias ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Gender</label>
                            <select class="form-control" name="gender">
                                <option disabled value="" <?= $res->gender == '' ? 'selected' : null ?>>Select Gender
                                </option>
                                <option value="Male" <?= $res->gender == 'Male' ? 'selected' : null ?>>Male</option>
                                <option value="Female" <?= $res->gender == 'Female' ? 'selected' : null ?>>Female
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Place of Birth</label>
                            <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace"
                                value="<?= $res->birthplace ?>">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Birthdate</label>
                            <input type="date" class="form-control" onchange="getAge()" id="bdate"
                                placeholder="Enter Birthdate" name="bdate" value="<?= $res->birthdate ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Civil Status</label>
                            <select class="form-control" name="cstatus">
                                <option disabled value="" <?= $res->civilstatus == '' ? 'selected' : null ?>>Select
                                    Civil Status</option>
                                <option value="Single" <?= $res->civilstatus == 'Single' ? 'selected' : null ?>>Single
                                </option>
                                <option value="Married" <?= $res->civilstatus == 'Married' ? 'selected' : null ?>>
                                    Married</option>
                                <option value="Separated" <?= $res->civilstatus == 'Separated' ? 'selected' : null ?>>
                                    Separated</option>
                                <option value="Widowed" <?= $res->civilstatus == 'Widow' ? 'selected' : null ?>>Widow
                                </option>
                                <option value="Widowed" <?= $res->civilstatus == 'Common Law' ? 'selected' : null ?>>
                                    Common Law</option>
                                <option value="Widowed" <?= $res->civilstatus == 'Single Parent' ? 'selected' : null ?>>
                                    Single Parent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Voters Status</label>
                            <select class="form-control vstatus" name="vstatus">
                                <option disabled <?= $res->voterstatus == '' ? 'selected' : null ?>>Select Voters Status
                                </option>
                                <option value="Yes" <?= $res->voterstatus == 'Yes' ? 'selected' : null ?>>Yes</option>
                                <option value="No" <?= $res->voterstatus == 'No' ? 'selected' : null ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">PWD?</label>
                            <select class="form-control" name="pwd">
                                <option disabled <?= $res->pwd == '' ? 'selected' : null ?>>Select Option</option>
                                <option value="Yes" <?= $res->pwd == 'Yes' ? 'selected' : null ?>>Yes</option>
                                <option value="No" <?= $res->pwd == 'No' ? 'selected' : null ?>>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email"" value="
                                <?= $res->email ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Contact Number</label>
                            <input type="text" class="form-control" placeholder="Enter Contact Number" name="number"
                                value="<?= $res->phone ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Occupation</label>
                            <select class="form-control" name="occupation">
                                <option disabled value="" <?= $res->occupation == '' ? 'selected' : null ?>>Select
                                    Occupation</option>
                                <?php foreach ($occupation as $row) : ?>
                                <option value="<?= ucwords($row->occupation_name) ?>"
                                    <?= $res->occupation == $row->occupation_name ? 'selected' : '' ?>>
                                    <?= $row->occupation_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Employer Name</label>
                            <input type="text" class="form-control" placeholder="Enter Employer Name" name="employer"
                                value="<?= $res->employer_name ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Select House Number</label>
                    <select class="form-control" id="select2" name="house_no" require style="width:85%;">
                        <option value="<?= !empty($relation->house_number) ? $relation->house_number : null ?>"
                            selected> <?= !empty($relation->house_number) ? $relation->house_number : null ?> </option>
                    </select>
                    <button type="button" data-toggle="modal" data-target="#addHouse"
                        class="btn btn-sm btn-rounded waves-effect waves-light btn-info"> <i
                            class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Family Relation</label>
                    <input type="text" class="form-control" placeholder="Enter Family Relation" name="relation"
                        value="<?= !empty($relation->relation) ? $relation->relation : null ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Purok</label>
                    <select class="form-control" name="purok">
                        <option disabled value="" <?= $res->purok == '' ? 'selected' : null ?>>Select Purok Name
                        </option>
                        <?php foreach ($purok as $row) : ?>
                        <option value="<?= ucwords($row['purok_name']) ?>"
                            <?= $res->purok == $row['purok_name'] ? 'selected' : '' ?>><?= $row['purok_name'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Address</label>
            <textarea class="form-control" name="address" required
                placeholder="Enter Street, Building Number, Purok/Sitio, barangay, Town, Province"><?= $res->address ?></textarea>
        </div>

        <div class="form-group">
            <label> Blocklisted: </label>
            <div class="row">
                <div class="col-md-1">
                    <div class="radio radio-success">
                        <input type="radio" name="blocklisted" id="rad"
                            <?= $res->blocklisted == 'No' ? 'checked' : null ?> value="No">
                        <label class="control-label" for="rad"> No </label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="radio radio-danger">
                        <input type="radio" name="blocklisted" id="rad1"
                            <?= $res->blocklisted == 'Yes' ? 'checked' : null ?> value="Yes">
                        <label class="control-label" for="rad1"> Yes </label>
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group">
            <label class="control-label">Remarks</label>
            <textarea class="form-control" name="remarks" placeholder="Enter Remarks"><?= $res->remarks ?></textarea>
        </div>
        <h6 class="font-bold m-b-20">Other Details</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 text-left mt-sm-1">SSS No.</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter SSS No." name="sss"
                            value="<?= $res->sss ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">TIN No.</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter TIN No." name="tin"
                            value="<?= $res->tin ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Precinct No.</label>
                    <div class="col-lg-10">
                        <select class="form-control form-control-sm" name="precinct">
                            <option disabled value="" <?= $res->precinct == '' ? 'selected' : null ?>>Select Precinct No
                            </option>
                            <?php foreach ($precinct as $row) : ?>
                            <option value="<?= $row['precinct_name'] ?>"
                                <?= $res->precinct == $row['precinct_name'] ? 'selected' : '' ?>>
                                <?= $row['precinct_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">GSIS No.</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter GSIS No." name="gsis"
                            value="<?= $res->gsis ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">PAGIBIG No.</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter PAGIBIG No."
                            name="pagibig" value="<?= $res->pagibig ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Philhealth No.</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter Philhealth No."
                            name="philhealth" value="<?= $res->philhealth ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Blood Type:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm" placeholder="Enter Blood Type"
                            name="blood" value="<?= $res->blood ?>">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="res_id" value="<?= $res->id ?>">
        <div class="form-actions m-t-30">
            <button class="btn btn-primary waves-effect waves-light" id="residentUpdate"> <i class="fa fa-check"></i>
                Update</button>
            <a type="button" href="<?= site_url('resident') ?>"
                class="btn btn-default waves-effect waves-light">Cancel</a>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="addHouse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">House Number</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="addHouse-form">
                    <div class="alert alert-danger error" style="display:none"></div>
                    <div class="alert alert-success" style="display:none" id="success1"><i class="fa fa-check"></i>
                        <span id="msg1"></span></div>
                    <div class="form-group">
                        <label class="control-label">House Number</label>
                        <input type="text" class="form-control" placeholder="Ex. 0001-A" name="number">
                    </div>
                    <div class="form-group">
                        <label class="control-label">House Info</label>
                        <textarea class="form-control" name="info" required placeholder="Enter House Info"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveHouse">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>