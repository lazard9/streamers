"use strict";

//Filter
module.exports = {
	init: function () {
		var filterActive;

		var cat1 = 'cat-all';
		var cat2 = 'cat-all';
		var cat3 = 'cat-all';

		function filterCategory(cat1, cat2, cat3) {

			// reset results list
			$('.filter-cat-results .f-cat').removeClass('active');

			// the filtering in action for all criteria
			var selector = ".f-cat";
			if (cat1 !== 'cat-all') {
				selector = '[data-cat=' + cat1 + "]";
			}
			if (cat2 !== 'cat-all') {
				selector = selector + '[data-cat2=' + cat2 + "]";
			}
			if (cat3 !== 'cat-all') {
				selector = selector + '[data-cat3=' + cat3 + "]";
			}

			$(selector).addClass('active');

			filterActive = cat1;
		}

		$('.f-cat').addClass('active');

		$('.cat-button1').click(function () {
			cat1 = $(this).attr('data-target');
			filterCategory(cat1, cat2, cat3);

		});

		$('.cat-button2').click(function () {
			cat2 = $(this).attr('data-target');
			filterCategory(cat1, cat2, cat3);

		});

		$('.cat-button3').click(function () {
			cat3 = $(this).attr('data-target');
			filterCategory(cat1, cat2, cat3);

		});

	}
};

// Dropdown filter display and hide
function filterDropdown(buttonDropdown,myDropdown) {
	// flag : says "remove class when click reaches background"
	var removeClass = true;

	// when clicking the button : toggle the class, tell the background to leave it as is
	$(buttonDropdown).click(function () {
		$(buttonDropdown).addClass('buttonSelected');
		$(myDropdown).addClass('showDropdown');
		removeClass = false;
	});

	// when clicking the div : never remove the class
	$(buttonDropdown).click(function() {
		removeClass = false;
	});
	$(myDropdown).click(function() {
		removeClass = false;
	});

	// when click event reaches "html" : remove class if needed, and reset flag
	$("html").click(function () {
		if (removeClass) {
			$(buttonDropdown).removeClass('buttonSelected');
			$(myDropdown).removeClass('showDropdown');
		}
		removeClass = true;
	});
}

filterDropdown('#buttonDropdown','#myDropdown');
filterDropdown('#buttonDropdown2','#myDropdown2');
filterDropdown('#buttonDropdown3','#myDropdown3');

// Home butons id separation from buttons on filter streamers page
filterDropdown('#buttonDropdown4','#myDropdown4');
filterDropdown('#buttonDropdown5','#myDropdown5');
filterDropdown('#buttonDropdown6','#myDropdown6');

// Add active class to the current button (highlight it)
function filterButtonActive(myDropdownA, btn, active) {
	if ($("#"+myDropdownA).length > 0) {
		let btnContainer = document.getElementById(myDropdownA);
		let btns = btnContainer.getElementsByClassName(btn);
		for ( let k = 0; k < btns.length; k++) {
			btns[k].addEventListener("click", function(){
				let current = document.getElementsByClassName(active);
				current[0].className = current[0].className.replace(" "+active, "");
				this.className += " " +active;
			});
		}
	}
}

filterButtonActive('myDropdown', 'btn1', 'active1');
filterButtonActive('myDropdown2', 'btn2', 'active2');
filterButtonActive('myDropdown3', 'btn3', 'active3');

// Home butons id separation from buttons on filter streamers page
filterButtonActive('myDropdown4', 'btn4', 'active1');
filterButtonActive('myDropdown5', 'btn5', 'active2');
filterButtonActive('myDropdown6', 'btn6', 'active3');

// Grab inner text of clicket filter item and place it below filter dropdown open button
function filterGetSelectedText(catButton,selectedClickedText,active) {									
	$(catButton).click( function(e) {
		if( $(this).is(active) ) {
			let clickedPlatform = $(e.target).text();
			if (clickedPlatform === 'Show all') {
				$(selectedClickedText).html('Showing all').css("color", "#fff");
			} else {
				$(selectedClickedText).html(clickedPlatform).css("color", "#00dfff");
			}
		}
	});
}

filterGetSelectedText('a.cat-button1', '#selectedPlatform', '.active1');
filterGetSelectedText('a.cat-button2', '#selectedGame', '.active2');
filterGetSelectedText('a.cat-button3', '#selectedCountry', '.active3');


