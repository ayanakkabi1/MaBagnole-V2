<?php
include_once 'classes/user.php';
class Admin extends user{
    public function __construct(int $id, string $nom, string $email, string $motDePasseHash, string $role)
    {
        return parent::__construct($id, $nom, $email, $motDePasseHash, $role);
    }
}
?>