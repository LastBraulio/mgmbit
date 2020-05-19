$(document).ready(function() {
			var ind;
			var opt;
            var datatable = $('#dataTable').DataTable({
                ajax: "usuario.php?m=ajaxtabla_conectado",
                columns: [
                    {data:"0"},
                    {data:"1"},
                    {data:"2"},
                    {data:"3"},
                    {data:"4"}
                ],
				dom: 'lBfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
            });
        });