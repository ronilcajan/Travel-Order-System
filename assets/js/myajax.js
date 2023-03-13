function createRes(){
    var formdata = new FormData(document.getElementById("resident-form"));
    $.ajax({
        type: "POST",
        url: SITE_URL+"resident/save_resident",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
            if (response.success == true) {
                $("#resident-form")[0].reset();
                alertNotif(response.msg, 'success');
                
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);

            } else {
                alertNotif(response.msg, 'error');
            }
        }
    });
}
function editRes(){
    var formdata = new FormData(document.getElementById("update-resident-form"));
    $.ajax({
        type: "POST",
        url: SITE_URL+"resident/update_resident",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
            console.log(response.msg)
            if (response.success == true) {
                alertNotif(response.msg, 'success');
                
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000);

            } else {
                alertNotif(response.msg, 'error');
            }
        }
    });
}

function alertNotif(msg,state){
    if(state=='success'){
        $(".alertSuccess").fadeToggle(350);
        $('#msg').html(msg);
    }else{
        $(".alertError").fadeToggle(350);
        $('#alertErrorMessage').html(msg);
    }
    
}

function load_unseen_notification(view = ''){
    $.ajax({
        url: SITE_URL+"request/fetch",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
        $('#notification-msg').html(data.notification);
        if(data.unseen_notification > 0)
        {
            $('.count').html(data.unseen_notification);
        }
        }
    });
}
load_unseen_notification();
$('#notif').click(function(){
    $('.count').html('');
    load_unseen_notification('yes');
});

setInterval(function(){
    load_unseen_notification();
}, 5000);