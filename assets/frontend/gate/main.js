// Clone rows for sodet items START.
$(document).on("blur", "#gr_item_details .quantity", function () {
	var tr = $(this).closest(".tr_clone");
	var clone = tr.clone();

	// Generating Serial No.
	tbody = $(this).closest("tbody");
	sr = parseInt(tbody.find("tr:last").find("td:first").text());
	// sr = parseInt(clone.find("td:first").text());
	srno = sr + 1;

	// Clear the all input fields.
	$.each(clone, function (i, v) {
		$(v).find("td:first").text(srno);
		$(v).find(":input").val("");
	});

	tbody.append(clone);
});

// Automatically fill item rate as per the itemid START.
$(document).on("change", ".itemid", function () {
	itemrate = $(this).find(":selected").data("rate");
	$(this).closest("tr").find(".rate").val(itemrate);
});

// Auto calculate amount START.
$(document).on("keyup keypress", ".quantity,.rate,.discount", function () {
	tr = $(this).closest(".tr_clone");
	qty = parseFloat(tr.find(".quantity").val());
	rate = parseFloat(tr.find(".rate").val());
	dis = parseFloat(tr.find(".discount").val());

	rate = isNaN(rate) ? 0 : rate;
	qty = isNaN(qty) ? 0 : qty;
	dis = isNaN(dis) ? 0 : dis;

	totaldis = dis * qty;
	amt = qty * rate;
	tamt = amt - totaldis;
	tr.find(".amount").val(tamt.toFixed(2));

	settotalamount();
});

// Set total amount to main START.
function settotalamount() {
	var totalamt = 0;
	$(".amount").each(function (i, v) {
		amt = parseFloat($(v).val());
		if (typeof amt !== "undefined" && !isNaN(amt)) {
			totalamt += amt;
		}
	});

	$('[name="GR[TOTALAMOUNT]"]').val(totalamt);
}

// Cancel Sale Order.
$(document).on("click", ".cancelso", function () {
	var SOID = $(this).data("id");
	var response = crm.ajax({
		data: {
			TYPE: "cancelso",
			SOID: SOID,
			KNAVID: KNAVID,
			CRM_METHOD: "COMMON",
		},
		returnresponse: true,
	});

	if (typeof response != "undefined") {
		alert(response.message);
		window.location.reload();
	}
});

// Delete grid row.
$(document).on("click", ".crmgrid .deleterow", function () {
	rowCount = 0;
	$(".deleterow").each(function (i, v) {
		rowCount = i;
	});

	if (rowCount > 0 && CRM_METHOD != "VIEW") {
		$(this).closest("tr").remove();
	}

	// Calculate amount again.
	settotalamount();
});
