/**
 * Created by Codizer on 11/29/15.
 */

// Hide alerts
$(".alert").click(function()
{
    $(".alert").fadeOut();
});


function hideShowAlert(show, desc)
{
    $(".alert").click();
    $('#' + show + '-state').html(desc);
    $('#' + show).fadeIn();

    setTimeout( function(){
        $(".alert").fadeOut();
    }, 8000);
}

/*
  hideShowAlert('msj-success', 'All good');
  hideShowAlert('msj-danger', 'Something was grown');
 */
