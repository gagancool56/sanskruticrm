$(document).ready(function () {
	// initialize the plugin
	$("#crm-report-validate").validate({
		submitHandler: function (form) {
			// console.log("form", form);
			crm.show_report();
			return false;
		},
	});
});

$("#crm-report-validate").on("submit", function (e) {
	e.preventDefault();
});

crm.show_report = function () {
	params = new FormData($("#crm-report-validate")[0]);
	$(".grid-report").html('<h1 class="text-center">Processing....</h1>');

	$.ajax({
		url: site_url + "ajax/report",
		type: "POST",
		data: params,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function (response) {
			if (response.success) {
				// console.log(response);
				$(".grid-report").html(response.data);
				// Destroy datatable if already initialize.
				if ($.fn.dataTable.isDataTable(".grid-report-table")) {
					$(".grid-report-table").DataTable().clear().destroy();
				}

				$(".grid-report-table").DataTable({
					dom: "lBfrtip",
					buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
				});
			}
		},
	});
};
