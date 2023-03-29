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
                    <h1 class="display-2">Data</h1>
                    <button id="reloadBtn" class="btn btn-primary">Reload Page</button>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                               
                                    <th scope="col">Date</th>
                                    <th scope="col" width="180px">Label</th>
                                    <th scope="col" width="250px">nb_visit</th>
                                    <th scope="col">status</th>
                                    <th scope="col" width="50px">Action</th> 
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

              function getDetail(id){
                $('#dataModal').empty();
                $.ajax({
                    method: 'GET',
                    url: `http://localhost:3000/${id}`,
                    headers: {
                        access_token: localStorage.getItem('access_token')
                    }
                })
                .done(function (response) {
                    const result=response
                    console.log(result.label)
                    const data = /*html*/`
                    <p>Label: ${result.label || 'Tidak ada data'}</p>
                    <p>nb_visits: ${result.nb_visits || 'Tidak ada data'}</p>
                    <p>nb_hits: ${result.nb_hits || 'Tidak ada data'}</p>
                    <p>sum_time_spent: ${result.sum_time_spent || 'Tidak ada data'}</p>
                    <p>nb_hits_with_time_generation: ${result.nb_hits_with_time_generation || 'Tidak ada data'}</p>
                    <p>min_time_generation: ${result.min_time_generation || 'Tidak ada data'}</p>
                    <p>max_time_generation: ${result.max_time_generation || 'Tidak ada data'}</p>
                    <p>sum_bandwidth: ${result.sum_bandwidth || 'Tidak ada data'}</p>
                    <p>nb_hits_with_bandwidth: ${result.nb_hits_with_bandwidth || 'Tidak ada data'}</p>
                    <p>min_bandwidth: ${result.min_bandwidth || 'Tidak ada data'}</p>
                    <p>max_bandwidth: ${result.max_bandwidth || 'Tidak ada data'}</p>
                    <p>entry_nb_visits: ${result.entry_nb_visits || 'Tidak ada data'}</p>
                    <p>entry_nb_actions: ${result.entry_nb_actions || 'Tidak ada data'}</p>
                    <p>entry_sum_visit_length: ${result.entry_sum_visit_length || 'Tidak ada data'}</p>
                    <p>entry_bounce_count: ${result.entry_bounce_count || 'Tidak ada data'}</p>
                    <p>exit_nb_visits: ${result.exit_nb_visits || 'Tidak ada data'}</p>
                    <p>sum_daily_nb_uniq_visitors: ${result.sum_daily_nb_uniq_visitors || 'Tidak ada data'}</p>
                    <p>sum_daily_entry_nb_uniq_visitors: ${result.sum_daily_entry_nb_uniq_visitors || 'Tidak ada data'}</p>
                    <p>sum_daily_exit_nb_uniq_visitors: ${result.sum_daily_exit_nb_uniq_visitors || 'Tidak ada data'}</p>
                    <p>avg_bandwidth: ${result.avg_bandwidth || 'Tidak ada data'}</p>
                    <p>avg_time_on_page: ${result.avg_time_on_page || 'Tidak ada data'}</p>
                    <p>bounce_rate: ${result.bounce_rate || 'Tidak ada data'}</p>
                    <p>exit_rate: ${result.exit_rate || 'Tidak ada data'}</p>
                    <p>avg_time_generation:: ${result.avg_time_generation || 'Tidak ada data'}</p>
                    `
                    $('#dataModal').append(data)
                })
                .fail(function (err) {
                    console.log(err)
                    Swal.fire({
                        icon: 'success',
                        text: `Tidak Ada Data`,
                    })
                })
            }
    </script>
    <script>
        $(document).ready(function() {

            if (!localStorage.getItem('access_token')) {
                console.log(localStorage.getItem('access_token'), "<<<<<<<<<<<<<<<<<");
                $('#login-section').show()
                $('#product-section').hide()
            } else {
                fetchData()
                console.log("masuk", localStorage.getItem.access_token)
                $('#login-section').hide()
                $('#product-section').show()
            }
            
            $('#reloadBtn').click(function() {
                location.reload(); 
            });
            function fetchData() {
                $.ajax({
                    method: 'GET',
                    url: 'http://localhost:3000/',
                    headers: {
                        access_token: localStorage.getItem('access_token')
                    }
                })
                .done(function (response) {
                for (const key in response) {
                    let [result] = response[key]
                  
                    const data =/*html*/`
                        <tr>
                
                        <td class="fw-bold">${key} </td>
                        <td class="fw-bold">${result?.label || 'Tidak ada data'} </td>

                        <td>${result?.nb_visits|| 'Tidak ada data'}</td>
                        <td>${result?.status || 'Tidak ada data'}</td>
                        <td>
                     
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"  onclick="getDetail(${key.replace('-','.')})"  data-bs-target="#exampleModal">
                            Detail
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="dataModal">
                                  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                ` 
                $('#table-product').append(data)
                }
                console.log("masuk fetch")
                // $('#table-product').empty();
                
            })
          .fail(function (err) {
            Swal.fire({
              icon: 'success',
              text: `Tidak Ada Data`,
              
            })
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
                    
                    })

            })

      
        });
    </script>
</body>

</html>