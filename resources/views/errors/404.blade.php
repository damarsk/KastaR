<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page Not Found</title>

    <!-- Meta -->
    <meta name="description" content="KastaR | Kasir Pintar" />
    <meta name="author" content="KastaR" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('error_style/css/main.min.css') }}" />
  </head>

  <body class="error-bg">

    <!-- Error container starts -->
    <div class="error-container">

      <h1 class="mb-4 lh-1">404</h1>
      <h4 class="fw-bold mb-3">
        There is nothing here...
      </h4>
      <h6 class="mb-4">May be the page you are looking for is not found<br />or never existed.</h6>
      <a href="{{ url('/') }}" class="btn btn-primary rounded-5 px-4 py-2 fs-5">Back to Home</a>
    </div>
    <!-- Error container ends -->

  </body>

</html>