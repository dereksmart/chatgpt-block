import { useState } from '@wordpress/element';
import { TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit({ setAttributes, attributes }) {
	const blockProps = useBlockProps();
	const [prompt, setPrompt] = useState('');

	const generateContent = async () => {
		const response = await fetch('/wp-json/chatgpt/v1/generate-content', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({
				prompt: prompt,
				max_tokens: 100, // Adjust the number of tokens as needed
			}),
		});

		const data = await response.json();
		const content = data.choices[0].text.trim();

		setAttributes({ content: content });
	};

	return (
		<div {...blockProps}>
			<TextControl
				label={__('ChatGPT Prompt', 'chatgpt-block')}
				value={prompt}
				onChange={(value) => setPrompt(value)}
			/>
			<Button isPrimary onClick={generateContent}>
				{__('Generate Content', 'chatgpt-block')}
			</Button>
			<div className="generated-content">
				{attributes.content}
			</div>
		</div>
	);
}
