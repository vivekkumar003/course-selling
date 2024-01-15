<?php

// EnrollmentModel.php

namespace App\Models;

use CodeIgniter\Model;

class EnrolledCoursesModel extends Model
{
    protected $table = 'Enrollments';
    protected $primaryKey = 'enrollment_id';
     // Define the allowed fields
     protected $allowedFields = [
        'user_id',
        'course_id',
        'payment_status',
        // Add other fields here that are allowed to be mass-assigned
    ];

    // Add a method to get paid courses for a user
    public function getPaidCourses($userId)
    {
        $query = $this->db->table('Enrollments')
            ->select('Courses.course_title, Courses.course_author, Courses.course_thumbnail, Enrollments.payment_status, Enrollments.enrollment_date')
            ->join('Courses', 'Enrollments.course_id = Courses.course_id')
            ->where('Enrollments.user_id', $userId)
            ->get();

        return $query->getResult();
    }
}
