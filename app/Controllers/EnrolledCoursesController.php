<?php

// MyCoursesController.php

namespace App\Controllers;

use App\Models\EnrolledCoursesModel;

class EnrolledCoursesController extends BaseController
{
    public function purchasedCourses()
    {
        // Check if the user is logged in
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/signin');
        }

        // Get the user's ID from the session
        $userId = session()->get('id');

        // Load the EnrollmentModel
        $enrollmentModel = model('EnrolledCoursesModel');

        // Fetch paid courses for the user
        $paidCourses = $enrollmentModel->getPaidCourses($userId);

        // echo var_dump($paidCourses);

        // Load the view and pass the data
        return view('courses/my_courses', ['paidCourses' => $paidCourses]);
    }
}
