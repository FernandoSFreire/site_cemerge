$(function() {

	// EXIBIR MODAIS
	$("#btn_add_hospital").click(function(){
		clearErrors();
		$("#form_hospital")[0].reset();
		$("#hospital_img_path").attr("src", "");
		$("#modal_hospital").modal();
	});

	$("#btn_add_membro").click(function(){
		clearErrors();
		$("#form_membro")[0].reset();
		$("#membro_foto_path").attr("src", "");
		$("#modal_membro").modal();
	});

	$("#btn_add_usuario").click(function(){
		clearErrors();
		$("#form_usuario")[0].reset();
		$("#modal_usuarios").modal();
	});

	$("#btn_upload_hospital_img").change(function() {
		uploadImg($(this), $("#hospital_img_path"), $("#hospital_img"));
	});

	$("#btn_upload_membro_foto").change(function() {
		uploadImg($(this), $("#membro_foto_path"), $("#membro_foto"));
	});

	$("#form_hospital").submit(function() {

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_hospital",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErrors();
				$("#btn_save_hospital").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_hospital").modal("hide");
					swal("Sucesso!","Hospital salvo com sucesso!", "success");
					dt_curso.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});

	$("#form_membro").submit(function() {

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_membro",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErrors();
				$("#btn_save_membro").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_membro").modal("hide");
					swal("Sucesso!","Membro salvo com sucesso!", "success");
					dt_membro.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});

	$("#form_usuario").submit(function() {

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_save_usuario",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErrors();
				$("#btn_save_usuario").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErrors();
				if (response["status"]) {
					$("#modal_usuarios").modal("hide");
					swal("Sucesso!","Usuário salvo com sucesso!", "success");
					dt_usuario.ajax.reload();
				} else {
					showErrorsModal(response["error_list"])
				}
			}
		})

		return false;
	});

	$("#btn_your_user").click(function() {

		$.ajax({
			type: "POST",
			url: BASE_URL + "restrict/ajax_get_user_data",
			dataType: "json",
			data: {"user_id": $(this).attr("user_id")},
			success: function(response) {
				clearErrors();
				$("#form_usuario")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				$("#modal_usuarios").modal();
			}
		})

		return false;
	});

	function active_btn_curso() {
		
		$(".btn-edit-curso").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_curso_data",
				dataType: "json",
				data: {"curso_id": $(this).attr("curso_id")},
				success: function(response) {
					clearErrors();
					$("#form_curso")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#curso_img_path").attr("src", response["img"]["curso_img_path"]);
					$("#modal_cursos").modal();
				}
			})
		});

		$(".btn-del-curso").click(function(){
			
			curso_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse curso?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_curso_data",
						dataType: "json",
						data: {"curso_id": curso_id.attr("curso_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_curso.ajax.reload();
						}
					})
				}
			})

		});
	}

	var dt_curso = $("#dt_curso").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_curso",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_curso();
		}
	});

	function active_btn_membro() {
		
		$(".btn-edit-membro").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_membro_data",
				dataType: "json",
				data: {"membro_id": $(this).attr("membro_id")},
				success: function(response) {
					clearErrors();
					$("#form_membro")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#membro_foto_path").attr("src", response["img"]["membro_foto_path"]);
					$("#modal_membro").modal();
				}
			})
		});

		$(".btn-del-membro").click(function(){
			
			membro_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse membro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_membro_data",
						dataType: "json",
						data: {"membro_id": membro_id.attr("membro_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_membro.ajax.reload();
						}
					})
				}
			})

		});
	}

	var dt_membro = $("#dt_time").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_membro",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_membro();
		}
	});

	function active_btn_user() {
		
		$(".btn-edit-user").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "restrict/ajax_get_user_data",
				dataType: "json",
				data: {"user_id": $(this).attr("user_id")},
				success: function(response) {
					clearErrors();
					$("#form_usuario")[0].reset();
					$.each(response["input"], function(id, value) {
						$("#"+id).val(value);
					});
					$("#modal_usuarios").modal();
				}
			})
		});

		$(".btn-del-user").click(function(){
			
			user_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse usuário?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "restrict/ajax_delete_user_data",
						dataType: "json",
						data: {"user_id": user_id.attr("user_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com sucesso", "success");
							dt_usuarios.ajax.reload();
						}
					})
				}
			})

		});
	}

	var dt_usuarios = $("#dt_usuarios").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "restrict/ajax_list_usuario",
			"type": "POST",
		},
		"columnDefs": [
			{ targets: "no-sort", orderable: false },
			{ targets: "dt-center", className: "dt-center" },
		],
		"drawCallback": function() {
			active_btn_user();
		}
	});



})