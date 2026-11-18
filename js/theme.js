/**
 * Northfield Home Health theme scripts: mobile nav, hero slider,
 * scroll-reveal animations, back-to-top.
 */
( function () {
	'use strict';

	var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var body = document.body;

	/* Mobile navigation ------------------------------------------------ */
	var toggle = document.querySelector( '.nav-toggle' );
	var nav = document.querySelector( '.page_nav' );

	function closeNav() {
		body.classList.remove( 'nav-open' );
		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
		}
	}

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var open = body.classList.toggle( 'nav-open' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );

		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) {
				closeNav();
			}
		} );

		document.addEventListener( 'click', function ( e ) {
			if ( body.classList.contains( 'nav-open' ) && ! nav.contains( e.target ) && ! toggle.contains( e.target ) ) {
				closeNav();
			}
		} );

		// Submenu toggles on small screens: tapping the caret opens the submenu.
		nav.querySelectorAll( '.submenu-caret' ).forEach( function ( caret ) {
			caret.addEventListener( 'click', function ( e ) {
				if ( window.innerWidth <= 1024 ) {
					e.preventDefault();
					e.stopPropagation();
					caret.closest( 'li' ).classList.toggle( 'submenu-open' );
				}
			} );
		} );

		// Keyboard support: keep submenu visible while focus is inside.
		nav.querySelectorAll( '.menu-item-has-children' ).forEach( function ( li ) {
			li.addEventListener( 'focusin', function () {
				li.classList.add( 'focus-within' );
			} );
			li.addEventListener( 'focusout', function ( e ) {
				if ( ! li.contains( e.relatedTarget ) ) {
					li.classList.remove( 'focus-within' );
				}
			} );
		} );
	}

	/* Hero slider (cross-fade) ---------------------------------------- */
	var slider = document.querySelector( '.hero-slider' );
	if ( slider && ! reduceMotion ) {
		var slides = slider.querySelectorAll( '.hero-slide' );
		var interval = parseInt( slider.getAttribute( 'data-interval' ), 10 ) || 6000;
		var current = 0;
		if ( slides.length > 1 ) {
			setInterval( function () {
				if ( document.hidden ) {
					return;
				}
				slides[ current ].classList.remove( 'is-active' );
				current = ( current + 1 ) % slides.length;
				slides[ current ].removeAttribute( 'loading' );
				slides[ current ].classList.add( 'is-active' );
			}, interval );
		}
	}

	/* Scroll reveal ---------------------------------------------------- */
	var reveals = document.querySelectorAll( '.reveal' );
	if ( reduceMotion || ! ( 'IntersectionObserver' in window ) ) {
		reveals.forEach( function ( el ) {
			el.classList.add( 'is-visible' );
		} );
	} else {
		body.classList.add( 'js-reveal' );
		var io = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						io.unobserve( entry.target );
					}
				} );
			},
			{ rootMargin: '0px 0px -10% 0px', threshold: 0.1 }
		);
		reveals.forEach( function ( el ) {
			io.observe( el );
		} );
	}

	/* Back to top ------------------------------------------------------ */
	var backTop = document.querySelector( '.back_top' );
	if ( backTop ) {
		var onScroll = function () {
			backTop.classList.toggle( 'is-visible', window.scrollY > 600 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
		backTop.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			window.scrollTo( { top: 0, behavior: reduceMotion ? 'auto' : 'smooth' } );
		} );
	}
} )();
