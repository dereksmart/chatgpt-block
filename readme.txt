# ChatGPT Block for WordPress

This custom Gutenberg block allows you to generate content using OpenAI's ChatGPT within the WordPress block editor. Enter a ChatGPT prompt, and the block will generate content based on the provided prompt.

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- Node.js and npm for building the block
- An OpenAI API key

## Installation

1. Clone or download this repository to your local machine.
2. Navigate to the `chatgpt-block` directory in your terminal and run `npm install` to install the required dependencies.
3. Run `npm run build` to build the block.
4. In your WordPress installation, go to **Plugins** > **Add New** > **Upload Plugin**, and upload the `chatgpt-block` folder as a .zip file.
5. Activate the plugin.

## Configuration

1. Go to **Settings** > **ChatGPT Settings** in your WordPress admin dashboard.
2. Enter your OpenAI API key in the **API Key** field and save the settings.

## Usage

1. Create a new post or page, or edit an existing one in your WordPress admin dashboard.
2. Add a new block by clicking the **+** icon and search for "chatgpt" in the block search bar.
3. Select the **ChatGPT Block**.
4. Enter a ChatGPT prompt in the block and click **Generate Content**.
5. The generated content will be displayed within the block. You can edit or format the content as needed.

## License

This project is licensed under the [GNU General Public License v2.0](LICENSE).
