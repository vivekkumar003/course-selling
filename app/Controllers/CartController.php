<?php

namespace App\Controllers;

use App\Models\CartModel;

class CartController extends BaseController
{
    public function add()
    {
        $cartModel = model(CartModel::class);


        // Retrieve the course ID from the AJAX request
        $courseId = $this->request->getJSON(true)['course_id'];
        $coursePrice = $this->request->getJSON(true)['course_price'];
       
        // Add the course to the cart using the CartModel
        // Get the user's ID from the session
        $user_id = session()->get('id');

        $isCourseInCart = $cartModel->isCourseInCart($user_id, $courseId);

        if (!$isCourseInCart) {

            $data = [
                'user_id' => $user_id, // Replace with the actual user's ID
                'course_id' => $courseId,
                'course_price' => $coursePrice,
            ];

            $success = $cartModel->insert($data);

            // Calculate the updated cart count
            $updatedCartCount = $cartModel->where('user_id', $user_id)->countAllResults();

            // Send JSON response indicating success or failure
            return $this->response->setJSON(['success' => $success, 'cartCount' => $updatedCartCount]);
        }
    }


    public function countCart()
    {
        $userId = session()->get('id'); // Adjust this as per your session key
        $cartModel = model(CartModel::class);

        $cartCount = $cartModel->where('user_id', $userId)->countAllResults();

        // Load the rendered navbar view


        return $this->response->setJSON(['success' => true, 'cartCount' => $cartCount]);
    }
}
