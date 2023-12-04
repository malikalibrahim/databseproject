<?php
 
class UserRegistration
{
    public function registerUser(Database $db, User $user)
    {
        try {
            $existingUser = $db->selectDataByEmail($user->Emailadres);
            if ($existingUser) {
                throw new Exception("Email is already registered. Please use a different email.");
            }
            $db->addUser($user);
            echo "Registration successful. You can now log in.";
        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
 
?>