<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
                        <a class="nav-link active" href="#section1">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('users')}}">Users</a>
                    </li>
                </ul><br>
            </div>
            <br>

            <div class="col-lg-9">
                <div class="min-head">
                    <h4>Dashboard</h4>
                    <button class="btn btn-primary" id="open_modal">Add+</button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="well">
                            <table id="Table_ID" class="table table-striped table-bordered" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Action</th>
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

    <!-- Add Modal HTML -->
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="task_title" class="form-label">Task Title</label><br>
                            <small class="word_limit">maximum word limit 100*</small>
                            <input type="text" class="form-control" id="task_title">
                            <span class="validation_message" id="warn_task_title"></span>
                        </div>
                        <div class="mb-3">
                            <label for="task_description" class="form-label">Task Description</label>
                            <textarea class="form-control" id="task_description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="emp_name" class="form-label">Employee Name</label>
                            <select id="user_name" for="emp_name" class="form-control">
                                <option value="">select</option>
                            </select>
                            <span class="validation_message" id="warn_user_name"></span>
                        </div>
                        <button type="button" id="save_task" class="btn btn-primary">Save Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- ... Existing code ... -->

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table_ID').DataTable();

        $.ajax({
            type: 'GET',
            dataType:"JSON",
            url: "{{url('api/get/tasks')}}",       
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
                        <td>${item.task.created_at}</td>
                        <td>
                        <button type="button" onclick="edit_data('${item.uid}')" class="btn btn-warning">EDIT</button>
                        <button type="button" onclick="delete_data('${item.uid}')" class="btn btn-danger">DELETE</button>
                        </td>`
                })
                $('#task_data').html(html)
            }
        })
    });
</script>
<script>
function edit_data(task_id){
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: `{{url('api/get/a_task/${task_id}')}}`,     
        success: function(response){
            console.log(response.data)
        }
    })
}

function delete_data(task_id){
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: `{{url('api/get/a_task/${task_id}')}}`,     
        success: function(response){
            console.log(response.data)
        }
    })
}

// get users
$('#open_modal').on('click', function () {
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: "{{url('api/get/users')}}",       
        success: function(response){
            $('#myModal').modal('show');
            var resp = response.data
            var html = `<option value="">select</option>`;
            $.each(resp, function(index, item) {
                console.log(item.uid);
                html +='<option value="' + item.uid + '">' + item.name + '</option>';
            });
            $('#user_name').html(html);
        }
    })
});

$("#save_task").click(function() {
    var task_title          = $("#task_title").val()
    var task_description    = $("#task_description").val()
    var user_name           = $("#user_name").val()
    
    var wordCount = task_title.length;
    if(task_title == ""){
        $("#warn_task_title").text("Please enter task title!");
    }else if(wordCount > 100){
        $("#warn_task_title").text("Maximum character limit 100!");
    }else if(user_name == ""){
        $("#warn_user_name").text("Please assign to a user!");
        $("#warn_task_title").text("");
    }else{
        $("#warn_user_name").text("");
        
        var data={
            task_title:task_title,
            task_description:task_description,
            user_name:user_name,
            "_token":"{{csrf_token()}}"
        }
        $.ajax({
            type: 'POST',
            data:data,
            url: "{{url('api/add/task')}}",       
            success: function(response){
                console.log(data);
                if(response.success){
                    $("#task_title").val("")
                    $("#task_description").val("")
                    $("#user_name").val("")
                }          
            }
        });
    }
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

