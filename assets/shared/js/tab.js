
/** 
 * Accordion
 */
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

			// Initial state
			panel.style.maxHeight = null;
			panel.hidden = true;
			trigger.setAttribute( 'aria-expanded', 'false' );

			// Default open
			if (
				( item.classList.contains( 'is-default-open' ) && ! defaultActivated ) ||
				( ! defaultActivated && index === 0 && ! accordion.querySelector( '.is-default-open' ) )
			) {
				item.classList.add( 'is-open' );
				panel.hidden = false;

				requestAnimationFrame( () => {
					panel.style.maxHeight = panel.scrollHeight + 'px';
				});

				trigger.setAttribute( 'aria-expanded', 'true' );
				defaultActivated = true;
			}

			trigger.addEventListener( 'click', () => {

                const isOpen = item.classList.contains( 'is-open' );
            
                // Close all other items only.
                items.forEach( ( i ) => {
            
                    if ( i === item ) return;
            
                    const p = i.querySelector( '.wpn-accordion-item__panel' );
                    const t = i.querySelector( '.wpn-accordion-item__nav' );
            
                    i.classList.remove( 'is-open' );
            
                    if ( p ) {
                        p.style.maxHeight = null;
            
                        // simple + stable (no animation break)
                        p.hidden = true;
                    }
            
                    if ( t ) {
                        t.setAttribute( 'aria-expanded', 'false' );
                    }
                });
            
                // Toggle current item.
                if ( ! isOpen ) {
            
                    item.classList.add( 'is-open' );
            
                    panel.hidden = false;
            
                    requestAnimationFrame( () => {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    });
            
                    trigger.setAttribute( 'aria-expanded', 'true' );
            
                } else {
            
                    item.classList.remove( 'is-open' );
            
                    panel.style.maxHeight = null;
                    panel.hidden = true;
            
                    trigger.setAttribute( 'aria-expanded', 'false' );
                }
            });
		});
	});
});