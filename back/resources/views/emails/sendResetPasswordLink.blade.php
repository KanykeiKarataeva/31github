<!DOCTYPE html>
<html>
<head>
    <title>Reset password!</title>
</head>
<body>


<p>
    {{"You are receiving this email because we received a password reset request for your account."}}
</p>

<p>
    {{route('change.password.form', $email)}}
</p>

<p></p>
</body>
</html>
