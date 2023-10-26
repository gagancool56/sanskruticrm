function set_datatables(params) {
	// Destroy datatable if already initialize.
	if ($.fn.dataTable.isDataTable("#finder-table")) {
		$("#finder-table").DataTable().clear().destroy();
	}

	$("#finder-table").DataTable({
		// scrollX: true,
		processing: true,
		serverSide: true,
		orderCellsTop: true,
		fixedHeader: true,
		pageLength: 5,
		order: [],
		ajax: {
			url: site_url + "ajax/finder",
			type: "POST",
			data: params,
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false,
			},
		],
		// Setting the url for the click event redirect.
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-url", data.url);
			$(row).attr("onclick", "crm.redirectfinder(this)");
		},
	});
}

// initialize dattable.
$(document).ready(function () {
	$(".custom-dtable").DataTable({ scrollX: true, scrollY: true, });
});
