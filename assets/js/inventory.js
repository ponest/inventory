
function get_selected_form(){
    var selected = $('#choose').val();
    var link =  "get_selected_form/"+selected;
    $.ajax({
        url : link,
        dataType : "html",
        success : function(result){
            $('#form_container').html(result);
        }
    });
}