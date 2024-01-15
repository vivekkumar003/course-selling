<?php

namespace App\Controllers;

use App\Models\CartModel;

class DashboardController  extends BaseController
{
    public function dashboard()
    {

        // Load CartModel and EnrollmentModel
        $cartModel = model('CartModel');
        $courseModel = model('CourseModel');
        $enrollmentModel = model('EnrollmentModel');

        $userId = session()->get('id'); // Replace with your session key

        $cartItems = $cartModel->getUserCourses($userId); // This will fetch the list of courses in which this particular id has added in their cart

        $totalCost = $cartModel->getTotalCost($userId); 

        $data = [
            'cartitems' => $cartItems,
            'totalCost' => (float)$totalCost,
        ];
        
        return view('dashboard', $data);
    }
}
