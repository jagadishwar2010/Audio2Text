<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Audio Transcription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        /* CSS */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #transcription-form {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #f5f5f5;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin-top: 0;
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin-top: 20px;
            color: #555;
        }

        input[type=file] {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        select {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input[type=submit] {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type=submit]:hover {
            background-color: #0056b3;
        }

        #transcription-results {
            margin-top: 20px;
            padding: 20px;
            font-size: 18px;
            line-height: 1.5;
            color: #333;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
<h1>Audio Transcription</h1>
<form id="transcription-form" method="POST" action="{{ route('transcribe') }}" enctype="multipart/form-data">
    @csrf
    <label for="audio-file-input">Select an audio file to transcribe:</label>
    <input id="audio-file-input" type="file" name="audio-file" accept="audio/wav,audio/mpeg,audio/mp3,audio/flac" required>

    <label for="language-input">Select the input language:</label>
    <select id="language-input" name="language-input" required>
        <option value="">-- Please select --</option>
        <option value="en">English</option>
        <option value="fr">French</option>
        <option value="es">Spanish</option>
        <option value="de">German</option
        <option value="it">Italian</option>
        <option value="pt">Portuguese</option>
        <option value="ru">Russian</option>
        <option value="zh">Chinese</option>
        <option value="ja">Japanese</option>
        <option value="ko">Korean</option>
    </select>

    <input type="submit" value="Transcribe">
</form>

<div id="transcription-results"></div>

<script>
    // jQuery
    const transcriptionForm = $('#transcription-form');
    const transcriptionResults = $('#transcription-results');

    transcriptionForm.submit((e) => {
        e.preventDefault();

        // Display loading message
        transcriptionResults.html('<p>Loading...</p>');

        // Send form data to server using AJAX
        const formData = new FormData(transcriptionForm[0]);
        $.ajax({
            url: transcriptionForm.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                // Display transcription results
                transcriptionResults.html(`<p>${data}</p>`);
            },
            error: (error) => {
                console.error(error);
                transcriptionResults.html('<p>An error occurred while transcribing the audio.</p>');
            }
        });
    });
</script>
</body>
</html>
