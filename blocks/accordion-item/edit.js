import { RichText, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { title, content, isDefaultOpen } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title="Accordion Settings">
					<ToggleControl
						label="Open by default"
						checked={ !! isDefaultOpen }
						onChange={ ( value ) =>
							setAttributes( { isDefaultOpen: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div className="wpn-accordion-item">
				<RichText
					tagName="div"
					className="wpn-accordion-item__title"
					value={ title }
					onChange={ ( value ) =>
						setAttributes( { title: value } )
					}
				/>

				<div className="wpn-accordion-item__content">
					<InnerBlocks
						template={[
							[
								'core/paragraph',
								{ content: 'Add your accordion content here...' }
							]
						]}
						templateLock={ false }
					/>
				</div>
			</div>
		</>
	);
}