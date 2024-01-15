<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>


    <!-- THis below is file is included for navbar -->
    <?php include(APPPATH . 'Views/header/navbar.php'); ?>
    <!-- *************** -->



    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">


                    <!-- here the heading is dyanamically changged by observing the url for this strpos function is used -->
                    <?php if (!strpos(current_url(), 'instructor_login')) : ?>
                        <h2>Sign In as Student</h2>
                    <?php else : ?>
                        <h2>Sign In as Instructor</h2>
                    <?php endif; ?>
                    <!-- *************** -->




                    <form action="<?= base_url('authenticate') ?>" method="post">

                        <?= csrf_field() ?>

                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-warning">
                                <?= validation_list_errors() ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>




                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" value="<?= set_value('email') ?>" />
                            <label class="form-label" for="form1Example13">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" />
                            <label class="form-label" for="form1Example23">Password</label>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="#!">Forgot password?</a>
                        </div>

                        <!-- Submit button -->
                        <div class="btn-group d-flex" role="group">
                            <button type="submit" class="btn btn-primary btn-lg mx-2">Sign In</button>
                            <?php if (!strpos(current_url(), 'instructor_login')) : ?>
                                <a href="<?= base_url('signup') ?>" class="btn btn-secondary btn-lg mx-2">Sign Up</a>
                            <?php else : ?>
                                <a href="<?= base_url('instructor_signup') ?>" class="btn btn-secondary btn-lg mx-2">Sign Up</a>
                            <?php endif; ?>

                        </div>



                    </form>
                </div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>