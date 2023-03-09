<div class="white-box">
    <h4 class="box-title">Resident Information</h4>
    <form method="POST" enctype="multipart/form-data" id="resident-form">
        <input type="hidden" name="size" value="1000000">
        <div class="row m-t-30">
            <div class="col-md-4 col-sm-12">
                <div class="text-center">
                    <div id="my_camera">
                        <input name="img" accept="image/*" type="file" class="dropify" data-height="250" id="input-file-now-custom-1" data-default-file="<?= site_url() ?>assets/img/person.png" />
                    </div>
                </div>
                <div class="row text-center m-b-40 m-t-10">
                    <button class="btn btn-danger waves-effect btn-rounded waves-light" type="button" id="open_cam" data-toggle="tooltip" data-original-title="Open Camera"> <i class="fa fa-camera"></i> </button>
                    <button type="button" class="btn btn-primary waves-effect btn-rounded waves-light" onclick="save_photo()" data-toggle="tooltip" data-original-title="Capture"><i class="fa fa-crosshairs"></i></button>
                </div>
                <div id="profileImage">
                    <input type="hidden" name="profileimg">
                </div>
                <div class="form-group">
                    <label class="control-label">National ID No.</label>
                    <input type="text" class="form-control" name="national" placeholder="Enter National ID No.">
                </div>
                <div class="form-group">
                    <label class="control-label">Citizenship</label>
                    <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship">
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Firstname</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Middlename</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Lastname</label>
                            <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Suffix</label>
                            <input type="text" class="form-control" placeholder="Enter Suffix" name="suffix" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Alias</label>
                            <input type="text" class="form-control" placeholder="Enter Alias" name="alias" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Gender</label>
                            <select class="form-control" name="gender">
                                <option disabled selected value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Place of Birth</label>
                            <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Birthdate</label>
                            <input type="date" class="form-control" id="bdate" onchange="getAge()" placeholder="Enter Birthdate" name="bdate" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Civil Status</label>
                            <select class="form-control" name="cstatus">
                                <option disabled selected>Select Civil Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Widow">Widow</option>
                                <option value="Common Law">Common Law</option>
                                <option value="Single Parent">Single Parent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Voters Status</label>
                            <select class="form-control vstatus" name="vstatus">
                                <option disabled selected>Select Voters Status</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">PWD?</label>
                            <select class="form-control" name="pwd">
                                <option disabled selected>Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email"">
                        </div>
                    </div>
                    <div class=" col-md-6">
                            <div class="form-group">
                                <label class="control-label">Contact Number</label>
                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Occupation</label>
                                <select class="form-control" name="occupation">
                                    <option disabled selected>Select Occupation</option>
                                    <?php foreach ($occupation as $row) : ?>
                                        <option value="<?= $row->occupation_name ?>"><?= $row->occupation_name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Employer Name</label>
                                <input type="text" class="form-control" placeholder="Enter Employer Name" name="employer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Select House Number</label>
                        <select class="form-control" id="select2" name="house_no" require style="width:85%;"></select>
                        <button type="button" data-toggle="modal" data-target="#addHouse" class="btn btn-sm btn-rounded waves-effect waves-light btn-info"> <i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Family Relation</label>
                        <input type="text" class="form-control" placeholder="Enter Family Relation" name="relation">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Purok</label>
                        <select class="form-control" name="purok">
                            <option disabled selected>Select Purok Name</option>
                            <?php foreach ($purok as $row) : ?>
                                <option value="<?= ucwords($row['purok_name']) ?>"><?= $row['purok_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Address</label>
                <textarea class="form-control" name="address" required placeholder="Enter Street, Building Number, Purok/Sitio, barangay, Town, Province"></textarea>
            </div>
            <h6 class="font-bold">Other Details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 text-left mt-sm-1">SSS No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter SSS No." name="sss">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">TIN No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter TIN No." name="tin">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Precinct No.</label>
                        <div class="col-lg-10">
                            <select class="form-control form-control-sm" name="precinct">
                                <option disabled selected>Select Precinct No</option>
                                <?php foreach ($precinct as $row) : ?>
                                    <option value="<?= ucwords($row['precinct_name']) ?>"><?= $row['precinct_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">GSIS No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter GSIS No." name="gsis">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">PAGIBIG No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter PAGIBIG No." name="pagibig">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Philhealth No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter Philhealth No." name="philhealth">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label" class="col-lg-2 mt-sm-1 text-left">Blood Type:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter Blood Type" name="blood">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions m-t-30">
                <button class="btn btn-success waves-effect waves-light" id="createResident"> <i class="fa fa-check"></i> Save</button>
                <a type="button" href="<?= site_url('resident') ?>" class="btn btn-default waves-effect waves-light">Cancel</a>
            </div>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="addHouse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <div class="alert alert-success" style="display:none" id="success1"><i class="fa fa-check"></i> <span id="msg1"></span></div>
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