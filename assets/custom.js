$(".panelactions").on("click", function () {
	const urlParams = new URLSearchParams(window.location.search);
	var params = {};
	params.method = urlParams.get("method");
	params.type = $(this).data("type");
	params.knavid = $(this).data("knavid");
	params.formid = $(this).data("formid");

	switch (params.type) {
		case "add":
			break;
		case "revise":
			window.location.href = current_url;
			break;
		case "save":
			$("#crm-validate").submit();
			break;
		case "find":
			// crm.finder(params);
			$("#finder-modal").modal("show");
			set_datatables(params);
			break;
		case "cancel":
			window.location.href = previous_url;
			break;
	}
});

crm.save_form = function () {
	const urlParams = new URLSearchParams(window.location.search);
	var params = {};
	params.method = urlParams.get("method");
	params.type = $(this).data("type");
	params.knavid = $(this).data("knavid");
	params.formid = $(this).data("formid");
	params.data = new FormData($("#crm-validate")[0]);
	crm.post(params);
};

// Finder START.
crm.finder = function (params) {
	console.log("params", params);
	$.ajax({
		url: site_url + "ajax/finder",
		type: "POST",
		data: params,
		dataType: "JSON",
		success: function (response) {
			if (response.success) {
				console.log(response);
				$("#finder-modal").find(".modal-title").html(response.heading);
				$("#finder-modal").find("#finder-table").html(response.data);
				$("#finder-modal").modal("show");
			}
			console.log(response);
		},
	});
};
// Finder END.

crm.post = function (params, returnresponse = false) {
	console.log("params", params);
	var rresponse;
	var async = returnresponse ? false : true;
	console.log("aynsc", async);
	$.ajax({
		url: site_url + "ajax/crmaction",
		type: "POST",
		data: params.data,
		async: async,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function (response) {
			console.log("response", response);
			// If return response is set then return the response.
			if (returnresponse) {
				rresponse = response;
			} else {
				if (response.success) {
					crm.scrollToTop();
					$(".form-danger-msg").addClass("hidden");
					$(".form-success-msg").removeClass("hidden").html(response.message);
					setTimeout(function () {
						window.location.href = response.redirecturl;
					}, 2000);
				} else {
					crm.scrollToTop();
					$(".form-danger-msg").removeClass("hidden").html(response.message);
				}
			}
		},
	});

	if (returnresponse) return rresponse;
};

crm.scrollToTop = function () {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
};

// CRM ajax request START.
crm.ajax = function (params, returnresponse = true) {
	console.log("params", params);
	var rresponse;
	var async = returnresponse ? false : true;
	// console.log("aynsc", async);
	$.ajax({
		url: site_url + "ajax/crmajax",
		type: "POST",
		data: params,
		async: async,
		cache: false,
		dataType: "JSON",
		success: function (response) {
			console.log("response", response);
			// If return response is set then return the response.
			if (returnresponse) {
				rresponse = response;
			}
		},
	});

	if (returnresponse) return rresponse;
};
// CRM ajax request END.

//Intializing the view if data in available START.
crm.initview = function () {
	// console.log(crm_viewer);

	// Adding data to single filed START.
	if (typeof crm_viwer !== "undefined" || crm_viewer !== null) {
		$.each(crm_viewer, function (index, value) {
			if (typeof value !== "string") {
				$.each(value, function (index1, value1) {
					var type = $(document).find(
						"[name='" + index + "[" + index1.toUpperCase() + "]']"
					);
					if (typeof type[0] !== "undefined") {
						type.val(value1);
					}
				});
			}
		});
	}
	// Adding data to single filed END.

	if (typeof crm_rowdata !== "undefined" || crm_rowdata !== null) {
		// console.log("crm_rowdata",Object.keys(crm_rowdata));
		// console.log("tr", tr);
		$.each(crm_rowdata, function (index, value) {
			// console.log("rowdata", value);
			crm.createTableRows(value.length);
			$.each(value, function (index1, value1) {
				$.each(value1, function (index2, value2) {
					// console.log(index1);
					// console.log(index2);
					var type = $(document)
						.find("table.crmgrid tr:eq(" + (index1 + 1) + ")")
						.find("[name='" + index2 + "']");
					if (typeof type[0] !== "undefined") {
						type.val(value2);
					}
				});
			});
		});
	}

	// Disable all fields on view mode.
	if (CRM_METHOD == "VIEW") {
		$("#crm-validate :input").each(function (i, v) {
			$(v).attr("readonly", "readonly").attr("disabled", "disabled");
		});
	}
};
//Intializing the view if data in available END.

