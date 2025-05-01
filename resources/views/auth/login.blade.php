<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('') }}assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('') }}assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('') }}assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/icons.css" rel="stylesheet">
    <title>{{ env('APP_NAME', 'PBL IK-TI') }}</title>
    <style>
        .btn-primary,
        .bg-primary,
        .border-primary,
        .text-primary {
            background-color: #164B60 !important;
            border-color: #164B60 !important;
            color: #fff !important;
        }
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: url('/assets/images/bg-rs.png') no-repeat center center fixed;
            background-size: cover;
        }

        .login-wrapper {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            display: flex;
            flex-wrap: wrap;
            max-width: 900px;
            width: 100%;
            overflow: hidden;
        }

        .login-left {
            background-color: #fff;
            padding: 40px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-right {
            background-color: #f8f9fa;
            flex: 1;
            padding: 40px;
            min-width: 300px;
        }

        .login-logo img {
            width: 200px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 8px;
        }

        a {
            font-size: 0.9rem;
        }

        /* RESPONSIVE */
        @media (max-width: 767.98px) {
            .login-left {
                display: none;
            }

            .login-right {
                flex: 1 1 100%;
                padding: 30px;
            }

            .login-box {
                flex-direction: column;
                border-radius: 0;
                margin: 0 15px;
            }

            body, html {
                background: url('{{ asset("/assets/images/bg-rs.png") }}') no-repeat center center;
                background-size: cover;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-left">
                <div class="login-logo text-center">
                    <img src="{{ asset('dist/img/logo-polines.png') }}" alt="Logo RS Kariadi">
                </div>
            </div>
            <div class="login-right">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="mb-4">Login</h4>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>


                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('') }}assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('') }}assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('') }}assets/js/app.js"></script>
</body>

</html>
