<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\StudentSignin;
use App\Models\StudentSignup;





class Users extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('signin_page');
    }


    public function authenticate()
    {
        $model = model(StudentSignup::class);   //The model here uses StudentSignup to authenticate any student if he signsup 
        
        helper(['form']);

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if ($this->validate($rules)) {

            if ($this->request->is('post')) {


                $details = $this->request->getPost(['email', 'password']);

                $user = $model->getUserByEmail($details['email']);

                // $cart = $cartmodel->getSignedInUserDetails('email');


                if ($user) {

                    $pass = $user['password'];

                    if (password_verify($details['password'], $pass)) {

                        $ses_data = [
                            'id' => $user['user_id'],
                            'name' => $user['first_name'],
                            'email' => $user['email'],
                            'isLoggedIn' => TRUE
                        ];

                       
                       

                        session()->set($ses_data);
                        return redirect()->to('/courses');
                    } else {
                        session()->setFlashdata('error', 'Invalid password');
                        // return redirect()->to('signin');
                    }
                } else {
                    session()->setFlashdata('error', 'Invalid email address');
                    // return redirect()->to('siginin');
                }
            }
        }




        return view('signin_page');
    }


    public function signout()
    {
       
        

        // Load the session library
        $session = \Config\Services::session();


        // Destroy the session
        $session->destroy();


        return redirect()->to('courses'); // Redirect to the home
    }


    public function student_signup()
    {

        $model = model(StudentSignup::class);

        helper(['form']);

        if ($this->request->is('post')) {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|valid_email|is_unique[Users.email]',
                'password' => 'required|min_length[3]',
                'confirm_password' => 'required|matches[password]',
                'role' => 'required'
            ];

            if ($this->validate($rules)) {

                $data = [
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => $this->request->getPost('role')
                ];

                $model->createUser($data);

                return redirect()->to('signin'); // Redirect to a success page or wherever you want
            } else {
                return view('signup_page');
            }
        }

        return view('signup_page'); // Load the signup page

    }
}
