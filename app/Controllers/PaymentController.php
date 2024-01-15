<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\EnrollmentModel;

class PaymentController extends BaseController
{
    public function processPayment()
    {
        // Get the POST data from the form
        $totalAmount = $this->request->getPost('totalAmount');
        $userId = $this->request->getPost('user_id');

        // Get the courseIds from the form
        $courseIds = $this->request->getPost('course_id[]');

        // In processPayment method
        session()->set('course_ids', $courseIds);


        // Check if $courseIds is an array and not empty
        if (is_array($courseIds) && !empty($courseIds)) {
            // Initialize Razorpay using your API keys from Config
            $razorpayConfig = config('Razorpay');
            $razorpay = new \Razorpay\Api\Api($razorpayConfig->keyId, $razorpayConfig->keySecret);

            // Create an order with Razorpay
            $orderData = [
                'amount' => $totalAmount * 100, // Razorpay accepts amount in paise, so convert to paise
                'currency' => 'INR',
                'receipt' => 'order_receipt_' . uniqid(),
            ];

            try {
                $order = $razorpay->order->create($orderData);

                // Set the courseIds in the session
                session()->set('course_ids', $courseIds);

                // Pass the order details to the Razorpay Checkout view
                return view('payment/razorpay_checkout', [
                    'order' => $order,
                ]);
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., show an error message to the user
                return redirect()->to('payment/error')->with('error', $e->getMessage());
            }
        } else {
            // Handle the case where $courseIds is not an array or is empty
            // You can redirect or show an error message as needed.
        }
    }


    public function success()
    {
        // Get the Razorpay payment ID and signature from the POST request
        $paymentId = $this->request->getPost('razorpay_payment_id');
        $orderId = $this->request->getPost('razorpay_order_id');
        $signature = $this->request->getPost('razorpay_signature');

        // $courseIds = $this->request->getPost('course_id[]');
        // In success method
        $courseIds = session()->get('course_ids');
        $userId = session()->get('id');


        // Initialize Razorpay using your API keys from Config
        $razorpayConfig = config('Razorpay');
        $razorpay = new \Razorpay\Api\Api($razorpayConfig->keyId, $razorpayConfig->keySecret);

        // Calculate the HMAC hex digest
        $generatedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $razorpayConfig->keySecret);

        // Verify the payment signature
        if ($generatedSignature === $signature) {
            // Payment verification is successful

            // Now, add logic here to enroll the user in courses and mark orders as paid
            // You may use your EnrollmentModel for this purpose

            // For example, you can insert enrollment records for each course in the database
            $enrollmentModel = model('EnrolledCoursesModel');
            foreach ($courseIds as $courseId) {
                $enrollmentModel->insert([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'payment_status' => 'paid', // Set payment status to 'paid'
                ]);

                // Remove the course from the user's cart
                $cartModel = model('CartModel');
                $cartModel->where('user_id', $userId)->where('course_id', $courseId)->delete();
            }

            // Redirect to a success page or return a success message
            // Fetch paid courses for the user
            $paidCourses = $enrollmentModel->getPaidCourses($userId);

            // echo var_dump($paidCourses);

            // Load the view and pass the data
            return view('courses/my_courses', ['paidCourses' => $paidCourses]);
             
        } else {
            // Payment verification failed
            $data['error_message'] = 'Payment verification failed. The signature does not match.';
            $data['verification_attributes'] = $signature; // Pass the signature to the error view

            return view('payment/error', $data);
        }
    }



    public function error()
    {
        // Retrieve the error message from the session
        $errorMessage = session()->getFlashdata('error');


        // Load the error view and pass the error message
        return view('payment/error', ['errorMessage' => $errorMessage]);
    }


    // public function verifyPayment($paymentId, $signature, $userId, $courseIds)
    // {


    //     // Initialize Razorpay using your API keys from Config
    //     $razorpayConfig = config('Razorpay');
    //     $razorpay = new \Razorpay\Api\Api($razorpayConfig->keyId, $razorpayConfig->keySecret);

    //     // Verify the payment using the Razorpay API
    //     $attributes = array(
    //         'razorpay_payment_id' => $paymentId,
    //         'razorpay_order_id' => $this->request->getPost('razorpay_order_id'),
    //         'razorpay_signature' => $signature,
    //     );

    //     $verificationStatus = false;

    //     if ($razorpay->utility->verifyPaymentSignature($attributes)) {
    //         // Payment verification is successful
    //         $verificationStatus = true;
    //     }

    //     if ($verificationStatus) {
    //         // Now, add logic here to enroll the user in courses and mark orders as paid
    //         // You may use your EnrollmentModel for this purpose

    //         // For example, you can insert enrollment records for each course in the database
    //         $enrollmentModel = model('EnrolledCoursesModel');
    //         foreach ($courseIds as $courseId) {
    //             $enrollmentModel->insert([
    //                 'user_id' => $userId,
    //                 'course_id' => $courseId,
    //                 'payment_status' => 'paid', // Set payment status to 'paid'
    //             ]);

    //             // Remove the course from the user's cart
    //             $cartModel = model('CartModel');
    //             $cartModel->where('user_id', $userId)->where('course_id', $courseId)->delete();
    //         }
    //     }

    //     // Return the verification status (true if successful, false if failed)
    //     return $verificationStatus;
    // }




}
