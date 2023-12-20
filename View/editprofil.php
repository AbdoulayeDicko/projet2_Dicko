<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="/editProfil" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user->name; ?>"><br><br>

        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php echo $user->surname; ?>"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $user->address; ?>"><br><br>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
