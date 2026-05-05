import { RichText } from '@wordpress/block-editor';

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
				<span className="wpn-accordion-item__icon">+</span>
				<RichText.Content value={ title } />
			</div>

			<div className="wpn-accordion-item__panel">
				<RichText.Content value={ content } />
			</div>
		</div>
	);
}