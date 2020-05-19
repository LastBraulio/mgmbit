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
                        defaultContent: '<a id="asignar" class="btn btn-success  btn-sm" ><i class="fas fa-edit">Asignar</i></a>'
                    }
                ],
                "language": {
			      "emptyTable": "No hay Profesores Para Asignar Materias..."
			    }
            });

            //

           /* var datatable2 = $('#dataTable2').DataTable({
                ajax: "profesores.php?m=ajaxtabla_asignados",
                columns: [
                    {data2:"0"},
                    {data2:"1"},
                    {data2:"2"},
                    {data2:"3"},
					{data2:"4"},
					{data2:"5"},
					{data2:"6"},
                    {
                        data: null,
                        defaultContent: '<a id="asignar" class="btn btn-success  btn-sm" ><i class="fas fa-edit">Asignar</i></a>'
                    }
                ]
            });*/

			// PARA VISUALIZAR LOS DATOS
			
			// Para ACTUALIZAR CAMPOS
			$("#dataTable").on('click','#asignar',function(){
				 var currentRow=$(this).closest("tr"); 
				 var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value


				 $("#InputCedulacss").attr("value",currentRow.find("td:eq(0)").text());
				 $("#InputNomcss").attr("value",currentRow.find("td:eq(1)").text());

				 $('#myModal3').modal({show:true});
				
			});
			// ELIMINAR CAMPOS
		
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
					  url:"profesores.php?m=asignar_materias_profesor",
					  type: "POST",
					  data: {
						InputCedulacss: $("#InputCedulacss").val(),
						InputMateriacss: $("#InputMateriacss").val(),
						InputGradocss: $("#InputGradocss").val(),
						InputTipJornadacss: $("#InputTipJornadacss").val()
					  }
				})
				.done(function( data, xhr ) {
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
					$.notify("Asignacion Finalizada "+data["msn"], {
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
			
			// combobox js input InputMateriacss
			$.ajax({
				type: "GET",
				url: 'profesores.php?m=get_materia', 
				dataType: "json",
				success: function(data){
				  $.each(data,function(key, registro) {
					$("#InputMateriacss").append('<option value='+registro.id_materia+'>'+registro.nom_materia+'</option>');
				  });        
				},
				error: function(data) {
				  alert('error');
				}
			});
			// fin combobox
			
			// combobox 2 InputGradocss
				$.ajax({
					type: "GET",
					url: 'profesores.php?m=get_grado', 
					dataType: "json",
					success: function(data){
					  $.each(data,function(key, registro) {
						$("#InputGradocss").append('<option value='+registro.id_grado+'>'+registro.nombre_grado+'</option>');
					  });        
					},
					error: function(data) {
					  alert('error');
					}
				});
				
			//

			// combobox 3 InputTipClientcss_u
				$.ajax({
					type: "GET",
					url: 'profesores.php?m=get_jornada', 
					dataType: "json",
					success: function(data){
					  $.each(data,function(key, registro) {
						$("#InputTipJornadacss").append('<option value='+registro.id_jornada+'>'+registro.descripcion+'</option>');
					  });        
					},
					error: function(data) {
					  alert('error');
					}
				});
				
			//
        });