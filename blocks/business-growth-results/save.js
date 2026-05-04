import {
	InnerBlocks,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { title, highlight, buttonText, buttonUrl } = attributes;

	return (
		<section { ...useBlockProps.save() }>
			<div className="wpn-results-grid">
				<div className="wpn-results-grid__featured">
					<h2>
						<RichText.Content value={ title } />
						<em>
							<RichText.Content value={ highlight } />
						</em>
					</h2>

					<a href={ buttonUrl } className="wpn-results-grid__button">
						{ buttonText }
					</a>
				</div>

				<div className="wpn-results-grid__items">
					<InnerBlocks.Content />
				</div>
			</div>
		</section>
	);
}