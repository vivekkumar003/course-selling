<?php

namespace App\Controllers;

use App\Models\CourseModel;

class Home extends BaseController
{
    public function index()
    {

        $model = model(CourseModel::class);

        $data = [
            'course'  => $model->getCourse(),
        ];

        return view('home_page', $data);
    }
}
