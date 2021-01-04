$(function() {
	let $doctors = $('form .doctors');
	let $nameField = $('.name');
	let $phoneField = $('.phone');
	let $emailField = $('.email');
	let $submit = $('.submit');
	let $questionText = $('.question-text');
	let firstNumber = getRandomNumber();
	let secondNumber = getRandomNumber();
	let $successText = $('.success');

	if($successText) {
		setTimeout(function() {
			$successText.slideUp(500);
		}, 3000);
	}

	$questionText.append(firstNumber + ' + ' + secondNumber);
	
	appendDoctors();

	$doctors.on('change', function() {
		let $thisForm = $(this).closest('form'); 
		let $dateDiv = $thisForm.find('.app-date');
		let $dateInput = $thisForm.find('.date');
		let $hourDiv = $thisForm.find('.app-hour');
		let $hoursSelect = $thisForm.find('.time');
		let $confirmElems = $thisForm.find('.confirm');
		let hasDateAttr = $dateInput.attr('disabled');
		let doctorsOptionValue = $(this).val();

		$doctors = $(this);

		$confirmElems.addClass('hide');

		if(doctorsOptionValue != 0) {
			$.ajax({
				url: '/user-working-days',
				data: {user_id:doctorsOptionValue},
				dataType: 'json',
				beforeSend: function() {
					$dateInput.attr('disabled', 'disable');

					$dateInput.val('');
				},
				success: function(workingDays) {
					let todayDay = new Date();

					$dateInput.removeAttr('disabled');

					$dateDiv.removeClass('hide');

					$dateInput.datepicker('destroy');

					$dateInput.datepicker({
						minDate: todayDay,
						firstDay: 1,
						beforeShowDay: function(date) {
							for(let i = 0; i < workingDays.length; i++) {
								if(date.getDay() == workingDays[i]['day_id']) {
									return [true, '', ''];
								}
							}

							return [false, '', ''];
						},
						onSelect: function(inputDate, obj) {
							let selectedDay = $(this).datepicker('getDate').getDay();
							let timeFromTo = [];
							let splittedTime = [];

							$confirmElems.addClass('hide');

							$hoursSelect
								.find('option')
									.remove()
									.end()
									.append('<option value="0">-Избери-</option>');

							timeFromTo = pushHours(workingDays, selectedDay);

							timeFromTo.sort(function(a, b) {
								return a.from < b.from ? -1 : 1;
							});

							splittedTime = splitWorkingDayHours(timeFromTo);

							$hourDiv.removeClass('hide');							
							$.ajax({
								url: '/schedule-list',
								data: {user_id:doctorsOptionValue},
								dataType: 'json',
								beforeSend: function() {
									$hoursSelect.attr('disabled', 'disable');
								},
								success: function(scheduleList) {
									let selectedDateValue = $dateInput.val();

									$hoursSelect.removeAttr('disabled');

									for(let i = 0; i < splittedTime.length; i++) {
										let textFromTo = splittedTime[i]['from'] + ' - ' + splittedTime[i]['to'];

										$hoursSelect.append('<option value="'+ textFromTo +'">' + textFromTo + '</option>').css('background-color', '#6ac8c5');
									}

									for(let i = 0; i < scheduleList.length; i++) {
										$hoursSelect.find('option').each(function() {
											if($(this).text() == scheduleList[i]['time'] && selectedDateValue == scheduleList[i]['date'])
												$(this).attr('disabled', 'disable').css('background-color', '#e60000');
										});
									}

									$hoursSelect.on('change', function() {
										$(this)
											.closest('div')
												.siblings('.confirm')
												.removeClass('hide');
									});
								}
							});	
						}
					});
				}
			});		
		} else {
			$doctors
				.closest('div')
					.siblings('div')
					.addClass('hide');
		}
	});	

	checkFieldLenght($nameField, 4);

	checkFieldLenght($phoneField, 10);

	$phoneField.on('input', function() {
    	$(this).val($(this).val().replace(/\D/g, ''))
  	});

	$emailField.on('input', function() {
		let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		let $thisField = $(this);

		if(regex.test($(this).val())) {
			$thisField.css('border', '3px solid #42b4b0');
			$thisField.closest('div').addClass('pass');
		} else {
			$thisField.css('border', '3px solid #a62626');
			$thisField.closest('div').removeClass('pass');
		}
	});

	$submit.on('click', function(event) {
		let $this = $(this);
		let $thisForm = $this.closest('form');
		let $nameDiv = $thisForm.find('.patient-name');
		let $phoneDiv = $thisForm.find('.patient-phone');
		let $emailDiv = $thisForm.find('.patient-email');
		let result = firstNumber + secondNumber;
		let captchaUserInput = $thisForm.find('.captcha').val();
		let isCaptchaTrue = checkCaptcha(captchaUserInput, result);

		if($nameDiv.hasClass('pass') && $phoneDiv.hasClass('pass') && $emailDiv.hasClass('pass') && isCaptchaTrue) {
			$this.submit();
		} else {
			event.preventDefault();

			$this.siblings('.alert-text').stop().slideDown(500).removeClass('hide');

			setTimeout(function() { 
				$this.siblings('.alert-text').stop().slideUp(500).addClass('hide');
			}, 2000);
		}
	});

	fixedHeader();
	
	scrollToSection();

	toggleNavList();

	function checkCaptcha(aUserInput, aResult) {
		return aUserInput == aResult;
	}

	function getRandomNumber() {
		return Math.floor((Math.random() * 10) + 1);
	}

	function splitWorkingDayHours(aTimeFromTo) {
		let splittedTime = []

		for(let i = 0; i < aTimeFromTo.length; i++) {
			let from = aTimeFromTo[i]['from'];
			let to = aTimeFromTo[i]['to'];
			let splitTime = aTimeFromTo[i]['from'].split(':');
			let splittedFrom = parseInt(splitTime[0]);
			let splittedTo = parseInt(splitTime[1]);

			while(from != to) {
				splittedTo = parseInt(splittedTo);
				splittedTo += 30;

				if(splittedTo == 60) {
					splittedFrom++;
					splittedTo = '00';
				}

				splittedTime.push({
					'from' : from,
					'to' : splittedFrom + ':' + splittedTo,
				});

				from = splittedFrom + ':' + splittedTo; 
			}
		}

		return splittedTime;
	}

	function checkFieldLenght(aObj, aLength) {
		aObj.on('input', function() {
			let $thisField = $(this);
			let nameSize = $thisField.val().length;
			console.log(nameSize);
			console.log(aLength);

			if(nameSize <= aLength-1) {
				$thisField.css('border', '3px solid #a62626');
				$thisField.closest('div').removeClass('pass');
			} else {
				$thisField.css('border', '3px solid #42b4b0');
				$thisField.closest('div').addClass('pass');
			}
		});
	}

	function pushHours(aWorkingDays, aSelectedDay) {
		let timeFromTo = [];

		for(let i = 0; i < aWorkingDays.length; i++) {
			if(aWorkingDays[i]['day_id'] == aSelectedDay) {
				timeFromTo.push({
					'from' : aWorkingDays[i]['time_from'],
					'to' : aWorkingDays[i]['time_to'],
				});
			}
		}

		return timeFromTo;
	}

	function appendDoctors() {
		$.ajax({
			url: '/all-users',
			dataType: 'json',
			success: function(data) {
				for(let i = 0; i < data.length; i++) {
					$doctors.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				}
			}
		});
	}

	function fixedHeader() {
		$(window).bind('scroll', function () {
			let height = $('.section-main').height();

			if($(window).scrollTop() > height) {
				$('.header-container').addClass('fixed');
			} else {
				$('.header-container').removeClass('fixed');
			}
		});
	}

	function scrollToSection() {
		$('.header-nav a').on('click', function() {
			let link = $(this).attr('href').replace('#', '.');

			$('html, body').animate({
				scrollTop: $(link).offset().top
			}, 1000);
		});
	}

	function toggleNavList() {
		let $iconAndList = $('.list-icon, .nav-list');
		let $list = $('.nav-list');

		$iconAndList.hover(function() {
			$list.stop().slideDown(500).removeClass('hide');
		}, function() {
			$list.stop().slideUp(500).addClass('hide');
		});
	}
});