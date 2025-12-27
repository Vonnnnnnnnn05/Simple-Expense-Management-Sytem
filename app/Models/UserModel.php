<?php
namespace App\Models;

 use CodeIgniter\Model;

 class UserModel extends Model
 {
 protected $table = 'users';
 protected $primaryKey = 'id';

 protected $allowedFields = ['username', 'password'];

 // Method to check user credentials
 public function checkUser($username)
 {
 return $this->where('username', $username)->first();
 }

 // Hash password using bcrypt
 public function hashPassword($password)
 {
 return password_hash($password, PASSWORD_BCRYPT);
 }
 }