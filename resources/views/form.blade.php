<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود به سایت</title>
</head>
<body>
<form action="/login" method="post">
    @csrf
    <div>
        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">ورود</button>
    </div>
</form>
</body>
</html>