// Check if active Streamers (li.streamer-li) exist
$(document).ready(function() { 
	$('.cat-button1, .cat-button2, .cat-button3').click(function() {
		
		let findActive = $('.streamers-ul').find('.active');
		
		if ( !findActive.length ) {
			$('#no-streamers').css({ 
                "display": "block",
            });
		} else {
			$('#no-streamers').css({ 
                "display": "none",
            });
		}
	})
});


// Search for dropdown filter items
function filterSearch(myInput,myInputID,myDropdownID) {
	$(myInput).keyup(function() {
		let input, filter, txtValue, div, a, i;
		input = document.getElementById(myInputID);
		filter = input.value.toUpperCase();
		div = document.getElementById(myDropdownID);
		a = div.getElementsByTagName("a");
		for (i = 0; i < a.length; i++) {
			txtValue = a[i].textContent || a[i].innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				a[i].style.display = "";
			} else {
				a[i].style.display = "none";
			}
		}
	});
}

filterSearch('#myInput', 'myInput', 'myDropdown');
filterSearch('#myInput2', 'myInput2', 'myDropdown2');
filterSearch('#myInput3', 'myInput3', 'myDropdown3');

// Home butons id separation from buttons on filter streamers page
filterSearch('#myInput4', 'myInput4', 'myDropdown4');
filterSearch('#myInput5', 'myInput5', 'myDropdown5');
filterSearch('#myInput6', 'myInput6', 'myDropdown6');

// Redirect from Home to Filter Streamers
function redirectStreamer(btn) {
	$(btn).on("click", function () {
		let btnRedirect = $(this).attr('data-btn');
		let catRedirect = $(this).attr('data-target');
		window.location.href = "url/filter-streamers/?btn="+btnRedirect+"&target="+catRedirect+"#filters";
	});
}

redirectStreamer('.btn4');
redirectStreamer('.btn5');
redirectStreamer('.btn6');

// helper functions for sorting (not used)
Array.prototype.contains = function(v) {
	for (var i = 0; i < this.length; i++) {
		if (this[i] === v) return true;
	}
	return false;
};

Array.prototype.unique = function() {
	var arr = [];
	for (var i = 0; i < this.length; i++) {
		if (!arr.contains(this[i])) {
			arr.push(this[i]);
		}
	}
	return arr;
}

// Display elements in dropdown filters that correspond to atleast one loaded streamer
if ($("#filter-streamers").length > 0) {

	window.displayElementsDropDown = function(catButton,cat,btn) {
		let dataTarget, dataCat = [], dataCatUnique = [], j, k = 1;

		$(catButton).each(function() {

			dataTarget = ($(this).attr('data-target'));

			$(btn + `[data-target='${dataTarget}']`).removeClass('btn-background');

			if ( dataTarget !== 'cat-all' ) {
				$('.f-cat').each(function() {
					dataCat.push($(this).data(cat));
					//console.log(dataCat);
				});

				dataCatUnique = dataCat.filter((item, i, ar) => ar.indexOf(item) === i);

				for (j = 0; j < dataCatUnique.length; ++j) {
					if ( dataTarget == dataCatUnique[j] ) {
						++k;

						$(btn + `[data-target='${dataTarget}']`).addClass('filtered');

						if((k) % 2 == 0) { // highlight every second element in dropdown filters
							$(btn + `[data-target='${dataTarget}']`).addClass('btn-background');/*.css({ 
								"background-color": "#2d2d2d",
							});*/
						}
						
					}
				}
			}
		});
	}

	displayElementsDropDown('.cat-button1','cat','.btn1');
	displayElementsDropDown('.cat-button2','cat2','.btn2');
	displayElementsDropDown('.cat-button3','cat3','.btn3');

	// Make item in filter to be active by passed data in URL
	$(document).ready(function(){
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null) {
			return null;
			}
			return decodeURI(results[1]) || 0;
		}
		
		let target = $.urlParam('target');

		if ( ( target !== null ) && ( target !== 'cat-all' ) ) {
			let btn = $.urlParam('btn');
			
			$("."+btn + `[data-target='${target}']`)[0].click();
			
		}
	});
}