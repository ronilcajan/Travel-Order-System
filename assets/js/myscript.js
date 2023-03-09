$(document).ready(function(){
    
    $(".myadmin-alert .closed").click(function(event) {
        $(this).parents(".myadmin-alert").fadeToggle(350);
        return false;
    });
    /* Click to close */
    $(".myadmin-alert-click").click(function(event) {
        $(this).fadeToggle(350);
        return false;
    });
    $('#restore-btn').click(function(){
        $(".preloader").show();
    });
    $('.dropify').dropify();

    $(".select2").select2(); 
    
    img = $('#picData').val();
    if(!img==''){
        resetPreview('editimg', img,'ResidentImage.jpg');
    }

    profile = $('#profileData').val();
    if(!profile==''){
        resetPreview('avatar', profile,'ProfileImage.jpg');
    }

    $('#importRes').click(function(){
        
        if($('#input-file-now1').val()){
            $(".preloader").show();
        }
    });

    $(".colorpicker").asColorPicker();

    $("#select2").select2({
        placeholder: "Search House Number",
        minimumInputLength: 1,
		allowClear: true,
        ajax: {
            url: SITE_URL+'resident/search_house',
            dataType: 'json',
            delay: 250,
            data: function (data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results:response
                };
            },
            cache: true
        }
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });

    // show password when toggle
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $('#open_cam').click(function(){
        Webcam.attach( '#my_camera' );
    });

    $('#open_cam1').click(function(){
        Webcam.attach( '#myprofile' );
    });

    $('#open_cam2').click(function(){
        Webcam.attach( '#userCam' );
    });
    $('#open_cam3').click(function(){
        Webcam.attach( '#myprofile3' );
    });

    $('.vstatus').change(function(){
        var val = $(this).val();
        if(val=='No'){
            $('.indetity').prop('disabled', 'disabled');
        }else{
            $('.indetity').prop('disabled', false);
        }
    });

    if( $('#bstatus').val() =='Settled'){
        $('#settled').show();
    }
    
    $('#bstatus').change(function(){
        var val = $(this).val();
        if(val=='Settled'){
            $('#settled').show();
        }else{
            $('#settled').hide();
        }
    });
});

$('#summernote').summernote({
    fontNames: ['Calibri', 'Arial Black', 'Comic Sans MS', 'Courier New'],
    tabsize: 2,
    height: 300,
    toolbar: [
        [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
        [ 'table', [ 'table' ] ],
        [ 'insert', [ 'link'] ],
        [ 'view', [ 'undo', 'redo', 'fullscreen', 'help' ] ]
    ]
});

function getAge() 
{
    var today = new Date();
    var birthDate = new Date($('#bdate').val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
    {
        age--;
    }
   
    $('#age').val(age);
}

// Initialize webcam
Webcam.set({
    height: 350,
    image_format: 'jpeg',
    jpeg_quality: 90
});

function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'" width="350" height="350" />';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" value="'+data_uri+'"/>';
    } );
}


function save_photo1() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('myprofile').innerHTML = 
        '<img src="'+data_uri+'" width="350" height="350" />';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}
function save_photo2() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('userCam').innerHTML = 
        '<img src="'+data_uri+'" width="350" height="350" />';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}
function save_photo3() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('myprofile3').innerHTML = 
        '<img src="'+data_uri+'" width="350" height="350" />';
        document.getElementById('profileImage3').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}

function save_photo4() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'" width="350" height="350" />';
        document.getElementById('profileImage4').innerHTML = 
        '<input type="hidden" name="profileimg" value="'+data_uri+'"/>';
    } );
}

//Print function
$(function() {
    $("#print").on("click", function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});

//show picture function
function resetPreview(name, src, fname = '') {
    let input = $('input[name="' + name + '"]');
    let wrapper = input.closest('.dropify-wrapper');
    let preview = wrapper.find('.dropify-preview');
    let filename = wrapper.find('.dropify-filename-inner');
    let render = wrapper.find('.dropify-render').html('');

    input.val('').attr('title', fname);
    wrapper.removeClass('has-error').addClass('has-preview');
    filename.html(fname);

    render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
    preview.fadeIn();
}

function editOfficial(that){
    id = $(that).attr('data-id');
    na = $(that).attr('data-name');
    chair = $(that).attr('data-chair');
    pos = $(that).attr('data-pos');
    start = $(that).attr('data-start');
    end = $(that).attr('data-end');
    status = $(that).attr('data-status');
    avatar = $(that).attr('data-avatar');
    
    $('#off_id').val(id);
    $('#name').val(na);
    $('#chair').val(chair);
    $('#position').val(pos);
    $('#start').val(start);
    $('#end').val(end);
    $('#status').val(status);
    
    if(avatar != ''){
        console.log(avatar);
        resetPreview('off_avatar', 'assets/uploads/avatar/'+avatar,'ProfileImage.jpg');
    }
    
}

function showOfficial(that){
    id = $(that).attr('data-id');   
    check = $(that).attr('data-check');   
    $.ajax({
        type: "POST",
        url: SITE_URL+"officials/show_official",
        dataType: "json",
        data: {id:id, check:check},
        cache: false,
        success: function(response) {
            console.log(response);
            if (response.success == true) {
                alertNotif(response.msg, 'success');
            } else {
               
                alertNotif(response.msg, 'error');
            }
            setTimeout(function(){
                window.location.reload(1);
             }, 3000);
        }
    });
    
}
function editPos(that){
    pos = $(that).attr('data-pos');
    order = $(that).attr('data-order');
    id = $(that).attr('data-id');

    $('#position').val(pos);
    $('#order').val(order);
    $('#pos_id').val(id);
}



function editRelation(that){
    res_id = $(that).attr('data-res');
    rel = $(that).attr('data-rel');

    $('#res_id').val(res_id);
    $('#relation').val(rel);
}

function convertTime(dateTime){
    var dateVal = new Date(dateTime);
    var day = dateVal.getDate().toString().padStart(2, "0");
    var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
    var hour = dateVal.getHours().toString().padStart(2, "0");
    var minute = dateVal.getMinutes().toString().padStart(2, "0");
    var sec = dateVal.getSeconds().toString().padStart(2, "0");
    var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
    var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute) + ":" + (sec) + "." + (ms);
    return inputDate;
}

$("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
