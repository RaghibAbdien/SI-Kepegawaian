<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login SI-KEPEGAWAIAN</title>
</head>
<body>

    <main>
        <section>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form">
                    <div class="head">
                        <span>SI-KEPEGAWAIAN</span>
                        <h1>Login</h1>
                    </div>
                    <div class="email">
                        <label for="email">Email</label>
                        <div>
                            <input type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="password">
                        <label for="password">Password</label>
                        <div>
                            <input type="password" name="password" id="password">
                            <i id="pass" class="fa-solid fa-eye-slash"></i>
                        </div>
                    </div>
                    <button type="submit">Login</button>
                </div>
            </form>
        </section>
    </main>
    
    <script src="assets/js/login.js"></script>
    <script src="https://kit.fontawesome.com/91441035a6.js" crossorigin="anonymous"></script>

    @if (session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        </script>
    @endif

</body>
</html>