// Generating Serial No START.
crm.generateSerialNo = function () {
	tbody = $("table.crmgrid tbody");
	// Generating Serial No.
	sr = parseInt(tbody.find("tr:last").find("td:first").text());
	srno = sr + 1;
	return srno;
};
// Generating Serial No END.

// Generating New Row START.
crm.addRow = function () {
	tbody = $("table.crmgrid tbody");
	tr = tbody.find("tr:first");
	trclone = tr.clone();
	sr = crm.generateSerialNo();

	$.each(trclone, function (index, v) {
		$(v).find("td:first").text(srno);
		$(v).find(":input").val("");
	});

	return trclone;
};
// Generating New Row END.

// Creating table rows dynamically to show as grid START.
crm.createTableRows = function (count = 0) {
	// console.log(count);
	for (i = 0; i < count - 1; i++) {
		tbody = $("table.crmgrid tbody");
		tr = tbody.find("tr:first");
		trclone = tr.clone();
		sr = crm.generateSerialNo();

		$.each(trclone, function (index, v) {
			$(v).find("td:first").text(srno);
			$(v).find(":input").val("");
		});

		// console.log(trclone);
		$(tbody).append(trclone);
	}
	// console.log(trows);
	// tbody.append(trows);
};
// Creating table rows dynamically to show as grid END.

crm.redirectfinder = function (that) {
	// console.log($(that).data("url"));
	if (CRM_FINDERINNEWTAB == "Y") {
		window.open($(that).data("url"));
	} else {
		window.location.href = $(that).data("url");
	}
};

$(document).ready(function () {
	crm.initview();
	crm.initDatePicker();

	// initialize the plugin
	$("#crm-validate").validate({
		submitHandler: function (form) {
			console.log("form", form);
			crm.save_form();
			return false;
		},
	});

	// Auto refresh Dashboard after every half n hour START.
	$(function () {
		setInterval(function () {
			if (is_dashboard) {
				location.reload(true);
			}
		}, 1800000);
	});
	// Auto refresh Dashboard after every half n hour END.
});

// Initializing the global date picker START.
crm.initDatePicker = () => {
	$.each($(document).find(".customdatepicker"), function (i, v) {
		$(v).datepicker({ dateFormat: "dd-mm-yy" });
	});
};
// Initializing the global date picker END.

// Login form submit START.
$("form.login-form").submit(function (e) {
	e.preventDefault();
	var params = {};
	params.data = new FormData($(this)[0]);
	var response = crm.post(params, true);
	console.log("response", response);
	if (typeof response !== "undefined") {
		if (response.success) {
			$(this)
				.find(".alert-success")
				.removeClass("hidden")
				.html(response.message);
			setTimeout(function () {
				location.reload(true);
			}, 1000);
		} else {
			$(this)
				.find(".alert-danger")
				.removeClass("hidden")
				.html(response.message);
		}
	}
});
// Login form submit END.

// PrintController START.
$(".printcontroller").click(function () {
	table = $(this).data("table");
	id = $(this).data("id");
	url = site_url + "print/" + table + "/" + id;
	window.open(url);
});

// Dashboard Date range selection START.
$(function () {
	var dateFormat = "dd/mm/yy",
		from = $("#fromdate")
			.datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 3,
				dateFormat: "dd/mm/yy",
			})
			.on("change", function () {
				to.datepicker("option", "minDate", getDate(this));
			}),
		to = $("#todate")
			.datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 3,
				dateFormat: "dd/mm/yy",
			})
			.on("change", function () {
				from.datepicker("option", "maxDate", getDate(this));
			});

	function getDate(element) {
		var date;
		try {
			date = $.datepicker.parseDate(dateFormat, element.value);
		} catch (error) {
			date = null;
		}
		return date;
	}
});

$(document).on("change", "#todate,#fromdate", function () {
	todate = $("#todate").val();
	fromdate = $("#fromdate").val();
	console.log(todate);
	console.log(fromdate);
	// Set session.
	if (
		typeof todate != "undefined" &&
		todate != "" &&
		typeof fromdate != "undefined" &&
		todate != ""
	) {
		$.ajax({
			url: site_url + "ajax/update_session",
			data: { fromdate: fromdate, todate: todate },
			type: "POST",
			success: function (data) {
				console.log("data", data);
				location.reload(true);
			},
		});
	}
});
// Dashboard Date range selection END.
