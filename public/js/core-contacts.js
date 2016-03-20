/**
 * Created by Jonathan Lozano on 19/03/2016.
 */
$(document).ready( function() {
    $('#btn-new-contact').click(function () {

        //var id = $(this).data('id');
        //alert(id);
        //$('.right-content-list').append("Que pepe" + id);
        formNewContact();
    });


    function formNewContact(){
        $(".right-content-list").empty();
    }
});