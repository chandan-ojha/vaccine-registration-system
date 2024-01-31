<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vaccination Schedule Mail</title>
</head>
<body>
<h1>Vaccination Schedule Mail</h1>
<p>Dear {{ $user->name }},</p>
<p>Thank you for registering with us. We are pleased to inform you that your vaccination schedule is as follows:</p>
<p><strong>Vaccine Date:</strong> {{ $vaccine->date }}</p>
<p><strong>Vaccine Center:</strong> {{ $vaccine->center }}</p>
<p>Thank you.</p>
<p>Regards,</p>
<p>Team Vaccination</p>
</body>
</html>
