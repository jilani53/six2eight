import { RichText, InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { title, content, isDefaultOpen } = attributes;

	const className = [
		'wpn-accordion-item',
		isDefaultOpen ? 'is-default-open' : '',
	]
		.filter( Boolean )
		.join( ' ' );

	return (
		<div className={ className } data-wpn-item>
			<div className="wpn-accordion-item__nav">
				<RichText.Content value={ title } />
				<div className="wpn-accordion-item-icon__container">
					<span className="wpn-accordion-item__icon plus-icon">+</span>
					<span className="wpn-accordion-item__icon minus-icon">-</span>
				</div>
			</div>

			<div className="wpn-accordion-item__panel">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}