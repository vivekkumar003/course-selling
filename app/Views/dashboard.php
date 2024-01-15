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
                            <h5 class="mb-0">Cart-items</h5>
                        </div>
                        <div class="card-body">

                            <?php foreach ($cartitems as $cartitem) : ?>
                                <!--  item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                            <img src="<?= esc($cartitem['course_thumbnail']) ?>" class="w-100" alt="Error fetching image" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong> <?= esc($cartitem['course_title']) ?></strong></p>
                                        <p><strong> <?= 'By   ' . esc($cartitem['course_author']) ?></strong></p>
                                        <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 d-flex justify-content-center align-items-center">
                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong><?= esc($cartitem['course_price']) ?></strong>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                </div>
                                <!--  item -->
                                <hr class="my-4" />
                            <?php endforeach; ?>




                            <!-- Single item -->
                        </div>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">


                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total : <?= "₹ " . esc($totalCost)  ?> </strong>
                                        <strong>
                                            <p class="mb-0">(including GST)</p>
                                        </strong>
                                    </div>
                                    <span><strong></strong></span>
                                </li>
                            </ul>

                            <form action="<?= base_url('processPayment') ?>" method="post">
                                <!-- Other cart items and details -->
                                <input type="hidden" name="totalAmount" value="<?= esc($totalCost) ?>">
                                <input type="hidden" name="user_id" value="<?= esc(session()->get('id')) ?>">
                                <?php foreach ($cartitems as $cartitem) : ?>
                                    <input type= "hidden" name="course_id[]" value="<?= esc($cartitem['course_id']) ?>">
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-primary">Pay Now</button>
                            </form>

                            <a href="<?= base_url() ?>" class="btn btn-info">Continue Shopping</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>