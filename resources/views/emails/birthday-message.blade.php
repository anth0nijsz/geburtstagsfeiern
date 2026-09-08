<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Birthday message</title></head>
<body style="font-family: Arial, sans-serif; color: #171717; line-height: 1.5;">
    <h1>You received a birthday message.</h1>
    <p><strong>From:</strong> {{ $birthdayMessage->sender_name }}</p>
    <p style="white-space: pre-line; background: #f2eee5; padding: 20px;">{{ $birthdayMessage->message }}</p>
</body>
</html>
