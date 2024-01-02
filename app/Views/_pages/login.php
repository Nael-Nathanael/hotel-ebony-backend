<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bs5.css">

    <title>Admin Panel | Hotel Ebony Batulicin</title>
</head>
<body>

<main class="min-vh-100 w-100 d-flex justify-content-center align-items-center bg-light">
    <form action="<?= route_to("auth.do_auth") ?>" method="post">
        <div class="form-group mb-3">
            <label for="password" class="d-none">Password</label>
            <input type="password" name="password" id="password" class="form-control" style="min-width: 400px;"
                   placeholder="Admin Password">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
</main>

</body>
</html>