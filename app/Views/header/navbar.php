<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url() ?>">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Courses
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Web Development</a></li>
                        <li><a class="dropdown-item" href="#">Linux Adminstrator</a></li>
                        <li><a class="dropdown-item" href='#'>Python</a></li>
                        <li><a class="dropdown-item" href="#">Ethical Hacking</a></li>
                    </ul>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <!-- Sign In Button with Bootstrap button classes for students -->

                    <?php if (session()->has('isLoggedIn')) : ?>
                        <a href="/signout" class="btn btn-danger">Sign Out </a>
                    <?php else : ?>
                        <a href="/signin" class="btn btn-success">Sign In </a>
                    <?php endif; ?>

                    <!-- Sign In Button with Bootstrap button classes for instructor -->
                    <a href="<?= base_url() ?>/instructor_login" class="btn btn-info">Teach</a>


                </li>
                <li class="nav-item">
                    <a class="nav-link cart-button" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-shopping-cart"></i> View Cart


                        <!-- showing the cart count icon above the view cart dynamically -->
                        <?php if (session()->has('isLoggedIn')) : ?>
                            <span class="cart-count"></span>
                        <?php endif; ?>

                    </a>
                </li>

            </ul>


            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>


                <?php if (session()->has('user_id')) : ?>

                    <a href="<?= base_url() ?>/signout" class="btn btn-danger">Sign Out </a>
                <?php endif; ?>

            </form>




            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const cartCountElement = document.querySelector('.cart-count');
                    const isLoggedIn = <?php echo session()->has('isLoggedIn') ? 'true' : 'false'; ?>;
                    const addToCartButtons = document.querySelectorAll('.addToCartBtn');

                    // Fetch and update cart count using 




                    if (isLoggedIn) {


                        function updateCartCount() {
                            fetch('/cart/get_cart_count') // Create a new method in CartController to get cart count
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        cartCountElement.textContent = data.cartCount;
                                        console.log(data.cartCount);
                                    } else {
                                        // Handle error or show error message
                                        console.error('Failed to fetch cart count');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });

                        }
                        updateCartCount()

                    }

                });
            </script>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url('images/Profile.png') ?>" alt="My Profile" class="profile-image" style="height: 25px; width: 30px">
                    </a>
                    <ul class="dropdown-menu custom-css" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="<?=base_url('profile') ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('mycourses') ?>">My Courses</a></li>
                    </ul>
                </li>

            </ul>








        </div>
    </div>
</nav>



<?php base_url() ?>