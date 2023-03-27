# Audio2Text using OpenAI's API and Laravel

## Overview

This is a Laravel web app that uses OpenAI's API for converting audio to text. The app uses cURL to make requests to the OpenAI API and returns the converted text.

## Requirements

- PHP >= 7.4
- Laravel >= 8.0
- cURL extension for PHP

## Installation

1. Clone the repository:  `git clone https://github.com/your-username/audio2text.git`
2. Change to the project directory: `cd audio2text`
3. Install composer dependencies: `composer install`
4. Copy the `.env.example` file to `.env`: `cp .env.example .env`
5. Generate a new application key: `php artisan key:generate`
6. Set up your OpenAI API credentials in the `.env` file: `OPENAI_SECRET_KEY=your-secret-key-here`
7. Run the Laravel development server: `php artisan serve`


## Usage

1. Upload an audio file (supported formats are mp3, wav, and flac) to the app.
2. Wait for the app to convert the audio file to text using OpenAI's API.
3. The converted text will be displayed on the screen.

## Troubleshooting

If you encounter any issues with the app, please check the Laravel logs located in the `storage/logs` directory for error messages.

## Credits

This app was created by [Jagadeeshwar Goshika](https://github.com/jagadishwar2010) using Laravel and OpenAI's API.

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).



