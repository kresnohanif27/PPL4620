(function ($) {
	'use strict';
	$.fn.sinaParallax = function () {
		return this.each( function() {
			var $this = $(this),
				textShrinkClass  = 'sina-plx-textShrink',
				textStretchClass = 'sina-plx-textStretch',
				fadeInClass 	 = 'sina-plx-fadeIn',
				fadeOutClass 	 = 'sina-plx-fadeOut',
				zoomInClass 	 = 'sina-plx-zoomIn',
				zoomOutClass 	 = 'sina-plx-zoomOut',
				rotateXClass 	 = 'sina-plx-rotateX',
				rotateYClass 	 = 'sina-plx-rotateY',
				rotateZClass 	 = 'sina-plx-rotateZ',
				moveTopClass 	 = 'sina-plx-moveTop',
				moveBottomClass	 = 'sina-plx-moveBottom',
				moveLeftClass 	 = 'sina-plx-moveLeft',
				moveRightClass 	 = 'sina-plx-moveRight',

				ltrSpacing 		 = parseFloat( $this.css( 'letterSpacing' ).replace(/px|em|rem/, '') ),
				defaultLtrSpacing = 30,
				shrinkSize 		 = ltrSpacing ? ltrSpacing : defaultLtrSpacing,
				curShrinkSize 	 = shrinkSize,
				stretchSize 	 = ltrSpacing ? ltrSpacing : 0,
				curStretchSize 	 = 30,

				opacity 		 = parseFloat( $this.css( 'opacity' ) ),
				defaultOpacity 	 = opacity ? opacity : 0,
				curOpacityIn 	 = defaultOpacity,
				curOpacityOut 	 = opacity ? opacity : 1,

				zoomScale 		 = parseFloat( $this.data( 'zoom' ) ),
				zoomScale 		 = zoomScale ? zoomScale : 3,
				curZoomIn 		 = zoomScale,
				curZoomOut 		 = zoomScale,

				rotateSize 		 = parseFloat( $this.data( 'rotate' ) ),
				rotateSize 		 = rotateSize ? rotateSize : 180,
				curRotateX 		 = rotateSize,
				curRotateY 		 = rotateSize,
				curRotateZ 		 = rotateSize,

				moveSize 		 = parseFloat( $this.data( 'move' ) ),
				moveSize 		 = moveSize ? moveSize : 500,
				curMoveTop 		 = moveSize,
				curMoveBottom	 = moveSize,
				curMoveLeft		 = moveSize,
				curMoveRight	 = moveSize,

				elHeight 		 = $this.outerHeight(),
				elTop 			 = $this.offset().top,
				elArea 			 = elHeight + elTop,
				winHeight 		 = $( window ).outerHeight(),
				winHeight 		 = winHeight + 60,
				winTop 			 = window.pageYOffset - 30;

			function currentPercent(curSize, pos) {
				return (curSize / 100) * pos;
			}

			$( window ).on( 'load', function() {
				var loadTransform = '';

				if ( elTop > (winTop + winHeight) ) {
					curMoveTop 		= 0;
					curMoveBottom 	= 0;
					curMoveRight 	= 0;
					curMoveLeft 	= 0;
					curZoomIn 		= 1;
					curStretchSize 	= 0;
				} else if ( winTop > elArea ) {
					curMoveTop 		= moveSize;
					curMoveBottom 	= moveSize;
					curMoveRight 	= moveSize;
					curMoveLeft 	= moveSize;
					curZoomOut 		= 1;
					curOpacityOut 	= 0;
					curOpacityIn 	= 1;
					curShrinkSize 	= 0;
				} else if ( (winTop + winHeight) > elTop && elArea > winTop ) {
					var pos 		= ( (elTop - winTop) / winHeight ) * 100;
					var negPos 		= 100 - pos;

						curMoveTop 	= currentPercent( moveSize, negPos );
						curMoveRight= currentPercent( moveSize, negPos );
						curMoveLeft	= currentPercent( moveSize, negPos );
						curMoveBottom= currentPercent( moveSize, negPos );

						curRotateZ 	= currentPercent( rotateSize, pos );
						curRotateY 	= currentPercent( rotateSize, pos );
						curRotateX 	= currentPercent( rotateSize, pos );

						curZoomOut 	= currentPercent( zoomScale, pos );
						curZoomOut 	= (curZoomOut < 1) ? 1 : curZoomOut;
						curZoomIn 	= currentPercent( zoomScale, negPos );
						curZoomIn 	= (curZoomIn > zoomScale) ? zoomScale : curZoomIn;

						curOpacityOut = currentPercent( 1, pos );
						curOpacityOut = (curOpacityOut < 0) ? 0 : curOpacityOut;
						curOpacityIn = currentPercent( 1, negPos );

						curShrinkSize = currentPercent( shrinkSize, pos );
						curShrinkSize = (curShrinkSize < 0) ? 0 : curShrinkSize;
						curStretchSize = currentPercent( defaultLtrSpacing, negPos );
				}

				if ( $this.hasClass( moveTopClass ) ) {
					loadTransform += 'translateY(-' + curMoveTop + 'px) ';
				} else if ( $this.hasClass( moveRightClass ) ) {
					loadTransform += 'translateX(' + curMoveRight + 'px) ';
				} else if ( $this.hasClass( moveLeftClass ) ) {
					loadTransform += 'translateX(-' + curMoveLeft + 'px) ';
				} else if ( $this.hasClass( moveBottomClass ) ) {
					loadTransform += 'translateY(' + curMoveBottom + 'px) ';
				}

				if ( $this.hasClass( rotateZClass ) ) {
					loadTransform += 'rotateZ(' + curRotateZ + 'deg) ';
				} else if ( $this.hasClass( rotateYClass ) ) {
					loadTransform += 'rotateY(' + curRotateY + 'deg) ';
				} else if ( $this.hasClass( rotateXClass ) ) {
					loadTransform += 'rotateX(' + curRotateX + 'deg) ';
				}

				if ( $this.hasClass( zoomInClass ) ) {
					loadTransform += 'scale(' + curZoomIn + ') ';
				} else if ( $this.hasClass( zoomOutClass ) ) {
					loadTransform += 'scale(' + curZoomOut + ') ';
				}


				if ( loadTransform ) {
					$this.css({
						transform: loadTransform,
					});
				}

				if ( $this.hasClass( fadeInClass ) ) {
					$this.css({
						opacity: curOpacityIn,
					});
				} else if ( $this.hasClass( fadeOutClass ) ) {
					$this.css({
						opacity: curOpacityOut,
					});
				}

				if ( $this.hasClass( textShrinkClass ) ) {
					$this.css({
						letterSpacing: curShrinkSize + 'px',
					});
				} else if ( $this.hasClass( textStretchClass ) ) {
					$this.css({
						letterSpacing: curStretchSize + 'px',
					});
				}
			});

			$( window ).on( 'scroll', function() {
				var newWinTop = window.pageYOffset - 30;
				var scrollTransform	 = '';

				if ( (newWinTop + winHeight) > elTop && elArea > newWinTop ) {
					var pos 		= ( (elTop - newWinTop) / winHeight ) * 100;
					var negPos = 100 - pos;

						curMoveTop 	= currentPercent( moveSize, negPos );
						curMoveRight= currentPercent( moveSize, negPos );
						curMoveLeft	= currentPercent( moveSize, negPos );
						curMoveBottom= currentPercent( moveSize, negPos );
						curRotateZ 	= currentPercent( rotateSize, pos );
						curRotateY 	= currentPercent( rotateSize, pos );
						curRotateX 	= currentPercent( rotateSize, pos );
						curZoomOut 	= currentPercent( zoomScale, pos );
						curZoomIn 	= currentPercent( zoomScale, negPos );
						curOpacityOut = currentPercent( 1, pos );
						curOpacityIn = currentPercent( 1, negPos );
						curShrinkSize = currentPercent( shrinkSize, pos );
						curStretchSize = currentPercent( defaultLtrSpacing, negPos );

					if ( $this.hasClass( moveTopClass ) && curMoveTop > 0 ) {
						scrollTransform += 'translateY(-' + curMoveTop + 'px) ';
					} else if ( $this.hasClass( moveRightClass ) && curMoveRight > 0 ) {
						scrollTransform += 'translateX(' + curMoveRight + 'px) ';
					} else if ( $this.hasClass( moveLeftClass ) && curMoveLeft > 0 ) {
						scrollTransform += 'translateX(-' + curMoveLeft + 'px) ';
					} else if ( $this.hasClass( moveBottomClass ) && curMoveBottom > 0 ) {
						scrollTransform += 'translateY(' + curMoveBottom + 'px) ';
					}

					if ( $this.hasClass( rotateZClass ) && curRotateZ >= 0 ) {
						scrollTransform += 'rotateZ(' + curRotateZ + 'deg) ';
					} else if ( $this.hasClass( rotateYClass ) && curRotateY >= 0 ) {
						scrollTransform += 'rotateY(' + curRotateY + 'deg) ';
					} else if ( $this.hasClass( rotateXClass ) && curRotateX >= 0 ) {
						scrollTransform += 'rotateX(' + curRotateX + 'deg) ';
					}

					if ( $this.hasClass( zoomInClass ) && curZoomIn <= zoomScale ) {
						scrollTransform += 'scale(' + curZoomIn + ') ';
					} else if ( $this.hasClass( zoomOutClass ) && curZoomOut <= zoomScale ) {
						scrollTransform += 'scale(' + curZoomOut + ') ';
					}

					if ( scrollTransform ) {
						$this.css({
							transform: scrollTransform,
						});
					}

					if ( $this.hasClass( fadeInClass ) && curOpacityIn <= 1 && curOpacityIn >= 0 ) {
						$this.css({
							opacity: curOpacityIn,
						});
					} else if ( $this.hasClass( fadeOutClass ) && curOpacityOut <= 1 && curOpacityOut >= 0 ) {
						$this.css({
							opacity: curOpacityOut,
						});
					}

					if ( $this.hasClass( textShrinkClass ) && curShrinkSize >= 0 ) {
						$this.css({
							letterSpacing: curShrinkSize + 'px',
						});
					} else if ( $this.hasClass( textStretchClass ) && curStretchSize >= stretchSize ) {
						$this.css({
							letterSpacing: curStretchSize + 'px',
						});
					}
				}
			});
		});
	}

	$( window ).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/section', function( $scope ) {
			function callMousemove(e, elem) {
				var $this = $(elem);
				var target = $this.find('.sina-parallax-item');
				var relX = e.pageX - $this.offset().left;
				var relY = e.pageY - $this.offset().top;

				target.each(function(index, el) {
					var $el = $(this);
					var movement = $el.data('velocity');

					TweenMax.to($el, 1, {
						x: (relX - $this.width() / 2) / $this.width() * movement,
						y: (relY - $this.height() / 2) / $this.height() * movement,
						ease: Power2.easeOut
					});
				});
			}

			var sinaTimeout;
			var $section = $($scope);
			var $sectionID = $section.data('id');

			if ( $section.hasClass('sina-parallax-yes') ) {
				var sinaParallaxWrapperSelector = '.sina-parallax-wrap-'+ $sectionID;
				var sinaParallaxWrapSelector = '.sina-parallax-wrap.sina-parallax-wrap-'+ $sectionID;
				var $sinaParallaxWrapDetach = $section.siblings( sinaParallaxWrapperSelector ).detach();
				$section.prepend($sinaParallaxWrapDetach);

				var $parallax = $( sinaParallaxWrapperSelector ).find('.sina-parallax');
				$parallax.sinaParallax();

				$(sinaParallaxWrapSelector).on('mousemove', function (e) {
					if ( sinaTimeout ) {
						clearTimeout(sinaTimeout);
					}
					sinaTimeout = setTimeout(callMousemove(e, this), 100);
				});
			}

		});
	});
}(jQuery));