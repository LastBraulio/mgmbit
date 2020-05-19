$(document).ready(function() {
			var ind;
            var datatable = $('#dataTable').DataTable({
                ajax: "principal.php?m=ajaxtabla",
                columns: [
                    {data:"id"},
                    {data:"country"},
                    {data:"iso2"},
                    {data:"iso3"},
					{data:"noc"},
                    {
                        data: null,
                        defaultContent: '<a id="edit" class="btn btn-success btn-circle btn-sm" ><i class="fas fa-edit"></i></a><a id="view" class="btn btn-success btn-circle btn-sm"><i class="far fa-eye"></i></a><a id="del"  class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a> '
                    }
                ],
				dom: 'lBfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
            });
			$('.openBtn').on('click',function(){
				$('#myModal').modal({show:true});
			});
			// PARA VISUALIZAR LOS DATOS
			$("#dataTable").on('click','#view',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				 $('.modal2').load('clientes.php?m=view1&id='+col1,function(){
					$('#myModal2').modal({show:true});
				});

			});
			// Para ACTUALIZAR CAMPOS
			$("#dataTable").on('click','#edit',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				$.get('clientes.php?m=edit1&id='+col1,function(data){
					$("#InputCountrycss_u").attr("value",data['country']);
					$("#InputISO2css_u").attr("value",data['iso2']);
					$("#InputISO3css_u").attr("value",data['iso3']);
					$("#InputNOCcss_u").attr("value",data['noc']);
					ind= col1;
					$('#myModal3').modal({show:true});
				});
				
			});
			// ELIMINAR CAMPOS
			$("#dataTable").on('click','#del',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				 var seleccion = confirm("Desea Eliminar el Registro N°"+col1);
				if (seleccion)
				{
					$.get('clientes.php?m=delete1&id='+col1,function(data){

					})
					.done(function(data) {
						$.notify(data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
						$('#dataTable').DataTable().ajax.reload();
					})
					.fail(function(jqXHR, textStatus, errorThrown) {
						$.notify("Error Ocurrido++++ status: "+jqXHR+" errorThrown = "+errorThrown+" error "+ data["msn"], {
							newest_on_top: true,
							type: 'danger',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					})
					.always(function(data) {
						$.notify("Eliminación Finalizada | "+data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					});
				}
				else
				{
					$.notify("NO Se Elimino el Registro N°"+col1, {
							newest_on_top: true,
							type: 'warning',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
					});
				}
			});
			//======================================
			//ACTUALIZAR
			$("#btm_update").on('click',function(){
				$.ajax({
					  url:"clientes.php?m=update1",
					  type: "POST",
					  data: {
						InputCountrycss: $("#InputCountrycss_u").val(),
						InputISO2css: $("#InputISO2css_u").val(),
						InputISO3css: $("#InputISO3css_u").val(),
						InputNOCcss: $("#InputNOCcss_u").val(),
						InputID: ind
					  }
				})
				.done(function( data, xhr ) {
					console.log(data["valor"]);
					if (data["valor"] > 0){
						$.notify(data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					}else{
						$.notify("Ocurrio algo! verifique si inserto datos". msn , {
							newest_on_top: true,
							type: 'warning',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					}
					$('#dataTable').DataTable().ajax.reload();
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					$.notify("Error Ocurrido++++ status: "+jqXHR+" errorThrown = "+errorThrown+" error "+ data["msn"], {
							newest_on_top: true,
							type: 'danger',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
				})
				.always(function(data) {
					$.notify("Actualización Finalizada "+data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					$("#myModal3").modal("hide");

				});
				//fin de ajax
			});
			//======================================
			$('#btm_guardar').on('click',function(){
				$.ajax({
					  url:"clientes.php?m=insert",
					  type: "POST",
					  data: {
						InputCountrycss: $("#InputCountrycss").val(),
						InputISO2css: $("#InputISO2css").val(),
						InputISO3css: $("#InputISO3css").val(),
						InputNOCcss: $("#InputNOCcss").val()
					  }
				})
				.done(function( data, xhr ) {
					console.log(data["valor"]);
					if (data["valor"] > 0){
						$.notify(data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					}else{
						$.notify("Ocurrio algo! verifique si inserto datos". msn , {
							newest_on_top: true,
							type: 'warning',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					}
					$('#dataTable').DataTable().ajax.reload();
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					$.notify("Error Ocurrido++++ status: "+jqXHR+" errorThrown = "+errorThrown+" error "+ data["msn"], {
							newest_on_top: true,
							type: 'danger',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
				})
				.always(function(data) {
					$.notify("Inserción Finalizada "+data["msn"], {
							newest_on_top: true,
							type: 'success',
							animate: {
								enter: 'animated zoomInDown',
								exit: 'animated zoomOutUp'
							}
						});
					$("#myModal").modal("hide");
				});
				//fin de ajax
			});
        });