<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url('css/cart_icon.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/dashboard.css'); ?>">
</head>

<body>

    <!-- THis below is file is included for navbar -->
    <?php include(APPPATH . 'Views/header/navbar.php'); ?>

    <!-- *************** -->


    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Purchased Courses</h5>
                        </div>
                        <div class="card-body">

                            <?php foreach ($paidCourses as $yourCourse) : ?>
                                <!--  item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                            <img src="<?= $yourCourse->course_thumbnail ?>" class="w-100" alt="Error fetching image" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong> <?= $yourCourse->course_title ?></strong></p>
                                        <p><strong> <?= 'By   ' . esc($yourCourse->course_author) ?></strong></p>
                                        <button class="btn btn-success">Start Learning</button>

                                        <!-- Data -->
                                    </div>

                                   
                                </div>
                                <!--  item -->
                                <hr class="my-4" />
                            <?php endforeach; ?>




                            <!-- Single item -->
                        </div>
                    </div>


                </div>
                
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>