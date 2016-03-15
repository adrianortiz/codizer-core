/**
 * Created by Codizer on 11/29/15.
 */

// Hide alerts
$(".alert").click(function()
{
    $(".alert").fadeOut();
});

/**
 * Alertas globales
 *
 * hideShowAlert('msj-success', 'All good');
 * hideShowAlert('msj-danger', 'Something was grown');
 *
 * @param show 'msj-success' OR 'msj-danger'
 * @param desc content message
 */
function hideShowAlert( show, desc )
{
    $(".alert").click();
    $('#' + show + '-state').html(desc);
    $('#' + show).fadeIn();

    var intervaloId;
    clearTimeout(intervaloId);
    intervaloId = setTimeout(function(){
        $(".alert").fadeOut();
    }, 8000);
}
