<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentSignup extends Model
{
    protected $table = 'Users'; // Update table name accordingly
    protected $primaryKey = 'id'; // Update primary key column name accordingly
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'role']; // Update fields accordingly
    // protected $useTimestamps = true;

    public function createUser($data)
    {
        return $this->insert($data);
    }

    public function getUserByEmail($email)
    {

        return $this->where('email', $email)->first();
        
    }


}