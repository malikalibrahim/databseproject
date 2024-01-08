<?php
class UserRegistration
{
    public function registerUser(Database $db, User $user)
    {
        try {
            $existingUser = $db->selectDataByEmail($user->Emailadres);
            if ($existingUser) {
                throw new Exception('<p>Email is already registered. Please use a different email.</p>');
            }
            $db->addUser($user);
            echo '<p>Registration successful. You can now log in.</p>';
            header('Location:login.php');

        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
?>