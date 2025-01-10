<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Dashboard</title>  
    <!-- Bootstrap CSS -->  
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">  
    <style>  
        body {  
            background-color: #f8f9fa;  
        }  
        .sidebar {  
            height: 100vh;  
            background-color: #343a40;  
            color: white;  
        }  
        .sidebar a {  
            color: white;  
        }  
        .sidebar a:hover {  
            color: #007bff;  
        }  
        .content {  
            padding: 20px;  
        }  
    </style>  
</head>  
<body>  
    <div class="d-flex">  
        <!-- Sidebar -->  
        <div class="sidebar d-flex flex-column align-items-center p-3">  
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">  
                <span class="fs-4">Dashboard</span>  
            </a>  
            <hr>  
            <ul class="nav nav-pills flex-column mb-auto">  
                <li class="nav-item">  
                    <a href="#" class="nav-link active" aria-current="page">  
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>  
                        Home  
                    </a>  
                </li>  
                <li>  
                    <a href="#" class="nav-link text-white">  
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>  
                        Dashboard  
                    </a>  
                </li>  
                <li>  
                    <a href="#" class="nav-link text-white">  
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>  
                        Orders  
                    </a>  
                </li>  
                <li>  
                    <a href="#" class="nav-link text-white">  
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>  
                        Products  
                    </a>  
                </li>  
                <li>  
                    <a href="#" class="nav-link text-white">  
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>  
                        Customers  
                    </a>  
                </li>  
            </ul>  
            <hr>  
            <div class="dropdown">  
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">  
                    <img src="https://via.placeholder.com/32" alt="" width="32" height="32" class="rounded-circle me-2">  
                    <strong>{{ Auth::user()->name }}</strong>  
                </a>  
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">  
                    <li><a class="dropdown-item" href="#">Profile</a></li>  
                    <li><a class="dropdown-item" href="#">Settings</a></li>  
                    <li><hr class="dropdown-divider"></li>  
                    <li>  
                        <form method="POST" action="{{ route('auth.logout') }}" style="display: inline;">  
                            @csrf  
                            <button type="submit" class="dropdown-item">Sign out</button>  
                        </form>  
                    </li>  
                </ul>  
            </div>
        </div>  
  
        <!-- Main Content -->  
        <div class="content flex-grow-1">  
            <div class="container-fluid">  
                <h1 class="mt-4">Welcome to the Dashboard, {{ Auth::user()->name }}!</h1>  
                <p class="lead">This is your main dashboard where you can manage all aspects of your application.</p>  
  
                <!-- Example Cards -->  
                <div class="row">  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <div class="card-body">  
                                <h5 class="card-title">Total Orders</h5>  
                                <p class="card-text">1234</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <div class="card-body">  
                                <h5 class="card-title">Total Products</h5>  
                                <p class="card-text">567</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <div class="card-body">  
                                <h5 class="card-title">Total Customers</h5>  
                                <p class="card-text">890</p>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
  
                <!-- Example Chart -->  
                <div class="card mb-4">  
                    <div class="card-header">  
                        <i class="fas fa-chart-area me-1"></i>  
                        Area Chart Example  
                    </div>  
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>  
                </div>  
            </div>  
        </div>  
    </div>  
  
    <!-- Bootstrap JS and dependencies -->  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  
    <script>  
        // Example Chart  
        var ctx = document.getElementById('myAreaChart').getContext('2d');  
        var myAreaChart = new Chart(ctx, {  
            type: 'line',  
            data: {  
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],  
                datasets: [{  
                    label: 'Sales',  
                    data: [65, 59, 80, 81, 56, 55, 40],  
                    fill: true,  
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                    borderColor: 'rgba(75, 192, 192, 1)',  
                    borderWidth: 1  
                }]  
            },  
            options: {  
                scales: {  
                    y: {  
                        beginAtZero: true  
                    }  
                }  
            }  
        });  
    </script>  
</body>  
</html>  
