function updatePassword(obj, catID) {

    var newPassword = jQuery(obj).parent().parent().find('.hidden-input #new-password').val();

    jQuery.post(the_ajax_script.ajaxurl,
    {
      action: "protector_update_password",
      category_id: catID,
      new_password: newPassword,

    },
    function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
        
        if (data == 0) alert('Password updated!');
        else alert('Some error...');
        
        location.reload();
    });
}

function deletePassword(catID) {
    
    jQuery.post(the_ajax_script.ajaxurl,
    {
      action: "protector_update_password",
      category_id: catID,
      new_password: '', // empty password

    },
    function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
        
        if (data == 0) alert('Password deleted!');
        else alert('Some error...');
        
        location.reload();
    });    
}