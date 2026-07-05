<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" /> 

<script>
	$(document).ready(function(){
	if(typeof order=='undefined')
		order=[[0,"desc"]];
		
	if(typeof limit=='undefined')
		limit=100;
		
    $('.nice').DataTable({
		"order": order,
		  'iDisplayLength': limit,
		<?php if(direction()=='rtl'){?>
		language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json'
        },
		<?php }?>
        initComplete: function(){
            this.api().columns().every(function(){
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each(function (d,j){
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>