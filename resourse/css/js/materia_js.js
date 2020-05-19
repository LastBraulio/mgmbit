$(document).ready(function() {
			var ind;
            var datatable = $('#dataTable').DataTable({
                ajax: "materia.php?m=ajaxtabla",
                columns: [
                    {data:"0"},
                    {data:"1"},
                    {data:"2"},
                    {data:"3"},
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
           // $('#myModal2').modal({show:true});
			$('.openBtn').on('click',function(){
				$('#myModal').modal({show:true});
			});
			// PARA VISUALIZAR LOS DATOS
			$("#dataTable").on('click','#view',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				 $('.modal2').load('materia.php?m=view1&id='+col1,function(){
					$('#myModal2').modal({show:true});
				});

			});
			// Para ACTUALIZAR CAMPOS
			$("#dataTable").on('click','#edit',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				$.get('materia.php?m=edit1&id='+col1,function(data){
					console.table(data);
					$("#InputNombrecss_u").attr("value",data['nom_materia']);
					$("#InputPuntajecss_u").attr("value",data['puntaje']);
					$("#InputDescripcioncss_u").attr("value",data['descripcion']);
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
					  url:"materia.php?m=update1_m",
					  type: "POST",
					  data: {
						InputNombrecss_u: $("#InputNombrecss_u").val(),
						InputPuntajecss_u: $("#InputPuntajecss_u").val(),
						InputDescripcioncss_u: $("#InputDescripcioncss_u").val(),
						InputID: ind
					  }
				})
				.done(function( data, xhr ) {
					//console.log(data["valor"]);
					console.table(data);
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
					  url:"materia.php?m=insert_m",
					  type: "POST",
					  data: {
						InputNombrecss: $("#InputNombrecss").val(),
						InputPuntajecss: $("#InputPuntajecss").val(),
						InputDescripcioncss: $("#InputDescripcioncss").val()
					  }
				})
				.done(function( data, xhr ) {
					console.log(data["msn"]);
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
						$.notify("Ocurrio algo! verifique si inserto datos "+ data["msn"] , {
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
			//timepicket js
			/*$('#InputFechacss').datepicker({
				uiLibrary: 'bootstrap4',
				format: 'yyyy-mm-dd HH:MM',
				footer: true, 
				modal: true
			});
			// fin timerpicket  get_tipo_cliente
			
			//timepicket js InputFechacss_u
			$('#InputFechacss_u').datepicker({
				uiLibrary: 'bootstrap4',
				format: 'yyyy-mm-dd HH:MM',
				footer: true, 
				modal: true
			});*/
			// fin timerpicket  get_tipo_cliente
			
			// combobox js
			/*$.ajax({
				type: "GET",
				url: 'clientes.php?m=get_tipo_cliente', 
				dataType: "json",
				success: function(data){
				  $.each(data,function(key, registro) {
					$("#InputTipClientcss").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
				  });        
				},
				error: function(data) {
				  alert('error');
				}
			});
			// fin combobox
			
			// combobox 2 InputTipClientcss_u
				$.ajax({
					type: "GET",
					url: 'clientes.php?m=get_tipo_cliente', 
					dataType: "json",
					success: function(data){
					  $.each(data,function(key, registro) {
						$("#InputTipClientcss_u").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
					  });        
					},
					error: function(data) {
					  alert('error');
					}
				});*/
			//
 });