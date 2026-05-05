// document.addEventListener( 'DOMContentLoaded', () => {

// 	const accordions = document.querySelectorAll( '[data-wpn-accordion]' );

// 	accordions.forEach( ( accordion ) => {

// 		const items = accordion.querySelectorAll( '[data-wpn-item]' );

// 		if ( ! items.length ) {
// 			return;
// 		}

// 		let defaultActivated = false;

// 		items.forEach( ( item, index ) => {

// 			const trigger = item.querySelector( '.wpn-accordion-item__nav' );
// 			const panel   = item.querySelector( '.wpn-accordion-item__panel' );

// 			if ( ! trigger || ! panel ) {
// 				return;
// 			}

// 			// Initial state (closed)
// 			panel.style.maxHeight = null;
// 			panel.hidden = true;
// 			trigger.setAttribute( 'aria-expanded', 'false' );

// 			// ✅ Handle default active (via class OR fallback first item)
// 			if (
// 				( item.classList.contains( 'is-default-open' ) && ! defaultActivated ) ||
// 				( ! defaultActivated && index === 0 && ! accordion.querySelector( '.is-default-open' ) )
// 			) {

// 				item.classList.add( 'is-open' );
// 				panel.hidden = false;

// 				// Smooth open (important)
// 				requestAnimationFrame( () => {
// 					panel.style.maxHeight = panel.scrollHeight + 'px';
// 				});

// 				trigger.setAttribute( 'aria-expanded', 'true' );

// 				defaultActivated = true;
// 			}

// 			trigger.addEventListener( 'click', () => {

// 				const isOpen = item.classList.contains( 'is-open' );

// 				// 👉 keep your original "close all" logic
// 				items.forEach( ( i ) => {

// 					const p = i.querySelector( '.wpn-accordion-item__panel' );
// 					const t = i.querySelector( '.wpn-accordion-item__nav' );

// 					i.classList.remove( 'is-open' );

// 					if ( p ) {
// 						p.style.maxHeight = null;

// 						// smoother close (avoid instant cut)
// 						setTimeout( () => {
// 							p.hidden = true;
// 						}, 250 );
// 					}

// 					if ( t ) {
// 						t.setAttribute( 'aria-expanded', 'false' );
// 					}
// 				});

// 				// 👉 keep your original toggle logic
// 				if ( ! isOpen ) {

// 					item.classList.add( 'is-open' );

// 					panel.hidden = false;

// 					// Smooth open
// 					requestAnimationFrame( () => {
// 						panel.style.maxHeight = panel.scrollHeight + 'px';
// 					});

// 					trigger.setAttribute( 'aria-expanded', 'true' );
// 				}
// 			});
// 		});
// 	});
// });


document.addEventListener( 'DOMContentLoaded', () => {

	const accordions = document.querySelectorAll( '[data-wpn-accordion]' );

	accordions.forEach( ( accordion ) => {

		const items = accordion.querySelectorAll( '[data-wpn-item]' );

		if ( ! items.length ) {
			return;
		}

		let defaultActivated = false;

		items.forEach( ( item, index ) => {

			const trigger = item.querySelector( '.wpn-accordion-item__nav' );
			const panel   = item.querySelector( '.wpn-accordion-item__panel' );

			if ( ! trigger || ! panel ) {
				return;
			}

			// Initial state (UNCHANGED)
			panel.style.maxHeight = null;
			panel.hidden = true;
			trigger.setAttribute( 'aria-expanded', 'false' );

			// ✅ ADD: default open support (minimal, safe)
			if (
				( item.classList.contains( 'is-default-open' ) && ! defaultActivated ) ||
				( ! defaultActivated && index === 0 && ! accordion.querySelector( '.is-default-open' ) )
			) {
				item.classList.add( 'is-open' );
				panel.hidden = false;

				// smooth open (no jump)
				requestAnimationFrame( () => {
					panel.style.maxHeight = panel.scrollHeight + 'px';
				});

				trigger.setAttribute( 'aria-expanded', 'true' );
				defaultActivated = true;
			}

			trigger.addEventListener( 'click', () => {

				const isOpen = item.classList.contains( 'is-open' );

				// 👉 your original logic (UNCHANGED)
				items.forEach( ( i ) => {

					const p = i.querySelector( '.wpn-accordion-item__panel' );
					const t = i.querySelector( '.wpn-accordion-item__nav' );

					i.classList.remove( 'is-open' );

					if ( p ) {
						p.style.maxHeight = null;
						p.hidden = true;
					}

					if ( t ) {
						t.setAttribute( 'aria-expanded', 'false' );
					}
				});

				// 👉 your original toggle (UNCHANGED)
				if ( ! isOpen ) {

					item.classList.add( 'is-open' );

					panel.hidden = false;

					// 🔥 enhanced for smooth animation (same line, just wrapped)
					requestAnimationFrame( () => {
						panel.style.maxHeight = panel.scrollHeight + 'px';
					});

					trigger.setAttribute( 'aria-expanded', 'true' );
				}
			});
		});
	});
});