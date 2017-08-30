/**
 * Created by ONEST on 10/6/2016.
 */
function save_reg(type){
    var link = "save_reg/"+type;
    if(type == "reg"){
        $.ajax({
            url : link,
            type: 'post',
            dataType : "html",
            data : $('#reg').serialize(),
            success : function(result){
                $('#form_container').html(result);
            }
        });
    }else if(type == "reset"){
        $.ajax({
            url : link,
            type: 'post',
            dataType : "html",
            data : $('#reset').serialize(),
            success : function(result){
                $('#form_container').html(result);
            }
        });
    }
}
function get_selected_reg(){
    var selected = $('#choose').val();
    var link =  "get_selected_reg/"+selected;
    $.ajax({
        url : link,
        dataType : "html",
        success : function(result){
            $('#form_container').html(result);
        }
    });
}