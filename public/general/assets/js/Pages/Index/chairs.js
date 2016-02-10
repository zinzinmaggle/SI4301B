/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var oTable;
jQuery(document).ready(function() {
    oTable = $('#Chairs_table').dataTable({
        "language": {
            "url": "/js/languages/datatable/" + language + ".json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/Ajax/getChairs",
            "type": "POST"
        },
        "sPaginationType": "four_button",
        "aoColumnDefs": [{
            "aTargets": [0]
        }],
        "pagingType": "full_numbers",
        "aaSorting": [
            [0, 'desc']
        ],
        "aLengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "iDisplayLength": 10
    });
    $('#Chairs_table_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
// modify table search input
    $('#Chairs_table_wrapper .dataTables_length select').addClass("m-wrap small");

});


