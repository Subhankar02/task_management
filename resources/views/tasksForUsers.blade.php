<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{asset('tasksForUsers.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-big {
            overflow: hidden;
            background-color: #0d6efd;
            padding: 10px 10px;
        }

        .nav-big a.logo {
            font-size: 25px;
            font-weight: bold;
            color: white;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        .nav {
            padding-top: 10px;
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }

            table {
                display: block;
                height: 500px;
                overflow-y: scroll;
            }

            .nav-big {
                display: none;
            }
        }

        .min-head {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        .logout-btn{
            margin-right: 40px;
        }
        .word_limit{
            color: #706f6c;
        }
        .validation_message{
            color: red;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary nav-big">
        <a class="navbar-brand">
            <div class="logo">logo</div>
        </a>
        <button class="btn btn-outline-warning logout-btn" id="logedout">log out</button>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-inverse d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <img src="path/to/your/logo.png" alt="Logo" height="30" class="d-inline-block align-text-top"> -->
                LOGO
            </a>
            <button class="btn btn-outline-warning" id="logedout">log out</button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Age</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Geo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row content">
            <div class="col-lg-2 sidenav d-none d-lg-block">

                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('users')}}">Users</a>
                    </li>
                </ul><br>
            </div>
            <br>

            <div class="col-lg-9">
            <div class="min-head">
                    <h4>Users</h4>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-3">
                                <input type="date" id="search_date" class="form-control">
                            </div>
                            <div class="col-3">
                                <button id="search" class="btn btn-outline-success my-2 my-sm-0">search</button>
                            </div>
                        </div>
                        <div class="well">
                            <table class="table table-striped table-bordered" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                    <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>User</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="task_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add DataTables JS after the Bootstrap JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- ... Existing code ... -->

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table_ID').DataTable();
        get_tasks()
        
    });
</script>
<script>
    function get_tasks(){
        var data = 'null'
        $.ajax({
            type: 'GET',
            dataType:"JSON",
            url: `{{url('api/get/tasks/${data}')}}`,       
            success: function(response){
                console.log(response.data)
                var resp = response.data
                var html = ""
                $.each(resp, function(index, item){
                    html +=`
                    <tr>
                    <td>${index+1}</td>
                        <td>${item.task.title}</td>
                        <td>${item.task.description}</td>
                        <td>${item.user.name}</td>
                        <td>${item.task_date}</td>
                        
                    </tr>
                   `
                })
                $('#task_data').html(html)
            }
        })
    }





    $('#search').click(function(){
    var data = $('#search_date').val()
    // alert(data)
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: `{{url('api/get/tasks/${data}')}}`,       
        success: function(response){
            console.log(response.data)
            var resp = response.data
            var html = ""
            $.each(resp, function(index, item){
                    html +=`
                    <tr>
                    <td>${index+1}</td>
                        <td>${item.task.title}</td>
                        <td>${item.task.description}</td>
                        <td>${item.user.name}</td>
                        <td>${item.task_date}</td>
                    </tr>
                   `
                })
            $('#task_data').html(html)
        }
    })
})
// Logout
$("#logedout").click(function() {
        $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: "{{url('api/logout')}}",       
        success: function(data){
            console.log(data);  
            if(data.success){
                window.location.href = `{{url('${data.url}')}}`;
            }                  
        }
    })
})
</script>
</body>

</html>

