$(document).ready(function() {
			var ind;
			var opt;
            var datatable = $('#dataTable').DataTable({
                ajax: "usuario.php?m=ajaxtabla",
                columns: [
                    {data:"0"},
                    {data:"1"},
                    {data:"2"},
                    {data:"3"},
                    {
                        data: null,
                        defaultContent: '<a id="edit" class="btn btn-success btn-circle btn-sm" ><i class="fas fa-edit"></i></a>'
                    }
                ],
				dom: 'lBfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
            });
			//$('.openBtn').on('click',function(){
			//	$('#myModal').modal({show:true});
			//});
			// PARA VISUALIZAR LOS DATOS
			/*$("#dataTable").on('click','#view',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				 $('.modal2').load('clientes.php?m=view1&id='+col1,function(){
					$('#myModal2').modal({show:true});
				});

			});*/
			// Para ACTUALIZAR CAMPOS
			$("#dataTable").on('click','#edit',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

				 var nombre = currentRow.find("td:eq(1)").text();

				 var perfil = currentRow.find("td:eq(3)").text();

				if (perfil === '')
				{
						console.log("esta vacio");
						$("#btm_update2").hide(); 
						$("#btm_update").show();

						$("#InputCedulacss_u").attr("value",col1);
						$("#InputNombrecss_u").attr("value",nombre);
						$("#perfil").text(''); 

				}
				else
				{
					console.log("Su campo es "+ perfil);
					$("#btm_update2").show();
					$("#btm_update").hide();
					$("#InputCedulacss_u").attr("value",col1);
					$("#InputNombrecss_u").attr("value",nombre);
					$("#perfil").text(perfil); 
				}

				ind= col1;
				$('#myModal3').modal({show:true});

				/*$.get('usuario.php?m=edit1&id='+col1,function(data){
					// console.table(data);
					if (data) 
					{
						console.log("esta vacio");
						$("#btm_update2").hide(); 
						$("#btm_update").show();

						$("#InputCedulacss_u").attr("value",col1);
						$("#InputNombrecss_u").attr("value",nombre);
					}
					else
					{
						console.log("Su campo es "+ data[0]['nombre_perfil']);
						$("#btm_update2").show();
						$("#btm_update").hide();
						$("#InputCedulacss_u").attr("value",data[0]['cedula']);
						$("#InputNombrecss_u").attr("value",data[0]['nombre']);
					}
					//$("#InputCedulacss_u").attr("value",data[0]['cedula']);
					//$("#InputNombrecss_u").attr("value",data[0]['nombre']);
					//$("#InputAPcss_u").attr("value",data['apellido_paterno']);
					//$("#InputTipClientcss_u").attr("value",data['nombre_tipo']);
					ind= col1;
					$('#myModal3').modal({show:true});
				});*/
				
			});
			// ELIMINAR CAMPOS
			/*$("#dataTable").on('click','#del',function(){
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
			});*/
			//======================================
			//ACTUALIZAR
			$("#btm_update").on('click',function(){
				$.ajax({
					  url:"usuario.php?m=update1",
					  type: "POST",
					  data: {
						InputCedulacss_u: $("#InputCedulacss_u").val(),
						InputNombrecss_u: $("#InputNombrecss_u").val(),
						InputPerfilcss_u: $("#InputPerfilcss_u option:selected").text(), 
						InpOPT : opt
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


			$("#btm_update2").on('click',function(){
				$.ajax({
					  url:"usuario.php?m=update2",
					  type: "POST",
					  data: {
						InputCedulacss_u: $("#InputCedulacss_u").val(),
						InputNombrecss_u: $("#InputNombrecss_u").val(),
						InputPerfilcss_u: $("#InputPerfilcss_u option:selected").text(), 
						InpOPT : opt
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
			/*$('#btm_guardar').on('click',function(){
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
			});*/
			//timepicket js
			/*$('#InputFechacss').datepicker({
				uiLibrary: 'bootstrap4',
				format: 'yyyy-mm-dd HH:MM',
				footer: true, 
				modal: true
			});*/
			// fin timerpicket  get_tipo_cliente
			
			//timepicket js InputFechacss_u
			/*$('#InputFechacss_u').datepicker({
				uiLibrary: 'bootstrap4',
				format: 'yyyy-mm-dd HH:MM',
				footer: true, 
				modal: true
			});*/
			// fin timerpicket  get_tipo_cliente
			
			// combobox js
			$.ajax({
				type: "GET",
				url: 'usuario.php?m=get_perfiles', 
				dataType: "json",
				success: function(data){
				  $.each(data,function(key, registro) {
					$("#InputPerfilcss_u").append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
				  });        
				},
				error: function(data) {
				  alert('error');
				}
			});

			$('select#InputPerfilcss_u').on('change',function(){
		        opt = $(this).val();
		        alert(opt);
		    });
			// fin combobox
			
			// combobox 2 InputTipClientcss_u
			/*	$.ajax({
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