import { InnerBlocks, RichText } from '@wordpress/block-editor';

const TEMPLATE = [
	[ 'wpn/accordion-item' ],
	[ 'wpn/accordion-item' ],
	[ 'wpn/accordion-item' ]
];

export default function Edit( { attributes, setAttributes } ) {
	const { title, description } = attributes;

	return (
		<div className="wpn-accordion">
			<RichText
				tagName="h2"
				value={ title }
				onChange={ ( value ) => setAttributes( { title: value } ) }
				placeholder="Add title..."
			/>

			<RichText
				tagName="p"
				value={ description }
				onChange={ ( value ) => setAttributes( { description: value } ) }
				placeholder="Add description..."
			/>

			<div className="wpn-accordion__wrapper">
				<InnerBlocks
					allowedBlocks={ [ 'wpn/accordion-item' ] }
					template={ TEMPLATE }
					orientation="horizontal"
				/>
			</div>
		</div>
	);
}