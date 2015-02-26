//	IPTheater Javascript

function toTitleCase(str) {
  return str.replace(/\b\w+\b/g, function titleCaseIt(txt) {
  	return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}

function getPicFromName(firstName, lastName, castInfo) {	//	retrieve last year's audition pic from name
	if (!(firstName.length && lastName.length)) {
		return false;
	}
	$.ajax({
		url: 'api.php?firstName=' + firstName + '&lastName=' + lastName + (castInfo ? '&castInfo=true' : ''),
		statusCode: {
			200: function getPicFromNameSuccess(json) {
				$('#headshot, #bio_preview').empty();
				if (json.message === 'SUCCESS') {
					if (json.formattedRole && json.age) {
						$('#bio_preview').append('<img src="' + json.filename + '" alt>')
							.append('<h5><strong>' + firstName + ' ' + lastName + '</strong> (' + json.age + ')<br>' + json.formattedRole + '</h5><hr>')
							.show();
					} else {
						$('#headshot').append('<h4>Welcome back, ' + firstName + '!</h4>')
							.append('<img src="' + json.filename + '" alt>')
							.show();
					}
				}
			}
		}
	});
	return false;
}

function getCitySTFromZip(zip) {	//	auto-fill city & state from zipcode
	$.ajax({
		url: 'http://ziptasticapi.com/' + zip,
		statusCode: {
			200: function getCitySTFromZipSuccess(json) {
				var loc = JSON.parse(json);
				$('input[name="city"]').val(toTitleCase(loc.city));
				$('select[name="state"]').val(loc.state);
			}
		}
	});
	return false;
}

function changeFiltering(filterOption) {	//	AJAX call to change filter
	$.ajax({
		url: 'show_survey_results.php?filtered=' + filterOption,	//	also works as http://iptheater.com/show_survey_results.php?filtered=' + filterOption
		statusCode: {
			200: function changeFilteringSuccess(pageData) {
				$('#results_section').replaceWith($(pageData).find('#results_section'));
			}
		}
	});
	return false;
}

function getPath(theImage) {
	var endPos = theImage.src.lastIndexOf('/') + 1;	//	find the position of the last '/' mark
	var path = theImage.src.substring(0, endPos);	//	the extension of the image
	return path;
}

function getBasicName(theImage) {
	var endPos = theImage.src.lastIndexOf('.');	//	find ending position of the basic name of the image (e.g. before '.png')
	var startPos = theImage.src.lastIndexOf('/') + 1;	//	find start position of the basic name of the image (e.g. after 'images/')
	var basicName = theImage.src.substring(startPos, endPos);	//	the basic name of the image
	return basicName;
}

function getExt(theImage) {
	var startPos = theImage.src.lastIndexOf('.') + 1;	//	find the starting position of the extension (after last '.')
	var extension = theImage.src.substring(startPos);	//	the extension of the image
	return extension;
}

function getAgeFromDOB(dateOfBirth) {
	if(dateOfBirth) {
		var year = Number(dateOfBirth.substr(0, 4));
		var month = Number(dateOfBirth.substr(5, 2)) - 1;
		var day = Number(dateOfBirth.substr(8, 2));
		var today = new Date();
		var age = today.getFullYear() - year;
		if(today.getMonth() < month || (today.getMonth() == month && today.getDate() < day)){
			age--;
		}
	}
	return age || 100;
}

// KNOCKOUT VIEWMODELS
var ipt = {viewModels: {}};
	//	AUDITION FORM
ipt.viewModels.AuditionFormViewModel = new function AuditionFormViewModel() {
	var self = this;

	self.adultAge = ko.observable(18);
	self.grownUpAge = ko.observable(25);

	self.dobMM = ko.observable();
	self.dobDD = ko.observable();
	self.dobYYYY = ko.observable();
	self.dateOfBirth = ko.computed(function dateOfBirth() {
		if(self.dobYYYY() > 0 && self.dobMM() > 0 && self.dobDD() > 0) {
			return ('0000' + parseInt(self.dobYYYY())).slice(-4) + '-' + ('00' + parseInt(self.dobMM())).slice(-2) + '-' + ('00' + parseInt(self.dobDD())).slice(-2);
		} else {
			return false;
		}
	});
	self.auditioneeAge = ko.computed(function auditioneeAge() {
		return getAgeFromDOB(self.dateOfBirth());
	});
};
	//	REGISTRATION FORM
ipt.viewModels.RegistrationFormViewModel = new function RegistrationFormViewModel() {
	var self = this;

	self.adultAge = ko.observable(18);
	self.grownUpAge = ko.observable(25);

	self.dobMM = ko.observable();
	self.dobDD = ko.observable();
	self.dobYYYY = ko.observable();
	self.dateOfBirth = ko.computed(function dateOfBirth() {
		if(self.dobYYYY() > 0 && self.dobMM() > 0 && self.dobDD() > 0) {
			return ('0000' + parseInt(self.dobYYYY())).slice(-4) + '-' + ('00' + parseInt(self.dobMM())).slice(-2) + '-' + ('00' + parseInt(self.dobDD())).slice(-2);
		} else {
			return false;
		}
	});
	self.registrantAge = ko.computed(function registrantAge() {
		return getAgeFromDOB(self.dateOfBirth());
	});
};
	//	BIO FORM
ipt.viewModels.BioFormViewModel = new function BioFormViewModel() {
	var self = this;

	self.firstName = ko.observable();
	self.lastName = ko.observable();
	self.bio = ko.observable();

	self.formIsFilled = ko.computed(function formIsFilled() {
		return self.firstName() && self.lastName() && self.bio();
	});
};
	//	TICKETS
ipt.viewModels.TicketsViewModel = new function TicketsViewModel() {
	var self = this;

	self.order = ko.observableArray([]);
	self.performanceId = ko.observable(false);

	self.addRemoveSeat = function addRemoveSeat(id, section, row, seat, price) {
		var addSeat = true;
		for(var i = 0; i < self.order().length; i++) {
			var t = self.order()[i];
			if(t.id === id) {
				self.order.remove(t);
				addSeat = false;
				break;
			}
		}
		if(addSeat) {
			self.order.push({
				id: id,
				section: section,
				row: row,
				seat: seat,
				price: parseFloat(price) === parseInt(price) ? parseInt(price) : price
			});
		}
	}
}

//	Initialize JQuery on window load
$(function onReady() {
	//	Apply JQuery Rollover on all IMG tags within a container element
	$('.mouseoverAll img').each(function() {
		$(this).addClass('mouseover');
	});
	//	JQuery Rollover!
	$('img.mouseover').each(function() {	//	activate this on images with the class 'mouseover'
		var thisImage = $(this);

		var oldSrc = thisImage.attr('src');	//	non-mouseover src
		var overSrc = getPath(this) + getBasicName(this) + '_over.' + getExt(this);	// (e.g. 'images/myimage_over.png')

		preload = new Image(1,1);	//	preload the overImage
		preload.src = overSrc;

		thisImage.hover(function() {
			overSrc = getPath(this) + getBasicName(this) + '_over.' + getExt(this);	// must be declared again for buttons that change src from other functions
			thisImage.attr('src', overSrc);	//	change to overSrc when mousing over
		}, function() {
			thisImage.attr('src', thisImage.attr('src').replace('_over',''));	// change back to oldSrc when mouse leaves
		});
	});

	// JQuery Rollover Slide Enlarge!
	$('img.enlarge').each(function() {	//	activate this on images with the class 'enlarge'
		var thisImage = $(this);	//	regular size image

		if(getPath(this).indexOf('thumbs/') != -1) {	//	if this is a thumbnail, look in main folder for image
			var bigId = getBasicName(this)	//	id of new image is same as basename of image (just in different folder)
			var bigSrc = getPath(this).replace('thumbs/','') + bigId + '.' + getExt(this);	//	src of big image is similar to regular
			//alert(bigSrc);
		} else {
			var bigId = getBasicName(this);
			var bigSrc = getPath(this) + 'large/' + bigId + '.' + getExt(this);	//	src of big image is similar to regular
		}
		$(document.body).append("<div class='overlarge' id='" + bigId + "'><img src='" + bigSrc + "' alt=''></div>");	//	create a new div with the image in it and append it as a sibling
		var bigImage = $('#' + bigId);	//	we are creating a jQuery reference to the div element even though we don't know its id

		thisImage.hover(function() {
			var pos = thisImage.css('float') === 'none' ? thisImage.offset() : thisImage.position();	//	get the pos (location on screen) of the current image

			bigImage.css('top', pos.top + thisImage.height() + 10).css('left', pos.left).slideDown(300);	//	set position and slide big image down
			thisImage.fadeTo(600, 0.3);	//	fade small image down to 30% opacity
		}, function() {	//	on mouseout
			bigImage.slideUp(300, function() {
				bigImage.css('display','none');	//	make sure it's gone
				bigImage.stop(true);	//	stop animations (clear the queue = true)
			});

			thisImage.fadeTo(500, 1.0, function() {	//	fade small image back up to 100% opacity
				thisImage.stop(true);	//	stop animations (clear the queue = true)
			});
		});
	});

	//	JQuery animate logo!
	$('#index #logo').css({height:0}).animate({height:'130px'}, 1500, null, function animationComplete() {
		$(this).css({height: 'auto'});
	});

	//	JQuery select unselects others with same value
	$('table#musicals input[type="radio"]').change(function() {
		$('table#musicals input[type="radio"][value="' + $(this).val() + '"]').prop('checked', false);
		$(this).prop('checked', true);
	});

	//	Tickets page
	$(document).on('click', '#tickets #overlay a', function seatClicked() {
		$(this).toggleClass('chosen');
	});

	//	Apply Knockout viewModels
	if($('#audition_form form').length) {
		ko.applyBindings(ipt.viewModels.AuditionFormViewModel, $('#audition_form form')[0]);

		$('form input[type="submit"]').click(function onFormSubmit(form) {
			if (!$('form')[0].checkValidity()) {
				alert('You have an error somewhere in the form.  Please review the audition form carefully (especially date of birth, signature, etc.) and be sure that all required fields are filled in properly.');
				return false;
			}
		});
	}
	if($('#registration_form form').length) {
		ko.applyBindings(ipt.viewModels.RegistrationFormViewModel, $('#registration_form form')[0]);

		$('form input[type="submit"]').click(function onFormSubmit(form) {
			if (!$('form')[0].checkValidity()) {
				alert('You have an error somewhere in the form.  Please review the registration form carefully (especially date of birth, signature, etc.) and be sure that all required fields are filled in properly.');
				return false;
			}
		});
	}
	if($('#bio_form form').length) {
		ko.applyBindings(ipt.viewModels.BioFormViewModel, $('#bio_form form')[0]);
	}
	if($('#tickets .ko').length) {
		ko.applyBindings(ipt.viewModels.TicketsViewModel, $('#tickets')[0]);
	}

	//	Active Class not clickable
	$(document).on('click', '.active', function notClickable() {
		return false;
	});

	//	JQuery TableSorter!
	$('table.tablesorter').tablesorter();

	//	JQuery Formatter!
	$('input.formatter').each(function formatThis() {
		if($(this).hasClass('format-phone')) {
			$(this).formatter({pattern: '({{999}}) {{999}}-{{9999}}'});
		} else if($(this).hasClass('format-zip')) {
			$(this).formatter({pattern: '{{99999}}'});
		} else if($(this).hasClass('format-digits-1')) {
			$(this).formatter({pattern: '{{9}}'});
		} else if($(this).hasClass('format-digits-2')) {
			$(this).formatter({pattern: '{{99}}'});
		} else if($(this).hasClass('format-float')) {
			var floatInput = $(this);
			floatInput.on('keyup', '', function() {
				floatInput.val($(this).val().replace(/[^\d\.]/g, ''));
			});
		} else if($(this).hasClass('format-money')) {
			var moneyInput = $(this);
			moneyInput.on('keyup', '', function() {
				moneyInput.val($(this).val().replace(/[^\d\.]/g, '').replace(/^(\d+)\.(\d{1,2}).*$/, '$1.$2'));
			});
		}
	});

	//	JQuery AJAX get city & state from zip!
	$(document).on('keyup', 'input#zip', function getInfo() {
		var zip = $(this).val();

		if(zip.length === 5) {
			getCitySTFromZip(zip);
		}
	});

	//	JQuery AJAX get audition pic from name!
	$(document).on('keyup', '#firstName, #lastName', function getPic() {
		var firstName = $('#firstName').val();
		var lastName = $('#lastName').val();

		if (firstName.length && lastName.length) {
			if ($('#headshot, #bio_preview').length) {
				getPicFromName(firstName, lastName, $('#bio_preview').length);
			}
		} else {
			$('#headshot, #bio_preview').hide();
		}
	});

	//	JQuery prevent bio form submission if cast member not found
	$('#bio_form form').submit(function onSubmit(event) {
		if (!$('#bio_preview').html().length) {
			alert('Oops!  Your name is not listed as part of the cast of this show.  Please check your spelling and capitalization and compare it to our cast list at www.IPTheater.com/cast_list.php');
			event.preventDefault();
		}
	});
});
