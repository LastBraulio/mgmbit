$(document).ready(function() {
			var ind;
            var datatable = $('#dataTable').DataTable({
                ajax: "profesores.php?m=ajaxtabla",
                columns: [
                    {data:"0"},
                    {data:"1"},
                    {data:"2"},
                    {data:"3"},
					{data:"4"},
                    {
                        data: null,
                        defaultContent: '<a id="kardes" class="btn btn-success  btn-sm" ><i class="fas fa-edit">Ver Detalles</i></a>'
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
					$("#InputCedulacss_u").attr("value",data['cedula']);
					$("#InputNombrecss_u").attr("value",data['nombre']);
					$("#InputAPcss_u").attr("value",data['apellido_paterno']);
					$("#InputAMcss_u").attr("value",data['apellido_materno']);
					$("#InputEdadcss_u").attr("value",data['edad']);
					$("#InputDircss_u").attr("value",data['direccion']);
					$("#InputOcccss_u").attr("value",data['ocupacion']);
					$("#InputCelcss_u").attr("value",data['celular']);
					$("#InputTelcss_u").attr("value",data['telefono']);
					$("#InputEmailcss_u").attr("value",data['email']);
					$("#InputFechacss_u").attr("value",data['fecha_actual']);
					//$("#InputTipClientcss_u").attr("value",data['nombre_tipo']);
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
						InputCedulacss_u: $("#InputCedulacss_u").val(),
						InputNombrecss_u: $("#InputNombrecss_u").val(),
						InputAPcss_u: $("#InputAPcss_u").val(),
						InputAMcss_u: $("#InputAMcss_u").val(),
						InputEdadcss_u: $("#InputEdadcss_u").val(),
						InputDircss_u: $("#InputDircss_u").val(),
						InputOcccss_u: $("#InputOcccss_u").val(),
						InputCelcss_u: $("#InputCelcss_u").val(),
						InputTelcss_u: $("#InputTelcss_u").val(),
						InputEmailcss_u: $("#InputEmailcss_u").val(),
						InputFechacss_u: $("#InputFechacss_u").val(),
						InputTipClientcss_u: $("#InputTipClientcss_u").val(),
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
						InputCedulacss: $("#InputCedulacss").val(),
						InputNombrecss: $("#InputNombrecss").val(),
						InputAPcss: $("#InputAPcss").val(),
						InputAMcss: $("#InputAMcss").val(),
						InputEdadcss: $("#InputEdadcss").val(),
						InputDircss: $("#InputDircss").val(),
						InputOcccss: $("#InputOcccss").val(),
						InputCelcss: $("#InputCelcss").val(),
						InputTelcss: $("#InputTelcss").val(),
						InputEmailcss: $("#InputEmailcss").val(),
						InputFechacss: $("#InputFechacss").val(),
						InputTipClientcss: $("#InputTipClientcss").val()
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
			});
			// fin timerpicket  get_tipo_cliente
			
			// combobox js
			$.ajax({
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