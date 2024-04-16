# Slideshare Downloader

**Slideshare Downloader** is a web application that allows users to download PowerPoint presentations from Slideshare.net. The application is built with Laravel, and Livewire to provide a seamless and interactive user experience.

## Demo

You can try the live demo of this application at: [slideshare.maviism.com](https://slideshare.maviism.com)

## Features

- **URL Input**: Users can input the URL of a document they want to download.
- **Download Button**: Downloads the specified document in the chosen format.
- **Clear Button**: Clears the input field.
- **Validation**: Validates the input URL to ensure it is a valid URL.
- **Error Display**: Displays validation error messages if the input URL is invalid.
- **Loading Indicator**: Shows a loading indicator while the download is in progress.
- **Button State Management**: Disables the download button when the input field is empty and changes the button color based on the state.

## Technologies

- **Laravel**: A PHP web application framework used for the backend.
- **Livewire**: A Laravel package that provides a reactive component-based architecture.
- **PhpPresentation**: A PHP library for working with PowerPoint presentations.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/Maviism/slideshare-downloader.git
    ```

2. Navigate to the project directory:

    ```bash
    cd slideshare-downloader
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies:

    ```bash
    npm install
    ```

5. Copy the `.env` file and configure it with your database and other settings:

    ```bash
    cp .env.example .env
    ```

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Migrate the database:

    ```bash
    php artisan migrate
    ```

## Usage

1. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

2. Access the application in your web browser at `http://localhost:8000`.

3. Enter the URL of the document you want to download in the input field.

4. Click the "Download" button to initiate the download process.

5. If the input field is empty, the download button will be disabled.

6. If there are validation errors, they will be displayed below the input field.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request.


