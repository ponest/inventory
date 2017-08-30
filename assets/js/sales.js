/**
 * Created by ONEST on 10/6/2016.
 */

function get_selected_sales(){
    var selected = $('#choose').val();
    var link =  "get_selected_sales/"+selected;
    $.ajax({
        url : link,
        dataType : "html",
        success : function(result){
            $('#sell_display').html(result);
        }
    });
}