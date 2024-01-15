<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'Courses';

    protected $allowedFields = ['title', 'content'];



    public function getCourse()
{
   
        return $this->findAll();

}


    public function getEnrolledCourses()
{
   
        return $this->findAll();

}




}