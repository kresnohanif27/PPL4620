/* Sina Extension Pro for Elementor v1.6.0 */

!(function ($) {
	// For Colors Animation
	var $animElems = $(".sina-colors-anim-yes");
	$animElems.each(function(index, el) {
		var $elem  = $(el);
		var data   = $elem.data('sina-anim-colors');
		var length = data.colors.length;
		var colors = data.colors.toString();

		if ( 'hor-moving' == data.type ) {
			$elem.css({
				'background-color' : data.colors[0], // For browsers that do not support gradients
				'background-image' : 'linear-gradient('+ data.angle +'deg,'+ colors +')',
				'background-size' : length +'00% 100%',
			});
		} else if ( 'ver-moving' == data.type ) {
			$elem.css({
				'background-color' : data.colors[0], // For browsers that do not support gradients
				'background-image' : 'linear-gradient('+ data.angle +'deg,'+ colors +')',
				'background-size' : '100%'+ length +'00%',
			});
		}
	});

	// For Clips Animation
	$( window ).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/section', function( $scope ) {
			var $section = $($scope);
			var $sectionID = $section.data('id');

			// For Water Ripples
			if ( $section.hasClass('sina-water-ripples-yes') ) {
				$section.ripples();
			}


			// For Section Particles
			if ( $section.hasClass('sina-section-particles-yes') ) {
				var sinaParticlesWrapSelector = '.sina-section-particles-wrap-'+ $sectionID;
				var $sinaParticlesWrapDetach = $section.siblings( sinaParticlesWrapSelector ).detach();
				$section.prepend($sinaParticlesWrapDetach);

				var $sectionParticles = $( sinaParticlesWrapSelector );
				var particlesData = $sectionParticles.data('section-particles');

				$sectionParticles.sinaParticles({
					lineColor: particlesData.link_color,
					fillColor: particlesData.ball_color,
					particlesNumber: particlesData.number,
					linkDist: particlesData.link,
					createLinkDist: particlesData.clink,
					linksWidth: particlesData.linkw,
					maxSize: particlesData.size,
					speed: particlesData.speed,
					disableLinks: particlesData.dlink ? true : false,
					disableMouse: particlesData.dmouse ? true : false
				});
			}


			// For Clips Animation
			if ( $section.hasClass('sina-clips-animation-yes') ) {
				var sinaClipsWrapSelector = '.sina-clips-anim-wrap-'+ $sectionID;
				var $sinaClipsWrapDetach = $section.siblings( sinaClipsWrapSelector ).detach();
				$section.prepend($sinaClipsWrapDetach);

				var $clips = $( sinaClipsWrapSelector ).find('.sina-clips-anim');
				$clips.each(function(index, el) {
					var $this = $(this);
					var data = $this.data('clips-anim');

					anime({
						targets: this,
						translateX: data.moveX,
						translateY: data.moveY,
						scaleX: data.zoomX,
						scaleY: data.zoomY,
						skewX: data.skewX,
						skewY: data.skewY,
						rotateX: data.rotateX,
						rotateY: data.rotateY,
						rotateZ: data.rotateZ,
						opacity: data.fade,
						easing: data.easing,
						loop: true,
						duration: data.duration,
						delay: data.delay,
						direction: 'alternate',
					});
				});
			}
		});
	});

	// For Reading Progressbar
	$( window ).scroll( function() {
		var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		var scrolled = (winScroll / height) * 100;

		$(".sina-reading-progressbar").css({
			width: scrolled + "%"
		});
	});

	$(document).ready(function($) {
		var $preloader = $('.sina-ext-pro-preloader-wrap');
		var effect = $preloader.data('effect');

		$('.sina-ext-pro-preloader-wrap').addClass(effect);
		setTimeout(function() {
			$preloader.remove();
		}, 1900);
	});

})(jQuery);


