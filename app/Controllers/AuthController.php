<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Show login page (optional if you have a view)
    public function loginView()
    {
        return view('login');
    }

    // Handle login
    public function login()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Check if username exists
        $user = $userModel->checkUser($username);

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['username']
            ]);

            return redirect()->to('/expenses'); // redirect to dashboard after login
        }

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    // Logout user
    public function logout()
    {
    session()->destroy();
    return redirect()->to('/?logout=1');
    }
}
