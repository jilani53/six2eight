import { InnerBlocks, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { title, description } = attributes;

	return (
		<div className="wpn-accordion" data-wpn-accordion>
			<div className="wpn-accordion__header">
				<RichText.Content tagName="h2" value={ title } />
				<RichText.Content tagName="p" value={ description } />
			</div>

			<div className="wpn-accordion__body">
				<div className="wpn-accordion__nav" data-wpn-nav>
					<InnerBlocks.Content />
				</div>

				<div className="wpn-accordion__content" data-wpn-content></div>
			</div>
		</div>
	);
}