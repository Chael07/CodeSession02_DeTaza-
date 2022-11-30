<?php
require('config/config.php');
require('config/db.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>

    <div class="wrapper">
    

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-lg hidden-md"></b>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="">
                                    <p>Account</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">

                                <div class="header">
                                    <h4 class="title">Top 5 Expensive Products</h4>
                                    
                                </div>
                                <div class="content">
                                    <canvas id="myChartTopFive"></canvas>
                                    <?php
                                    $query02 = "SELECT ProductName, UnitPrice FROM northwind.products order by UnitPrice desc limit 5";
                                    $result02 = mysqli_query($conn, $query02);
                                    if (mysqli_num_rows($result02) > 0) {
                                        $Count_Order = array();
                                        $label_chart = array();
                                        while ($row = mysqli_fetch_array($result02)) {
                                            $Count_Order[] = $row['UnitPrice'];
                                            $label_chart[] = $row['ProductName'];
                                        }
                                        mysqli_free_result($result02);
                                        
                                    } else {
                                        echo "No records matching your query were found.";
                                    }
                                    ?>
                                    <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-clock-o"></i> this data updated 3 hours ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Number of Assisted Orders by every Employee</h4>
                                   
                                </div>
                                <div class="content">
                                    <canvas id="chartNumber"></canvas>
                                    <?php
                                    $query03 = "SELECT concat(LastName, ', ', FirstName) as 'Employee Name', count(orders.OrderID) as 'Order Count' FROM northwind.employees, orders 
                                    where employees.EmployeeID = orders.EmployeeID group by concat(LastName, ' ', FirstName)";
                                    $result03 = mysqli_query($conn, $query03);
                                    if (mysqli_num_rows($result03) > 0) {
                                        $Count = array();
                                        $label = array();
                                        while ($row = mysqli_fetch_array($result03)) {
                                            $Count[] = $row['Order Count'];
                                            $label[] = $row['Employee Name'];
                                        }
                                        mysqli_free_result($result03);
                                       
                                    } else {
                                        echo "No records matching your query were found.";
                                    }
                                    ?>
                                    <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-clock-o"></i> this data updated 3 hours ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">Customers' total count of orders with more than 15 orders</h4>
                    
                                    </div>
                                    <div class="content">
                                        <canvas id="chartShippers"></canvas>
                                        <?php
                                        $query01 = "SELECT CustomerID, count(OrderID) as 'Order Count' FROM orders GROUP BY CustomerID HAVING count(OrderID) >= 15";
                                        $result01 = mysqli_query($conn, $query01);
                                        if (mysqli_num_rows($result01) > 0) {
                                            $Count_Orders = array();
                                            $label_piechart = array();
                                            while ($row = mysqli_fetch_array($result01)) {
                                                $Count_Orders[] = $row['Order Count'];
                                                $label_piechart[] = $row['CustomerID'];
                                            }
                                            mysqli_free_result($result01);
                                            
                                        } else {
                                            echo "No records matching your query were found.";
                                        }
                                        ?>
                                        <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-clock-o"></i> verified data
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">Country with more than 5 costumer</h4>
                                       
                                    </div>
                                    <div class="content">
                                        <canvas id="chartMostBuy"></canvas>
                                        <?php
                                      $query04 = "SELECT Country, count(CustomerID) as 'Customer_Count' FROM northwind.customers
                                       GROUP BY Country HAVING count(CustomerID) >= 5 order by count(CustomerID) desc;";
                                        $result04 = mysqli_query($conn, $query04);
                                        if (mysqli_num_rows($result04) > 0) {
                                            $Customer_Count = array();
                                            $Country = array();
                                            while ($row = mysqli_fetch_array($result04)) {
                                                $Customer_Count[] = $row['Customer_Count'];
                                                $Country[] = $row['Country'];
                                            }
                                            mysqli_free_result($result04);
                                            
                                        } else {
                                            echo "No records matching your query were found.";
                                        }
                                        ?>
                                        <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-clock-o"></i> this data updated 3 hours ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy; <script>
                                document.write(new Date().getFullYear())
                            </script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </div>
                </footer>

            </div>
        </div>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js">
</script>

<script>
    // <!-- setup block -->
    const Count_Order = <?php echo json_encode($Count_Order); ?>;
    const label_chart = <?php echo json_encode($label_chart); ?>;
    const data2 = {
        labels: label_chart,
        datasets: [{
            label: 'Top 5 Expensive Products',
            data: Count_Order,
            backgroundColor: [
                '#1ce33a',
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
            ],
            hoverOffset: 2
        }]
    };
    // <!-- config block -->
    const config2 = {
        type: 'bar',
        data: data2,


        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    // <!-- render block -->
    const myChartTopFive = new Chart(
        document.getElementById('myChartTopFive'),
        config2
    );
</script>

<script>
    // <!-- setup block -->
    const Count = <?php echo json_encode($Count); ?>;
    const label = <?php echo json_encode($label); ?>;
    const data3 = {
        labels: label,
        datasets: [{
            label: 'Number of Assisted Orders by every Employee',
            data: Count,
            backgroundColor: [
                '#ea00ff',
                '#004817',
                '#000000',
                '#d33996',
                '#1ce33a',
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
            ],
            hoverOffset: 4
        }]
    };
    // <!-- config block -->
    const config3 = {
        type: 'bar',
        data: data3,


        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    // <!-- render block -->
    const chartNumber = new Chart(
        document.getElementById('chartNumber'),
        config3
    );
</script>

<script>
    // <!-- setup block -->
    const Count_Orders = <?php echo json_encode($Count_Orders); ?>;
    const label_piechart = <?php echo json_encode($label_piechart); ?>;
    const data1 = {
        labels: label_piechart,
        datasets: [{
            label: 'Customers total count of orders with more than 15 orders.',
            data: Count_Orders,
            backgroundColor: [
                '#ea00ff',
                '#004817',
                '#000000',
                '#d33996',
                '#1ce33a',
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
                '#23a2dc',
                '#5d5ea2',
                '#1ce385',
                '#c93660',
                '#80c03f',
                '#b84763',
                '#ea00ff',
                '#004817',
                '#000000',
                '#d33996',
                '#1ce33a',
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
                '#23a2dc' 
                

            ],
            hoverOffset: 4
        }]
    };
    // <!-- config block -->
    const config = {
        type: 'doughnut',
        data: data1,

    };

    // <!-- render block -->
    const chartShippers = new Chart(
        document.getElementById('chartShippers'),
        config
    );
</script>
<script>
    // <!-- setup block -->
    const Customer_Count = <?php echo json_encode($Customer_Count); ?>;
    const Country = <?php echo json_encode($Country); ?>;
    const data4 = {
        labels: Country,
        datasets: [{
            label: 'Country with more than 5 costumer',
            data: Customer_Count,
            backgroundColor: [
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
                '#23a2dc',
                '#5d5ea2',
                '#1ce385',
                '#c93660',
                '#80c03f',
                '#b84763',
                '#ea00ff',
                '#004817',
                '#000000',
                '#d33996',
                '#1ce33a',
                '#179fe8',
                '#8116e9',
                '#fa0512',
                '#dcf20d',
                '#23a2dc' 
            ],
            hoverOffset: 4
        }]
    };
    // <!-- config block -->
    const config4 = {
        type: 'bar',
        data: data4,

    };

    // <!-- render block -->
    const chartMostBuy = new Chart(
        document.getElementById('chartMostBuy'),
        config4
    );
</script>




<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<!--<script src="assets/js/chartist.min.js"></script>-->

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        demo.initChartist();

        $.notify({
            icon: 'pe-7s-gift',
            message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

        }, {
            type: 'info',
            timer: 4000
        });

    });
</script>

</html>