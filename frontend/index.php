<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./image/IDEA_logo.svg" type="image/x-icon" rel="shortcut icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- Preloader -->
    <div id="preloader" style="display: none">
        <div class="loading">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_remmdtqv.json" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></lottie-player>
        </div>
    </div>
    <!-- End Preloader -->



    <!-- Login Section -->
    <section class="container" id="login-section">
        <div class="row">
            <center>

                <div class="col-12 col-lg-8 offset-lg-2 my-5">
                    <div class="row">
                        <div class="col-12 col-md-6 p-5 text-left">
                            <div class="form-signin m-auto">
                                <form id="login-form">
                                    <h1 class="h3 mb-3 display-1">Log in to your account</h1>
                                    <span>Log in on your profile to autocomplete your purchase order with your personal data.</span>
                                    <div class="mb-3 mt-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-email">User</label>
                                            <label class="text-danger text-end fw-bold">*</label>
                                        </div>
                                        <input type="text" class="form-control" id="login-email" placeholder="Enter UserName" autocomplete="off" required />
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Password</label>
                                            <label class="text-danger text-end fw-bold">*</label>
                                        </div>
                                        <input type="password" class="form-control" id="login-password" placeholder="Enter your password ..." autocomplete="off" required />
                                    </div>

                                    <button class="btn btn-lg btn-primary rounded-pill w-100 p-2" type="submit">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </center>

        </div>
        </div>
    </section>
    <!-- End Login Section -->

    <!-- Home Section -->
    <section class="container-fluid" id="home-section">
        <div class="row">

            <!-- Product Section -->
            <section class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="product-section">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="display-2">Products</h1>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="180px">Image</th>
                                    <th scope="col" width="250px">Description</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Author</th>
                                    <th scope="col" width="50px"></th>
                                </tr>
                            </thead>
                            <tbody id="table-product">

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- End Product Section -->

        </div>
    </section>
    <!-- End Home Section -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            if (!localStorage.getItem('access_token')) {
                console.log(localStorage.getItem('access_token'), "<<<<<<<<<<<<<<<<<");
                $('#login-section').show()
                fetchData()
                $('#product-section').hide()
            } else {
                console.log("masuk", localStorage.getItem.access_token)
                $('#login-section').hide()
                $('#product-section').show()
            }

            function fetchData() {
                console.log("masuk")
                $.ajax({
                    method: 'GET',
                    url: 'http://localhost:3000/',
                    headers: {
                        access_token: localStorage.getItem('access_token')
                    }
                })
                .done (function(response){
                    console.log(response)
                })
                .fail (function(err){
                    console.log(err)
                })
            }
            $('#login-form').on('submit', function() {
                event.preventDefault()

                const user = $('#login-email').val()
                const password = $('#login-password').val()

                $.ajax({
                        method: 'POST',
                        url: 'http://localhost:3000/login',
                        data: {
                            user: user,
                            password: password,
                        }
                    })
                    .done(function(response) {
                        localStorage.setItem('access_token', response.access_token)
                        Swal.fire({
                            icon: 'success',
                            text: `Login Success`,
                        })
                        $('#login-section').hide()
                        $('#product-section').show()
                        fetchData()
                        console.log(response);
                    })
                    .fail(function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `${err.responseJSON.msg}`,
                            footer: '<a href="">Why do I have this issue?</a>'
                        })
                        console.log(err.responseJSON);
                    })

            })


        });
    </script>
</body>

</html>