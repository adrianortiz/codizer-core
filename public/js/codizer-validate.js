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
        "msg-danger" : "Solo se acepta texto"
    },
    {
        "type" : "val_text_num",
        "rule" : /^([a-z ñáéíóú 0-9 ,]{1,250})$/i,
        "msg-danger" : "No caracteres especiales ( - .  )"
    },
    {
        "type" : "val_num",
        "rule" : /^([0-9]{1,250})$/i,
        "msg-danger" : "Solo se acepta números"
    },
    {
        "type" : "val_double",
        "rule" : /^\d+(\.\d+)?$/,
        "msg-danger" : "Solo números o números decimales"
    },
    {
        "type" : "val_date",
        "rule" : /^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/,
        "msg-danger" : "Formato de fecha es DD/MM/AAAA"
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