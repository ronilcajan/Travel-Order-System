function editRole(that){
    id = $(that).attr('data-id');
    role = $(that).attr('data-name');
    desc = $(that).attr('data-description');

    $('#role_id').val(id);
    $('#role').val(role);
    $('#description').val(desc);
}