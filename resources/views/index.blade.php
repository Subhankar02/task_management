<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{asset('index.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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
                    <button class="btn btn-primary" onclick="open_modal()">Add+</button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="well">
                            <div class="row">
                                <div class="col-3">
                                    <input type="date" id="search_date" class="form-control">
                                </div>
                                <div class="col-3">
                                    <button id="search" class="btn btn-outline-success my-2 my-sm-0">search</button>
                                </div>
                            </div>
                            
                            <table  class="table table-striped table-bordered" style="width: 100%;">
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
                            <input type="hidden" id="task_id_for_edit">
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
                    <td>
                    <button type="button" onclick="edit_data('${item.task.uid}')" class="btn btn-warning">EDIT</button>
                    <button type="button" onclick="delete_data('${item.task.uid}')" class="btn btn-danger">DELETE</button>
                    </td>`
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
                    <td>
                    <button type="button" onclick="edit_data('${item.task.uid}')" class="btn btn-warning">EDIT</button>
                    <button type="button" onclick="delete_data('${item.task.uid}')" class="btn btn-danger">DELETE</button>
                    </td>`
            })
            $('#task_data').html(html)
        }
    })
})

function edit_data(task_id){
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: `{{url('api/get/a_task/${task_id}')}}`,     
        success: function(response){
            // $('#myModal').modal('show');
            open_modal()
            $("#task_title").val(response.data.task.title)
            $("#task_description").val(response.data.task.description)
            $("#task_id_for_edit").val(response.data.task.uid)
            $("#user_name").html('<option value="' + response.data.user.uid + '">' + response.data.user.name + '</option>')
            console.log(response.data)
        }
    })
}

function delete_data(task_id){
    $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: `{{url('api/delete/task/${task_id}')}}`,     
        success: function(response){
            console.log(response.data)
            get_tasks()
        }
    })
}

// get users
function open_modal(){
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
};

$("#save_task").click(function() {
    var task_title          = $("#task_title").val()
    var task_description    = $("#task_description").val()
    var user_name           = $("#user_name").val()
    var task_id             = $("#task_id_for_edit").val()
    
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
        
        if(task_id == ""){
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
                        get_tasks()
                    }          
                }
            });
        }else if(task_id != ""){
            var data={
            task_title:task_title,
            task_description:task_description,
            user_name:user_name,
            task_id:task_id,
            "_token":"{{csrf_token()}}"
            }
            $.ajax({
                type: 'POST',
                data:data,
                url: "{{url('api/update/task')}}",       
                success: function(response){
                    console.log(data);
                    if(response.success){
                        $("#task_title").val("")
                        $("#task_description").val("")
                        $("#user_name").val("")
                        get_tasks()
                    }          
                }
            });
        }
        
    }
})

// Logout
$("#logedout").click(function() {
        $.ajax({
        type: 'GET',
        dataType:"JSON",
        url: "{{url('logout')}}",       
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

