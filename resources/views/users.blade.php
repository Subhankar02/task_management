<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('users.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
                        <a class="nav-link " href="{{url('index')}}">Tasks</a>
                    </li>
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
                        <div class="well">
                            <table id="Table_ID" class="table table-striped table-bordered" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody id="user_data">
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

        $.ajax({
            type: 'GET',
            dataType:"JSON",
            url: "{{url('api/get/users')}}",       
            success: function(response){
                console.log(response.data)
                var resp = response.data
                var html = ""
                $.each(resp, function(index, item){
                    html +=`
                    <tr>
                        <td>${index+1}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${item.role}</td>
                        
                    </tr>
                    
                   `
                })
                $('#user_data').html(html)
            }
        })
    });
</script>
<script>


// get users
// $('#open_modal').on('click', function () {
//     $.ajax({
//         type: 'GET',
//         dataType:"JSON",
//         url: "{{url('api/get/users')}}",       
//         success: function(response){
//             $('#myModal').modal('show');
//             var resp = response.data
//             var html = `<option value="">select</option>`;
//             $.each(resp, function(index, item) {
//                 console.log(item.uid);
//                 html +='<option value="' + item.uid + '">' + item.name + '</option>';
//             });
//             $('#user_name').html(html);
//         }
//     })
// });

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

