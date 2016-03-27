/**
 * Created by Codizer on 11/29/15.
 *
 * if ( validateGroup(".form-group-validate") == -1 )
 * if ( validateItem(objThis) == -1 )
 *
 */



/*
 *  Config validations
 *  (type, rule and message).
 */

var config = {"validation":[
    {
        "type" : "val_text",
        "rule" : /^([a-z ñáéíóú]{1,250})$/i,
        "msg-danger" : "Solo texto."
    },
    {
        "type" : "val_text_num",
        "rule" : /^([a-z ñáéíóú 0-9 ,]{1,250})$/i,
        "msg-danger" : "Solo texto y números, no carateres especiales."
    },
    {
        "type" : "val_num",
        "rule" : /^([0-9]{1,250})$/i,
        "msg-danger" : "Solo números enteros."
    },
    {
        "type" : "val_double",
        "rule" : /^\d+(\.\d+)?$/,
        "msg-danger" : "Solo números con o sin decimales."
    },
    {
        "type" : "val_date",
        "rule" : /^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/,
        "msg-danger" : "Formato de fecha es DD/MM/AAAA"
    },
    {
        "type" : "val_mail",
        "rule" : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
        "msg-danger" : "Formato de correo no válido."
    },
    {
        "type" : "val_img",
        "rule" : /.(jpeg|jpg|png)$/i,
        "msg-danger" : "Solo imagenes en formato .png o .jpg"
        //
    }
]};


/*
 * Validate by item element
 *
 * @param item
 * @return int
 */
function validateItem( item )
{
    var result = [];

    $( config['validation'] ).each(function(val_key, val_element) {

        if ($(item).hasClass( val_element['type'] )) {

            if (val_element['type'] != 'val_img') {
                $(item).val( $.trim( $(item).val().replace(/\s+/g, ' ') ) );
            }

            if( val_element['rule'].test( $(item).val() ) ) {

                $(item).removeClass( "error-val" );
                $(item).parent().children('.msg-val').hide();
                result.push(true);

            } else {

                $(item).addClass( "error-val" );

                if($(item).parent().children().hasClass('msg-val') )
                    $(item).parent().children('.msg-val').show();
                else
                    $(item).parent().append("<span class='msg-val'>* " + val_element['msg-danger'] + "</span>");

                result.push(false);
            }
        }
    });

    return $.inArray(false, result);
}


/*
 * Validate by group elements
 *
 * @param group
 * @return int
 */

function validateGroup( group )
{
    var result = [];

    $( group ).each(function(key, item) {
        result.push( validateItem( item ) );
    });

    return $.inArray( 0, result);
}