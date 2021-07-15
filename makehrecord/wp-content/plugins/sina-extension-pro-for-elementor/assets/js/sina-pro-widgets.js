/* Sina Extension Pro for Elementor v1.9.0 */

!(function ($) {
	'use strict';

	var sinaProAjaxURL = sinaExtProAjax.ajaxURL;

	// Owl Carousel for some Slider or Carousel
	function sinaProOwl(owl) {
		var itemLg = owl.data('item-lg'),
			itemLg = itemLg ? itemLg : 2,
			itemMd = owl.data('item-md'),
			itemMd = itemMd ? itemMd : 2,
			itemSm = owl.data('item-sm'),
			itemSm = itemSm ? itemSm : 1,
			slideIn = owl.data('slide-anim'),
			slideOut = owl.data('slide-anim-out'),
			slideOut = 'none' == slideOut ? false : slideOut,
			slideIn = 'none' == slideIn ? false : slideIn,
			play = owl.data('autoplay') ? true : false,
			pause = owl.data('pause') ? true : false,
			center = owl.data('center') ? true : false,
			nav = owl.data('nav') ? true : false,
			dots = owl.data('dots') ? true : false,
			mouse = owl.data('mouse-drag') ? true : false,
			touch = owl.data('touch-drag') ? true : false,
			loop = owl.data('loop') ? true : false,
			speed = owl.data('speed'),
			speed = speed ? speed : 500,
			delay = owl.data('delay');

		// Initialize carousel
		owl.owlCarousel({
			animateOut: slideOut,
			animateIn: slideIn,
			autoplay: play,
			autoplayHoverPause: pause,
			center: center,
			nav: nav,
			dots: dots,
			mouseDrag: mouse,
			touchDrag: touch,
			loop: loop,
			smartSpeed: speed,
			autoplayTimeout: delay,
			responsive: {
				0: {
					items: itemSm
				},
				600: {
					items: itemMd
				},
				900: {
					items: itemLg
				},
			}
		});
	}

	function sinaProSourceCode($scope, $) {
		window.Prism = window.Prism || {};
		window.Prism.manual = true;

		$scope.find('.sina-pro-source-code').each(function () {
			var $this 	 = $(this);
			var lang 	 = $this.data('code-lang');
			var copyText = $this.data('copy-text');
			var $codeTag = $this.find('code.language-' + lang);
			var $btn 	 = $this.find('.sina-code-copy-btn');

			$btn.on('click', function () {
				var $text = $("<textarea>");
				$(this).append($text);
				$text.val($codeTag.text()).select();
				document.execCommand("copy");
				$text.remove();
				if (copyText.length) {
					$(this).text(copyText);
				}
			});

			if (lang && $codeTag) {
				Prism.highlightElement($codeTag.get(0));
			}
		});
	}

	function sinaProLottieAnimation($scope, $) {
		$scope.find('.sina-pro-lottie-animation').each(function () {
			var $this = $(this),
				$element = $this.find('.sina-pro-lottie'),
				path = $this.data('path'),
				hoverEvent = $this.data('hover-event'),
				hoverEvent = hoverEvent ? hoverEvent : '',
				renderer = $this.data('renderer'),
				renderer = renderer ? renderer : 'svg',
				autoplay = $this.data('autoplay') ? true : false,
				reversed = $this.data('reversed') ? -1 : 1,
				loop = $this.data('loop') ? true : false,
				speed = $this.data('speed'),
				delay = $this.data('delay'),
				speed = speed ? speed : 1,
				delay = delay ? delay : 500;

			var lottieAnim = bodymovin.loadAnimation({
				container: $element[0],
				renderer: renderer,
				autoplay: false,
				loop: loop,
				path: path,
			});

			lottieAnim.setSpeed(speed);
			if (loop && 1 !== reversed) {
				lottieAnim.setDirection(-1);
			}
			if (autoplay) {
				setTimeout(function() {
					lottieAnim.play();
				}, delay);
			}

			var mouseEnterEvent = function(e) {
				switch (hoverEvent) {
					case '':
					break;
					case 'play':
					lottieAnim.play();
					break;
					case 'pause':
					lottieAnim.pause();
					break;
					case 'stop':
					lottieAnim.stop();
					break;
					case 'reverse':
					lottieAnim.setDirection(reversed * -1);
					break;
					default:
					lottieAnim.stop();
				}
			};

			var mouseLeaveEvent = function(e) {
				lottieAnim.setDirection(reversed);
				if( !autoplay && 'play' == hoverEvent) {
					lottieAnim.stop();
				} else if (autoplay && ('stop' == hoverEvent || 'pause' == hoverEvent || 'reverse' == hoverEvent)) {
					lottieAnim.play();
				}
			};

			$element.off('mouseenter', mouseEnterEvent)
			.on('mouseenter', mouseEnterEvent);

			$element.off('mouseleave', mouseLeaveEvent)
			.on('mouseleave', mouseLeaveEvent);
		});
	}

	function sinaProTiltBox($scope, $) {
		$scope.find('.sina-pro-tilt-box').each(function () {
			$(this).children('.sina-tilt-box').tilt();
		});
	}

	function sinaProPostsOnScroll($scope, $) {
		$scope.find('.sina-posts-on-scroll').each(function () {
			var $this = $(this),
				$isoGrid = $this.children('.sina-bp-grid');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-posts-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-grid-sizer',
					}
				});
			});

			var uid = $this.data('uid'),
				postsData = $this.data('posts-data'),
				totalPosts = postsData.total_posts,
				postsNum = postsData.posts_num,
				nonce = $this.find('#sina_on_scroll_posts'+uid),
				loader = $this.children('.sina-on-scroll-load-icon'),
				canBeLoaded = true;

			$(window).on('scroll', function(e) {
				var offset = $this.data('offset');
				var winTop = window.pageYOffset;
				var winHeight = $(window).outerHeight();
				var $thisTop = $this.offset().top;
				var $thisHeight = $this.outerHeight();

				if ( (winTop + winHeight) > ($thisTop + $thisHeight) && canBeLoaded ) {
					$.ajax({
						url : sinaProAjaxURL,
						data: {
							action: "sina_on_scroll_posts",
							posts_data: JSON.stringify(postsData),
							offset: offset,
							nonce: nonce.val(),
						},
						type:'POST',
						beforeSend: function( xhr ){
							if ( (offset + postsNum) <= totalPosts ) {
								loader.fadeIn('200');
							}
							canBeLoaded = false; 
						},
						success:function(data){
							if( data ) {
								var $items = $(data).find('.sina-posts-col');
								$isoGrid.append($items);
								imagesLoaded($isoGrid, function() {
									$isoGrid.isotope('appended', $items);
								});

								$this.data('offset', offset + postsNum);
								loader.fadeOut('200');
								canBeLoaded = true;
							}
						}
					});
				}
			});

		});
	}

	function sinaProPostsGallery($scope, $) {
		$scope.find('.sina-posts-gallery').each(function () {
			var $this = $(this),
				$isoGrid = $this.children('.sina-bp-grid'),
				$btns = $this.children('.sina-gallery-btns');

			$this.imagesLoaded( function() {
				var $grid = $isoGrid.isotope({
					itemSelector: '.sina-posts-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-grid-sizer',
					}
				});

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});
			});
		});
	}

	function sinaProTeamCarousel($scope, $) {
		$scope.find('.sina-pro-team-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	function sinaProTwitterFeedCarousel($scope, $) {
		$scope.find('.sina-pro-twitter-feed-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	function sinaProFBFeedCarousel($scope, $) {
		$scope.find('.sina-pro-facebook-feed-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	function sinaProImgAccrodion($scope, $) {
		$scope.find('.sina-pro-image-accordion').each(function () {
			var $this  = $(this);
			var $items = $this.find('.sina-pro-accord-item');

			$items.on('click', function(e) {
				$items.removeClass('active');
				$(this).not('.hover').addClass('active');
			});
		});
	}

	function sinaProImgMarker($scope, $) {
		$scope.find('.sina-pro-image-marker').each(function () {
			var $this  = $(this);

			$this.find('.sina-tooltip').tooltip();
		});
	}

	function sinaProInstantSearch($scope, $) {
		$scope.find('.sina-pro-instant-search').each(function () {
			var $this 	 = $(this);
			var uid 	 = $this.data('uid');
			var $nonce 	 = $this.find('#sina_instant_search_nonce'+uid);
			var $field 	 = $this.find('.sina-pro-instant-search-key');
			var $result	 = $this.find('.sina-pro-search-result');
			var searchInfo = $this.data('search-info');
			var searchText = $result.html();

			$field.on('keyup', function(e) {
				var val = $field.val();
				if ( val ) {
					$result.html(searchText).fadeIn('200');
					$.ajax({
						url: sinaProAjaxURL,
						type: 'post',
						data: {
							action: 'sina_instant_search',
							nonce: $nonce.val(),
							keyword: val,
							search_info: JSON.stringify(searchInfo),
						},
						success: function(data) {
							$result.html( data ).fadeIn('200');
						}
					});
				} else {
					$result.fadeOut('200');
				}
			});

			$field.on('focusin', function(e) {
				var val = $field.val();
				if ( val ) {
					$result.html(searchText).fadeIn('200');
					$.ajax({
						url: sinaProAjaxURL,
						type: 'post',
						data: {
							action: 'sina_instant_search',
							nonce: $nonce.val(),
							keyword: val,
							search_info: JSON.stringify(searchInfo),
						},
						success: function(data) {
							$result.html( data ).fadeIn('200');
						}
					});
				} else {
					$result.fadeOut('200');
				}
			});

			$field.on('focusout', function(e) {
				$result.fadeOut('200');
			});

		});
	}

	function sinaProChart($scope, $) {
		$scope.find('.sina-pro-chart').each(function () {
			var $this 	  = $(this);
			var $chartId  = $this.data('chart-id');
			var $type 	  = $this.data('chart-type');
			var $labels	  = $this.data('chart-labels');
			var $datasets = $this.data('chart-datasets');
			var $options  = $this.data('chart-options');
			var $prefix   = $options.value_prefix;
			var $thousSep = $options.thousands_separator;

			$options.tooltips.callbacks = {
				label: function(tooltipItem, data) {
					var label = ['doughnut','pie','polarArea'].includes( $type ) ? data.labels[tooltipItem.index] : data.datasets[tooltipItem.datasetIndex].label;
					var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] || '';

					if ( 'yes' == $thousSep) {
						value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
					return label+' : '+$prefix + value;
				}
			}
			if ( ['bar', 'line'].includes( $type ) && 'yes' == $options.grid_lines ) {
				$options.scales.yAxes[0].ticks.callback = function(value, index, values) {
					if ( 'yes' == $thousSep) {
						value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
					return $prefix + value;
				}
			} else if ( ['horizontalBar'].includes( $type ) && 'yes' == $options.grid_lines ) {
				$options.scales.xAxes[0].ticks.callback = function(value, index, values) {
					if ( 'yes' == $thousSep) {
						value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
					return $prefix + value;
				}
			} else if ( ['radar','polarArea'].includes( $type ) ) {
				$options.scale.ticks.callback = function(value, index, values) {
					if ( 'yes' == $thousSep) {
						value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
					return $prefix + value;
				}
			}

			var chart = document.getElementById( $chartId ).getContext('2d');
			var myChart = new Chart(chart, {
				type: $type,
				data: {
					labels: $labels,
					datasets: $datasets
				},
				options: $options
			});
		});
	}

	function sinaProOffcanvasBar($scope, $) {
		$scope.find('.sina-pro-offcanvas-bar').each(function () {
			var $this = $(this);
			var $id = $this.data('offcanvas-id');
			var $btn = $('.'+$id);
			var $closeBtn = $this.find('.close-'+$id);
			var $canvas = $('.sina-canvas-'+$id);
			var $click = $this.data('click') ? true : false;
			var $esc = $this.data('esc') ? true : false;

			$btn.click( function(e) {
				e.preventDefault();
				$canvas.addClass('sina-offcanvas-on');
			});
			$closeBtn.click( function() {
				$canvas.removeClass('sina-offcanvas-on');
			});

			if ( $click ) {
				$(document).on('click', '.sina-offcanvas-overlay', function(e) {
					if ( $(e.target).is('.sina-offcanvas-overlay') ) {
						$canvas.removeClass('sina-offcanvas-on');
					}
				});
			}

			if ( $esc ) {
				$(window).on('keydown', function(e) {
					var key = e.which || e.keyCode;
					if ( 192 == key ) {
						$canvas.removeClass('sina-offcanvas-on');
					}
				});
			}
		});
	}

	function sinaProRegisterForm($scope, $) {
		$scope.find('.sina-pro-register-form').each(function () {
			var $this 	 = $(this).children('.sina-register-form');
			var $uid 	 = $this.data('uid');
			var $nonce 	 = $this.find('#sina_register_nonce'+$uid);
			var $email 	 = $this.find('.sina-input-email');
			var $uname 	 = $this.find('.sina-input-username');
			var $success = $this.children('.sina-success-text');
			var $error 	 = $this.children('.sina-error-text');
			var $process = $this.children('.sina-process-text');
			var $isCaptcha = $this.data('captcha') ? true : false;
			var timeout;


			$this.on('submit', function(e) {
				e.preventDefault();
				clearTimeout(timeout);

				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);

				var captcha = '';
				if ( $isCaptcha ) {
					captcha = grecaptcha.getResponse();
				}

				$.post(
					sinaProAjaxURL,
					{
						action: "sina_register",
						email: $email.val(),
						uname: $uname.val(),
						is_captcha: $isCaptcha,
						captcha: captcha,
						nonce: $nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							if ( 'success' == data ) {
								$process.fadeOut(0);
								$success.fadeIn(200);

								timeout = setTimeout( function() {
									$success.fadeOut(200);
								}, 10000 );
							} else{
								$process.fadeOut(0);
								$error.html( data ).fadeIn(200);

								timeout = setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							}
						}
					}
				);

			});
		});
	}

	function sinaProLostPassForm($scope, $) {
		$scope.find('.sina-pro-lost-pass-form').each(function () {
			var $this 	 = $(this).children('.sina-lost-pass-form');
			var $uid 	 = $this.data('uid');
			var $from 	 = $this.data('from');
			var $nonce 	 = $this.find('#sina_lost_pass_nonce'+$uid);
			var $email 	 = $this.find('.sina-input-email');
			var $success = $this.children('.sina-success-text');
			var $error 	 = $this.children('.sina-error-text');
			var $process = $this.children('.sina-process-text');
			var timeout;


			$this.on('submit', function(e) {
				e.preventDefault();
				clearTimeout(timeout);

				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);

				$.post(
					sinaProAjaxURL,
					{
						action: "sina_lost_pass",
						from_text: $from,
						email: $email.val(),
						nonce: $nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							if ( 'success' == data ) {
								$process.fadeOut(0);
								$success.fadeIn(200);

								timeout = setTimeout( function() {
									$success.fadeOut(200);
								}, 10000 );
							} else{
								$process.fadeOut(0);
								$error.html( data ).fadeIn(200);

								timeout = setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							}
						}
					}
				);

			});
		});
	}

	function sinaProTab($scope, $) {
		$scope.find('.sina-pro-tab').each(function () {
			var $btn = $(this).find(".sina-pro-tab-btn");

			$btn.on('click', function(e) {
				var $this = $(this);

				$( $this.data('id') ).siblings('.sina-pro-tab-wrap').removeClass('active');
				$( $this.data('id') ).addClass('active');
				$this.siblings('.sina-pro-tab-btn').removeClass('active');
				$this.addClass('active');
			});
		});
	}

	function sinaProSectionNav($scope, $) {
		$scope.find('.sina-pro-section-nav').each(function () {
			$(this).find('.sina-tooltip').tooltip();
		});
	}

	function sinaProThumbCarousel($scope, $) {
		$scope.find('.sina-pro-thumb-carousel').each(function () {
			var $this 			= $(this),
				oneCarousel 	= $this.find(".sina-thumb-carousel-main"),
				twoCarousel 	= $this.find(".sina-thumb-carousel-thumb"),
				itemLg 			= $this.data('item-lg'),
				itemLg 			= itemLg ? itemLg : 4,
				itemMd 			= $this.data('item-md'),
				itemMd 			= itemMd ? itemMd : 3,
				itemSm 			= $this.data('item-sm'),
				itemSm 			= itemSm ? itemSm : 2,
				play 			= $this.data('autoplay') ? true : false,
				pause 			= $this.data('pause') ? true : false,
				nav 			= $this.data('nav') ? true : false,
				mouse 			= $this.data('mouse-drag') ? true : false,
				touch 			= $this.data('touch-drag') ? true : false,
				loop 			= $this.data('loop') ? true : false,
				delay 			= $this.data('delay'),
				speed 			= $this.data('speed'),
				speed 			= speed ? speed : 300,
				syncedSecondary = true;

			var slideIndexOne = function(el) {
				var current = el.item.index;

				if (loop) {
					var count 	= el.item.count - 1;
					var current = Math.round(el.item.index - el.item.count / 2 - .5);

					if (current < 0) {
						current = count;
					}
					if (current > count) {
						current = 0;
					}
				}

				twoCarousel.find(".owl-item").removeClass("current").eq(current).addClass("current");
				var onscreen = twoCarousel.find('.owl-item.active').length - 1;
				var start 	 = twoCarousel.find('.owl-item.active').first().index();
				var end 	 = twoCarousel.find('.owl-item.active').last().index();

				if (current > end) {
					twoCarousel.data('owl.carousel').to(current, speed / 2, true);
				}
				if (current < start) {
					twoCarousel.data('owl.carousel').to(current - onscreen, speed / 2, true);
				}
			};

			var slideIndexTwo = function(el) {
				if (syncedSecondary) {
					var number = el.item.index;
					oneCarousel.data('owl.carousel').to(number, speed, true);
				}
			};

			oneCarousel.owlCarousel({
				autoplay: play,
				autoplayHoverPause: pause,
				autoplayTimeout: delay,
				smartSpeed: speed,
				mouseDrag: mouse,
				touchDrag: touch,
				loop: loop,
				nav: nav,
				dots: false,
				items: 1,
				responsiveRefreshRate: 200,
			}).on("changed.owl.carousel", slideIndexOne);

			twoCarousel.on("initialized.owl.carousel", function() {
				twoCarousel.find(".owl-item").eq(0).addClass("current");
			}).owlCarousel({
				smartSpeed: speed,
				mouseDrag: true,
				touchDrag: true,
				dots: false,
				nav: false,
				responsive: {
					0: {
						items: itemSm
					},
					600: {
						items: itemMd
					},
					900: {
						items: itemLg
					},
				},
				responsiveRefreshRate: 100,
			})
			.on("changed.owl.carousel", slideIndexTwo)
			.on("click", ".owl-item", function(e) {
				e.preventDefault();
				var number = $(this).index();
				oneCarousel.data("owl.carousel").to(number, speed, true);
			});
		});
	}

	function sinaProTestimonial($scope, $) {
		elementorFrontend.waypoint($scope.find('.sina-pro-testimonial'), function () {
			var $this 			= $(this);
			var	oneCarousel 	= $this.find(".sina-content-carousel");
			var twoCarousel 	= $this.find(".sina-thumb-carousel");
			var bigThumb 		= $this.find('.sina-big-thumb').children('img');
			var slidesPerPage 	= $this.data('slides');
			var play 			= $this.data('autoplay') ? true : false;
			var pause 			= $this.data('pause') ? true : false;
			var nav 			= $this.data('nav') ? true : false;
			var mouse 			= $this.data('mouse-drag') ? true : false;
			var touch 			= $this.data('touch-drag') ? true : false;
			var loop 			= $this.data('loop') ? true : false;
			var delay 			= $this.data('delay');
			var speed 			= $this.data('speed');
			var speed 			= speed ? speed : 300;
			var syncedSecondary = true;

			var slideIndexOne = function(el) {

				var count 	= el.item.count - 1;
				var current = Math.round(el.item.index - el.item.count / 2 - .5);

				if (current < 0) {
					current = count;
				}
				if (current > count) {
					current = 0;
				}

				twoCarousel.find(".owl-item").removeClass("current").eq(current).addClass("current");
				var onscreen = twoCarousel.find('.owl-item.active').length - 1;
				var start 	 = twoCarousel.find('.owl-item.active').first().index();
				var end 	 = twoCarousel.find('.owl-item.active').last().index();

				if (current > end) {
					twoCarousel.data('owl.carousel').to(current, 100, true);
				}
				if (current < start) {
					twoCarousel.data('owl.carousel').to(current - onscreen, 100, true);
				}

				var imgURL =twoCarousel.find(".owl-item.current").children('img').attr('src');
				bigThumb.attr('src', imgURL);
			};

			var slideIndexTwo = function(el) {
				if (syncedSecondary) {
					var number = el.item.index;
					oneCarousel.data('owl.carousel').to(number, 100, true);
				}
			};

			oneCarousel.owlCarousel({
				autoplay: play,
				autoplayHoverPause: pause,
				autoplayTimeout: delay,
				smartSpeed: speed,
				mouseDrag: mouse,
				touchDrag: touch,
				loop: loop,
				nav: nav,
				dots: false,
				items: 1,
				responsiveRefreshRate: 200,
				navText: ['<i class="icofont icofont-thin-left"></i>', '<i class="icofont icofont-thin-right"></i>']
			}).on('changed.owl.carousel', slideIndexOne);

			twoCarousel.on('initialized.owl.carousel', function () {
				twoCarousel.find(".owl-item").eq(0).addClass("current");
			}).owlCarousel({
				items: slidesPerPage,
				smartSpeed: speed,
				slideBy: slidesPerPage,
				dots: false,
				nav: false,
				mouseDrag: false,
				touchDrag: false,
				responsiveRefreshRate: 100,
			}).on('changed.owl.carousel', slideIndexTwo);

			twoCarousel.on("click", ".owl-item", function (e) {
				e.preventDefault();
				var $item  = $(this);
				var number = $item.index();
				var imgURL =$item.children('img').attr('src');

				bigThumb.attr('src', imgURL);
				oneCarousel.data('owl.carousel').to(number, 300, true);
			});
		});
	}

	function sinaProToggleContent($scope, $) {
		$scope.find('.sina-pro-toggle-content').each(function () {
			var $wrap = $(this);
			var $label = $wrap.find('.sina-toggle-labels span');

			$label.on('click', function(e) {
				var $this = $(this);

				$this.siblings().removeClass('active');
				$this.addClass('active');

				$( $this.data('id') ).siblings().removeClass('show');
				$( $this.data('id') ).addClass('show');
			});
		});
	}

	function sinaProVideoGallery($scope, $) {
		$scope.find('.sina-pro-video-gallery').each(function () {
			var $this = $(this),
				$isoGrid = $this.children('.sina-video-gallery-grid'),
				$btns = $this.children('.sina-video-gallery-btns');

			$this.imagesLoaded( function() {
				var $grid = $isoGrid.isotope({
					itemSelector: '.sina-video-gallery-item',
					layoutMode: 'fitRows'
				});

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});
			});

			$this.find('.sina-pro-video-play').venobox({
				titlePosition: 'bottom',
				bgcolor: '#000000',
			});
		});
	}


	// WooCommerce
	// ===============
	function sinaProProductFilterVertical($scope, $) {
		$scope.find('.sina-pro-wc-product-filter-vertical').each(function () {
			var $this = $(this),
				$items = $this.find('.sina-pro-wc-profil-item');

			$items.each(function(index, el) {
				var $item = $(this),
					$label = $item.find('.sina-pro-wc-profil-label'),
					$inner = $item.find('.sina-pro-wc-profil-content-inner');

				$label.on('click', function(e) {
					e.stopImmediatePropagation();

					$inner.slideToggle(300);
					$item.toggleClass('active');
				});
			});
		});
	}

	function sinaProProductFilterHorizontal($scope, $) {
		$scope.find('.sina-pro-wc-product-filter-horizontal').each(function () {
			var $this = $(this),
				$items = $this.find('.sina-pro-wc-profil-item');

			$items.each(function(index, el) {
				var $item = $(this),
					$siblings = $item.siblings('.sina-pro-wc-profil-item'),
					$label = $item.find('.sina-pro-wc-profil-label'),
					$inner = $item.find('.sina-pro-wc-profil-content-inner');

				$label.on('click', function(e) {
					e.stopImmediatePropagation();

					$inner.slideToggle(300);
					$siblings.find('.sina-pro-wc-profil-content-inner').slideUp(250);
					$item.toggleClass('active');
					$siblings.removeClass('active');
				});
			});

			$(document).on('click', function(e) {
				if ( e.target.class == 'sina-pro-wc-profil-item' || $(e.target).parents(".sina-pro-wc-profil-item").length == 0 ) {
					$this.find('.sina-pro-wc-profil-content-inner').slideUp(250);
					$items.removeClass('active');
				}
			});
		});
	}

	function sinaProShopBoxCarousel($scope, $) {
		$scope.find('.sina-pro-wc-shop-box-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	function sinaProShopListCarousel($scope, $) {
		$scope.find('.sina-pro-wc-shop-list-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	function sinaProShopThumbCarousel($scope, $) {
		$scope.find('.sina-pro-wc-shop-thumb-carousel').each(function () {
			sinaProOwl( $(this) );
		});
	}

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_lottie_animation.default', sinaProLottieAnimation);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_source_code.default', sinaProSourceCode);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_tilt_box.default', sinaProTiltBox);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_posts_on_scroll.default', sinaProPostsOnScroll);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_posts_gallery.default', sinaProPostsGallery);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_team_carousel.default', sinaProTeamCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_twitter_feed_carousel.default', sinaProTwitterFeedCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_facebook_feed_carousel.default', sinaProFBFeedCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_image_accordion.default', sinaProImgAccrodion);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_image_marker.default', sinaProImgMarker);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_instant_search.default', sinaProInstantSearch);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_chart.default', sinaProChart);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_offcanvas_bar.default', sinaProOffcanvasBar);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_section_nav.default', sinaProSectionNav);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_register_form.default', sinaProRegisterForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_lost_password_form.default', sinaProLostPassForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_tab.default', sinaProTab);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_thumb_carousel.default', sinaProThumbCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_testimonial.default', sinaProTestimonial);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_toggle_content.default', sinaProToggleContent);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_video_gallery.default', sinaProVideoGallery);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_product_filter_vertical.default', sinaProProductFilterVertical);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_product_filter_horizontal.default', sinaProProductFilterHorizontal);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_shop_box_carousel.default', sinaProShopBoxCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_shop_list_carousel.default', sinaProShopListCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_ext_pro_shop_thumb_carousel.default', sinaProShopThumbCarousel);
	});

})(jQuery);
