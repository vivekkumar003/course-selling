<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentSignup extends Model
{
    protected $table = 'Cart'; // Set the table name
    protected $primaryKey = 'cart_id'; // Set the primary key column
    protected $allowedFields = ['user_id', 'course_id', 'course_price']; // Specify the fields that can be inserted/updated


    public function isCourseInCart($user_id, $course_id)
    {
        $query = $this->where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->countAllResults();

        return $query > 0;
    }


    public function getUserCourses($user_id)
    {
        return $this->select('Cart.course_id, Cart.user_id, Courses.course_title, Courses.course_thumbnail, Courses.course_author, Cart.course_price')
            ->join('Courses', 'Courses.course_id = Cart.course_id')
            ->where('Cart.user_id', $user_id)
            ->findAll();
    }


    
    public function getTotalCost($user_id)
    {
        $result = $this->selectSum('course_price')
                       ->where('user_id', $user_id)
                       ->first();
    
        return $result ? $result['course_price'] : 0;
    }
    

}
