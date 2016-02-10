var oldAjax = $.ajax;
$.ajax = function () {
    if(typeof arguments[0].data ==="undefined"){
        arguments[0].data = new Object();
    }
    var el = jQuery("[b_id^=u_]");
    arguments[0].data['b_id'] = el.attr('b_id');
    arguments[0].data['b_id_em'] = el.attr('em');
    return oldAjax.apply($, arguments);
}

$(document).ajaxComplete(function (event, xhr, settings) {
    if (xhr.status == "401") {
        //window.location.href = "/";
    }
});
function SubmitContactForm(id_widget) {
    var Data = new Object();
    jQuery("#" + id_widget + " .a_element").each(function (index) {
        Data[jQuery(this).attr('id')] = jQuery(this).val();
    });

    jQuery.ajax({
        type: "POST",
        url: "/Ajax/SubmitContactForm",
        data: Data,
        beforeSend: function () {
        },
        success: function (data) {

            if (data.success) {
                destroy_modal(id_widget);
                var modal = construct_modal(data.ui_id, data.title, data.content, data.buttons);
                modal.modal('show');
            }
        },
        error: function () {
        }
    });
}
/**
 * Created by adnanechaabi on 15-05-11.
 */


function OpenContactForm(old_ui_id) {
    if (typeof old_ui_id !== undefined) {
        destroy_modal(old_ui_id);
    }

    jQuery.ajax({
        type: "POST",
        url: "/Ajax/OpenContactForm",
        data: {},
        beforeSend: function () {
        },
        success: function (data) {

            if (data.success) {
                var modal = construct_modal(data.ui_id, data.title, data.content, data.buttons);
                modal.modal('show');
            }


        },
        error: function () {
        }
    });
}
