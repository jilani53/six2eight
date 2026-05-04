import {
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {
	const { amount, suffix, growth, description } = attributes;

	return (
		<div { ...useBlockProps() }>
			<h3>
				<RichText
                    tagName="em"
					value={ amount }
					onChange={ ( value ) => setAttributes( { amount: value } ) }
					className="wpn-amount"
				/>
				<RichText
					tagName="span"
					value={ suffix }
					onChange={ ( value ) => setAttributes( { suffix: value } ) }
					className="wpn-suffix"
				/>
			</h3>

			<RichText
				tagName="p"
				className="wpn-result-growth"
				value={ growth }
				onChange={ ( value ) => setAttributes( { growth: value } ) }
			/>

			<RichText
				tagName="p"
				value={ description }
				onChange={ ( value ) => setAttributes( { description: value } ) }
			/>
		</div>
	);
}