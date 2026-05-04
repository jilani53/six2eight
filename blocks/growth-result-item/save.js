import {
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { amount, suffix, growth, description } = attributes;

	return (
		<div { ...useBlockProps.save() }>
			<h3>
				<RichText.Content value={ amount } />
				<span>
					<RichText.Content value={ suffix } />
				</span>
			</h3>

			<p className="wpn-result-growth">
				<RichText.Content value={ growth } />
			</p>

			<p>
				<RichText.Content value={ description } />
			</p>
		</div>
	);
}