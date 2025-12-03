<?php

class UserManager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(User $user)
    {
        $req = $this->db->prepare(
            'INSERT INTO users ( lastName, firstName, email, address, postalCode, city, password, admin )
            VALUES ( :lastName, :firstName, :email, :address, :cp, :city, :password, 0 )'
        );
        $req->execute(
            array(
                'lastName' => $user->getLastName(),
                'firstName' => $user->getFirstName(),
                'email' => $user->getEmail(),
                'address' => $user->getAddress(),
                'cp' => $user->getPostalCode(),
                'city' => $user->getCity(),
                'password' => $user->getPassword()
            )
        );
    }
    public function update(User $user)
    {
        $req = $this->db->prepare(
            'UPDATE users
             SET lastName=:lastName, firstName=:firstName, email=:email,
                 address=:address, postalCode=:cp, city=:city
             WHERE id=:id'
        );
        $req->execute([
            'lastName' => $user->getLastName(),
            'firstName' => $user->getFirstName(),
            'email' => $user->getEmail(),
            'address' => $user->getAddress(),
            'cp' => $user->getPostalCode(),
            'city' => $user->getCity(),
            'id' => $user->getId()
        ]);
    }

    public function delete(User $user)
    {
        $req = $this->db->prepare(
            'DELETE FROM users WHERE id=:id'
        );
        $req->execute([
            'id' => $user->getId()
        ]);
    }

    public function findOne($id)
    {
        $req = $this->db->prepare(
            'SELECT * FROM users WHERE id=:id'
        );
        $req->execute([
            'id' => $id
        ]);
        return $req->fetchAll();
    }

    public function findOneByEmail($email)
    {
        $req = $this->db->prepare(
            'SELECT * FROM users WHERE email=:email'
        );
        $req->execute([
            'email' => $email
        ]);
        return $req->fetch();
    }

    public function findAll()
    {
        $req = $this->db->prepare(
            'SELECT * FROM users'
        );
        $req->execute();
        return $req->fetchAll();
    }
}
