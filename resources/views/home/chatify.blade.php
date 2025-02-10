<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatify</title>

    <!-- Include Chatify CSS -->
    <link rel="stylesheet" href="{{ asset('css/chatify/style.css') }}">
</head>
<body>
    <div id="chatify" style="height: 100vh;"></div>

    <!-- Include Chatify JS -->
    <script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
    <script src="{{ asset('js/chatify/utils.js') }}"></script>
    <script src="{{ asset('js/chatify/autosize.js') }}"></script>
    <script src="{{ asset('js/chatify/code.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Directly open chat with the admin user
            Chatify.startChat({ user_id: "{{ $adminId }}" });
        });
    </script>
</body>
</html>
