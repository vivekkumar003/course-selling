<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
                    <?php if (!strpos(current_url(), 'instructor_signup')) : ?>
                        <h2>Sign Up as Student</h2>
                    <?php else : ?>
                        <h2>Sign Up as Instructor</h2>
                    <?php endif; ?>
                    <!-- *************** -->


                    <form action="<?= base_url('signup') ?>" method="post">

                        <?= csrf_field() ?>
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-warning">
                                <?= validation_list_errors() ?>
                            </div>
                        <?php endif; ?>


                        <div class="mb-3">
                            <label for="inputFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="inputFirstName" placeholder="Enter your first name" name="first_name" value="<?= set_value('first_name') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="inputLastName" placeholder="Enter your last name" name="last_name" value="<?= set_value('last_name') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter your email" name="email" value="<?= set_value('email') ?>">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Enter your password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm your password" name="confirm_password">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="inputGender" class="form-label">Gender</label>
                            <select class="form-select" id="inputGender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div> -->

                        <div class="mb-3">
                            <label for="inputRole" class="form-label">Sign up as</label>
                            <select class="form-select" id="inputRole" name="role">
                                <option value="Student">Student</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>