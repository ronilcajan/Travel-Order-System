var minDate, maxDate;
var brg_logo = document.getElementById("brg_logo");
var logo = getBase64Image(brg_logo);
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[0] );

        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
$(document).ready(function() {
        // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });

    var table = $('#revenuetable').DataTable({
        "order": [[ 0, "desc" ]],
        dom: 'Bfrtip',
        responsive: true,
        select: true,
        "columnDefs": [
            {
                "orderable": false,
                "targets": 0
            }
        ],
        "order": [],
        buttons: [
            {
                extend: 'copy',
                text: 'Copy and Paste to Excel',
                columns: [1,2,3,4,5,6],
            },
            {
                extend: 'excel',
                text: 'Save as Excel',
                columns: [1,2,3,4,5,6],
            },
            {
                extend: 'pdf',
                text: 'Save as PDF',
                download: 'open',
                customize: function (doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.defaultStyle.alignment = 'left';
                    doc.styles.tableHeader.alignment = 'left';
                    doc.content.splice(0, 1);
                    doc.pageMargins = [30, 90, 30, 30];
                    doc['header'] = (function (page, pages) {
                        return {
                            table: {
                                //widths: ['100%'],
                                widths: ['auto', 'auto'],
                                headerRows: 0,
                                body: [
                                    [
                                        {
                                            margin: [25, 10, 0, 0],
                                            width: 50,//'auto',
                                            alignment: 'center',
                                            image: 'data:image/png;base64,' +  logo,
                                        },
                                        {
                                            text: 'Barangay Revenues'.toUpperCase(), 
                                            alignment: 'center', 
                                            fontSize: 14, 
                                            bold: true, 
                                            width: 'auto'
                                            , margin: [120, 20, 0, 0]
                                        },
                                    ],
                                ]
                            },
                            layout: 'noBorders',
                            margin: 10
                        }
                    });
                }
            },
            {
                extend: 'print',
                title: 'Barangay Revenues'.toUpperCase(), 
                exportOptions: {
                    columns:[1,2,3,4,5,6],
                },
                customize: function ( win ) {
                    $(win.document.body).find('h1').css('text-align', 'center');
                    $(win.document.body).css( 'font-size', '10pt' ).prepend('<img src="'+brg_logo.src+'" width="60" style="position:absolute; top:10px; left:10px;" />');
                    $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                }
            },
            'pageLength',
            {
                extend: 'colvis',
                columns: [1,2,3,4,5,6],
                text: 'Column Visibility',
            },
            {
                text: 'Delete',
                className: 'bg-danger border-danger text-white',
                action: function ( e, dt, node, config ) {
                    if (document.getElementById('deleteAll').checked){
                        document.getElementById("deleteAll").submit();
                    } else {
                        alert("Please select transaction to be deleted.")
                    }
                }
            }
            
        ]
    });

    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
});