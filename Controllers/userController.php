<?php
require_once './Models/User.php';

class UserController {
    // Login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = User::findByUsername($username);
            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                header('Location: /dashboard');  // Redirection vers le tableau de bord
            } else {
                $error = 'Identifiants incorrects';
                require 'view/login.php';
            }
        } else {
            require 'view/login.php';
        }
    }

    // Logout
    public function logout() {
        session_destroy();
        header('Location: /login');
    }

    // Register
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->username = $_POST['username'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->name = $_POST['name'];
            $user->surname = $_POST['surname'];
            $user->address = $_POST['address'];
            $user->save();

            header('Location: login');
        } else {
            require 'view/register.php';
        }
    }

    // Edit Profile
    public function editProfile() {
        $user_id = $_SESSION['user_id'];
        $user = User::findById($user_id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Mise à jour du profil
        } else {
            // Assurez-vous que $user est transmis à la vue
            include 'View/editprofil.php';
        }
    }
    
    // Delete Account
    public function deleteAccount() {
        $user_id = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = User::findById($user_id);
            $user->delete();

            session_destroy();
            header('Location: /');
        } else {
            require 'view/deleteAccount.php';
        }
    }
}
?>
