import {
	InnerBlocks,
	RichText,
	URLInputButton,
	useBlockProps,
} from '@wordpress/block-editor';

const TEMPLATE = [
	[ 'wooapb/growth-result-item' ],
	[ 'wooapb/growth-result-item' ],
	[ 'wooapb/growth-result-item' ],
	[ 'wooapb/growth-result-item' ],
];

const ALLOWED_BLOCKS = [ 'wooapb/growth-result-item' ];

export default function Edit( { attributes, setAttributes } ) {
	const { title, highlight, buttonText, buttonUrl } = attributes;

	return (
		<section { ...useBlockProps() }>
			<div className="wpn-results-grid">
				<div className="wpn-results-grid__featured">

					<h2>
						<RichText
							tagName="span"
							value={ title }
							onChange={ ( value ) => setAttributes( { title: value } ) }
						/>

						<RichText
							tagName="em"
							value={ highlight }
							onChange={ ( value ) => setAttributes( { highlight: value } ) }
						/>
					</h2>

					<RichText
						tagName="a"
						className="wpn-results-grid__button"
						value={ buttonText }
						onChange={ ( value ) => setAttributes( { buttonText: value } ) }
					/>

					<URLInputButton
						url={ buttonUrl }
						onChange={ ( value ) => setAttributes( { buttonUrl: value } ) }
					/>
				</div>

				<div className="wpn-results-grid__items">
					<InnerBlocks
						allowedBlocks={ ALLOWED_BLOCKS }
						template={ TEMPLATE }
					/>
				</div>
			</div>
		</section>
	);
}
