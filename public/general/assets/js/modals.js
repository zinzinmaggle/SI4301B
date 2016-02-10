function construct_modal(ui_id, title, content, buttons) {
    jQuery("#" + ui_id).remove();
    var modal = jQuery("<div/>").attr('id', ui_id).addClass('modal fade ');
    var modal_dialog = jQuery("<div/>").addClass('');
    var modal_content = jQuery("<div/>").addClass('modal-content');
    var modal_header = jQuery("<div/>").addClass('modal-header').append('<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>').append('<h4 class="modal-title">' + title + '</h4>');
    var modal_body = jQuery("<div/>").addClass('modal-body padding15 paddingB0').append(content);
    var modal_footer = jQuery("<div/>").addClass('modal-footer text-right').append(buttons);
    modal.append(modal_dialog.append(modal_content.append(modal_header).append(modal_body).append(modal_footer)));
    modal.on('hidden.bs.modal', function () {
        jQuery(this).html("");
        jQuery(this).remove();
    });
    return modal;
}

function destroy_modal(ui_id) {
    jQuery('#' + ui_id).modal('hide');
    jQuery("#" + ui_id).html('');
}