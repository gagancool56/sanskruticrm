// Lookup Open START
CURRENTLOOKUP = "";
$(document).on("click", ".lookup", function (e) {
	lookuptype = $(this).data("type").toUpperCase();
	setTableHeader(lookuptype);
	CURRENTLOOKUP = $(this).parents(".lookup-container");
});

function setTableHeader(type) {
	$.ajax({
		url: site_url + "LookupController/tableHeader",
		data: { TYPE: type },
		type: "POST",
		dataType: "JSON",
		success: function (data) {
			console.log("data", data);
			$(".lookup-datatable").find("thead").html(data.tableHeader);
			lookupShow();
			initializeLookup(type);
		},
	});
}

function lookupShow() {
	$("#lookup-modal").modal("show");
}
function lookupHide() {
	$("#lookup-modal").modal("hide");
}

function initializeLookup(lookuptype) {
	// Destroy datatable if already initialize.
	if ($.fn.dataTable.isDataTable(".lookup-datatable")) {
		$(".lookup-datatable").DataTable().clear().destroy();
	}

	var table = $(".lookup-datatable").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		orderCellsTop: true,
		fixedHeader: true,
		responsive: true,
		pageLength: 5,
		autoWidth: false,
		order: [],
		ajax: {
			url: site_url + "LookupController",
			type: "POST",
			data: { TYPE: lookuptype },
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false,
			},
		],
		// Setting the url for the click event redirect.
		fnRowCallback: function (row, data, dataIndex) {
			$(row).addClass("lookup-select");
			switch (lookuptype) {
				case "ITEM":
					$(row).attr("data-type", lookuptype);
					$(row).attr("data-itemid", data[1]);
					$(row).attr("data-descr_itemid", data[2]);
					$(row).attr("data-item_rate", data[3]);
					break;
				case "PARTY":
					$(row).attr("data-type", lookuptype);
					$(row).attr("data-partyid", data[1]);
					$(row).attr("data-descr_partyid", data[2]);
					break;
			}
		},
	});
}

// Set data into the input when lookup is selected.
$(document).on("click", ".lookup-select", function () {
	type = $(this).data("type").toUpperCase();
	switch (type) {
		case "ITEM":
			CURRENTLOOKUP.find(".lookup-id").val($(this).data("itemid"));
			CURRENTLOOKUP.find(".lookup-descr").val($(this).data("descr_itemid"));
			CURRENTLOOKUP.parents("tr").find(".rate").val($(this).data("item_rate"));
			lookupHide();
			break;
		case "PARTY":
			CURRENTLOOKUP.find(".lookup-id").val($(this).data("partyid"));
			CURRENTLOOKUP.find(".lookup-descr").val($(this).data("descr_partyid"));
			lookupHide();
			break;
	}
});
