$(document).ready(function() {
	$("input[name=recurring]").change(function() {
		
		if($(this).val() == 'No') {
			$(".recurringFrequency").addClass('hide');
		} else if($(this).val() == 'Yes') {
			$(".recurringFrequency").removeClass('hide');
		}
	});

	$("#honor").change(function() {
		if($(this).val() == 'yes') {
			$("#honor_name").show();
		} else {
			$("#honor_name").hide();
		}
	});

	$("#matching").change(function() {
		if($(this).val() == 'yes') {
			$("#matching_name").show();
		} else {
			$("#matching_name").hide();
		}
	});

	$("#ack_type").change(function() {
		if($(this).val() == 'ecard') {
			$("#ecard_email").show();
			$("#ack_mail").hide();
		} else if($(this).val() == 'mail') {
			$("#ack_mail").show();
			$("#ecard_email").hide();
		} else {
			$("#ecard_email").hide();
			$("#ack_mail").hide();
		}
	});

	$("#honor_verb").change(function() {
		if($(this).val() == 'In Memory Of') {
			$("#honor_name_label").text('In Memory Of');
		} else {
			$("#honor_name_label").text('Honoree');
		}
	});

	$("#billing_country").change(function() {
		if ( $(this).val() == 'US' ||
		     $(this).val() == 'CA' ||
		     $(this).val() == 'AU' ||
		     $(this).val() == 'IN'   ) {
			//Load the states for the country selected, and hide the country input field if it isn't already hidden. 
				$("#billing_state_input").hide();
				$("#billing_state_dropdown").show();
				$("#billing_state").load("includes/" + $(this).val() + "_states.txt");
		} else {
			//Hide dropdown and show input
			$("#billing_state_input").show();
			$("#billing_state_dropdown").hide();
		}
	});

	$("#ack_country").change(function() {
		if ( $(this).val() == 'US' ||
		     $(this).val() == 'CA' ||
		     $(this).val() == 'AU' ||
		     $(this).val() == 'IN'   ) {
			//Load the states for the country selected, and hide the country input field if it isn't already hidden. 
				$("#ack_state_input").hide();
				$("#ack_state_dropdown").show();
				$("#ack_state").load("includes/" + $(this).val() + "_states.txt");
		} else {
			//Hide dropdown and show input
			$("#ack_state_input").show();
			$("#ack_state_dropdown").hide();
		}
 	
 	$.listen('parsley:field:validate', function () {
          validateFront();
        });

        $('#donateForm .btn').on('click', function () {
          $('#donateForm').parsley().validate();
          validateFront();
        });

        var validateFront = function () {
          if (true === $('#donateForm').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
          } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
          }
        };
	});

});