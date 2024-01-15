<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('css/cart_icon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/dashboard.css'); ?>">

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

</head>

<body>

    <!-- THis below is file is included for navbar -->
    <?php include(APPPATH . 'Views/header/navbar.php'); ?>

    <!-- *************** -->



    <!-- The below html is to list the courses  -->
    <div class="container my-5 py-5 ">


        <?php if (session()->has('isLoggedIn')) : ?>
            <h2>Hey, " <?= session()->get('name') ?> " Welcome to Course Lelo.com </h2>
        <?php else : ?>
            <h2>Hey, Welcome</h2>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($course as $course_item) : ?>

                <div class="col-md-3 my-3">
                    <div class="card h-100">
                        <img src="<?= esc($course_item['course_thumbnail']) ?>" class="card-img-top px-3 py-3" alt="..." height="250px" width="250px">
                        <hr class="divider">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= esc($course_item['course_title']) ?></h5>
                            <p class="card-text"><?= esc($course_item['course_author']) ?></p>
                            <p class="card-text fw-bold"><?= '₹' . esc($course_item['course_price']) ?></p>
                            <button type="button" class="btn btn-primary addToCartBtn" data-bs-toggle="modal" data-bs-target="#exampleModal<?= esc($course_item['course_id']) ?>" data-course-id="<?= esc($course_item['course_id']) ?>" data-course-price="<?= esc($course_item['course_price']) ?>">
                                Buy Now
                            </button>

                            <!-- <a href="#" class="btn btn-primary">Add to cart</a> -->
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= esc($course_item['course_id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Your Courses</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-between align-items-center ">

                                <?php if (session()->has('isLoggedIn')) : ?>
                                    <h3 class="modal-title fs-5" id="exampleModalLabel"><?= esc($course_item['course_title']) ?></h3>
                                    <h3 class="modal-title fs-5 " id="exampleModalLabel"><?= '₹' . esc($course_item['course_price']) ?></h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                <?php else : ?>

                                    <p>You are not signed in, please sign in to purchase.</p>

                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <?php if (session()->has('isLoggedIn')) : ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Proceed to checkout</a>
                                    <!-- <button type="button" class="btn btn-primary">Proceed to checkout</button> -->
                                <?php else : ?>
                                    <a href="<?= base_url('signin') ?>" class="btn btn-primary">Sign in</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>





            <?php endforeach ?>







            <!-- Repeat the following card code block for each card -->

            <!-- Repeat the card code block above for each card -->
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
                const cartCountElement = document.querySelector('.cart-count');
                const addToCartButtons = document.querySelectorAll('.addToCartBtn');
                const isLoggedIn = <?php echo session()->has('isLoggedIn') ? 'true' : 'false'; ?>;

                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        if (isLoggedIn) {
                            const courseId = this.getAttribute('data-course-id');
                            const coursePrice = parseFloat(this.getAttribute('data-course-price'));
                            console.log(typeof(coursePrice));

                            addToCart(courseId, coursePrice); // Call the function to send AJAX request
                        } else {
                            console.log('Login Before adding course');
                        }

                    });
                });

                function addToCart(courseId,coursePrice ) {


                    fetch('/cart/add', { // Replace with the actual URL for adding to cart
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                course_id: courseId,
                                course_price: coursePrice,

                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update UI or show a success message
                                console.log('Course added to cart!');

                                updateCartCount();
                            } else {
                                // Handle error or show error message
                                console.error('Failed to add course to cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

                function updateCartCount() {
                    fetch('/cart/get_cart_count') // Fetch updated cart count
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const cartCount = data.cartCount;
                                cartCountElement.textContent = cartCount > 0 ? cartCount : '';
                            } else {
                                // Handle error or show error message
                                console.error('Failed to fetch cart count');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            }

        );
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>