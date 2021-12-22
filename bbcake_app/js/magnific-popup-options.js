$(document).ready(function() {
  // MagnificPopup

	var magnifPopup = function() {
		$('.image-popup').magnificPopup({
			type: 'image',
			//delegate: 'a',
			removalDelay: 300,
			mainClass: 'mfp-with-zoom',
			//tLoading: 'Loading image #%curr&...',
			image: {
					verticalFit: true,
					titleSrc: function(item) {
					
						//var btn_href = item.el.attr('data-source');
						
						//if( btn_href !== null && btn_href !== undefined )
						//{
							//btn = "&middot;<a class='image-source-link' href='"+item.el.attr('data-source')+"' target='_blank'>перейти</a>";
						//	parent.location.href = btn_href;
						//}
						return item.el.attr('title');
					}
			},
			gallery:{
				enabled:true
			},
			zoom: {
				enabled: true, // By default it's false, so don't forget to enable it

				duration: 300, // duration of the effect, in milliseconds
				easing: 'ease-in-out', // CSS transition easing function

				// The "opener" function should return the element from which popup will be zoomed in
				// and to which popup will be scaled down
				// By defailt it looks for an image tag:
				opener: function(openerElement) {
				// openerElement is the element on which popup was initialized, in this case its <a> tag
				// you don't need to add "opener" option if this code matches your needs, it's defailt one.
				return openerElement.is('img') ? openerElement : openerElement.find('img');
				}
			}
		});
	};

	var magnifVideo = function() {
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });
	};

	


	// Call the functions 
	magnifPopup();
	magnifVideo();

});