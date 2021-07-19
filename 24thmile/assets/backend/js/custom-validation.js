 
$(document).ready(function() {

	//validation for add Company form
	$("#company_add_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"company_name": { 
				required: true,
			},
			"company_description": {
				required: true,  
			}
			
		},
		messages: {
			"company_name": { 
				required:'Please enter company name.' 
			},
			"company_description": {
				required: 'Please enter company description.' 
			} 
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});

	//validation for add Contract form
	$("#contract_add_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"contract_type": { 
				required: true,
			}			
		},
		messages: {
			"contract_type": { 
				required:'Please enter Contract name.' 
			}
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});


	//validation for add designation form
	$("#container_add_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"container_type": { 
				required: true,
			}
			
		},
		messages: {
			"container_type": { 
				required:'Please enter Container name.' 
			}
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});


	//validation for edit company form
	$("#company_edit_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"company_name": { 
				required: true,
			},
			"company_description": {
				required: true,  
			}
			
		},
		messages: {
			"company_name": { 
				required:'Please enter company name.' 
			},
			"company_description": {
				required: 'Please enter company description.' 
			} 
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});

	//validation for edit container form
	$("#container_edit_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"company_name": { 
				required: true,
			},
			"company_description": {
				required: true,  
			}
			
		},
		messages: {
			"company_name": { 
				required:'Please enter company name.' 
			},
			"company_description": {
				required: 'Please enter company description.' 
			} 
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});

	//validation for edit contract form
	$("#contract_edit_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"contract_type": { 
				required: true,
			}
		},
		messages: {
			"contract_type": { 
				required:'Please enter contract name.' 
			}
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
			error.insertAfter(element);
		}
		}
	});


	//validation for add Deliver term form
	$("#deliverterm_add_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"deliverterm_name": { 
				required: true,
			},
			"deliverterm_description": {
				required: true,  
			}
			
		},
		messages: {
			"deliverterm_name": { 
				required:'Please enter deliver term name.' 
			},
			"deliverterm_description": {
				required: 'Please enter deliver term description.' 
			} 
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});


	//validation for edit delivery term form
	$("#deliverterm_edit_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"deliverterm_name": { 
				required: true,
			},
			"deliverterm_description": {
				required: true,  
			}
			
		},
		messages: {
			"deliverterm_name": { 
				required:'Please enter deliver term name.' 
			},
			"deliverterm_description": {
				required: 'Please enter deliver term description.' 
			} 
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});


	//validation for add mode form
	$("#mode_add_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"mode_type": { 
				required: true,
			}			
		},
		messages: {
			"mode_type": { 
				required:'Please enter mode type.' 
			}
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});


	//validation for edit mode form
	$("#mode_edit_form").validate({
		onfocusout: function (element) { 
	        $(element).valid();
	    },
		rules: {
			"mode_type": { 
				required: true,
			}			
		},
		messages: {
			"mode_type": { 
				required:'Please enter mode type.' 
			}
		},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
		
	});

});