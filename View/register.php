<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="/register" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
