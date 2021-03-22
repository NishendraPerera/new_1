@extends('layouts.main')

@section('title')
New/ <a href="{{ route('user.management.new_home') }}">Management</a>
@endsection

@section('content')

<section>
    <div class="container-fluid">

        <div id="message">
            @if (Session::has('success'))       
                <div class="alert alert-success">
                    <ul>
                    {{ session('success') }}
                    </ul>
                </div>
            @endif

            @if (Session::has('warning'))       
                <div class="alert alert-warning">
                    <ul>
                    {{ session('warning') }}
                    </ul>
                </div>
            @endif
        </div>
        
        {{-- <div class="row">
            <div class="col-sm-6">
                <div class="card border-dark">
                    <div class="card-header">Employees List</div>
                    <div class="card-body text-dark">
                        <table id="table" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-sm-12">
                <div class="card border-dark">
                    <div class="card-header">Users List</div>
                    <div class="card-body text-dark">
                        <table id="table2" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>            
        </div> --}}
        <div class="row">
            <div class="col-sm-6">
                <div class="card border-dark">
                    <div class="card-header">Add an employee</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" method="post" role="form" id="userAdd">
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="name" class="col-sm-6 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name of the User">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role" class="col-sm-6 control-label">Role</label>
                                <div class="col-sm-10">
                                        <select class="form-control" id="role" name="role">
                                            <option value="" selected></option>
                                            @foreach($roles AS $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="email" class="col-sm-6 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
          
    $( document ).ready( function () {

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        var table1 = $('#table').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false,
            language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
            "ajax": '{{ route('user.management.employees') }}',
            columns: [  { data: "name" }, { data: "email" }, { data: "role" },
                {  "defaultContent": '<a href="javascript:void(0)" title="Delete user"><i class="icon-close" id="employee"></i></a>' }],
            columnDefs: [ {"targets": 3, "className": "text-center" } ]
        });

        var table2 = $('#table2').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false,
            language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
            "ajax": '{{ route('user.management.users') }}',
            columns: [  { data: "name" }, { data: "email" },
                {  "defaultContent": '<a href="javascript:void(0)" title="Delete user"><i class="icon-close" id="user"></i></a>' }],
            columnDefs: [ {"targets": 2, "className": "text-center" } ]
        });

        $('table tbody').on( 'click', 'i', function () {

            if(this.id=="employee"){
                var data = table1.row( $(this).parents('tr') ).data();
            }
            else{
                var data = table2.row( $(this).parents('tr') ).data();
            }

            var id = data['id'];
            var token = "{{ Session::token() }}";
            
            if(id!=1&&id!="{{ Auth::user()->id }}"){
                $.confirm({
                    title: 'Confirm Delete!',
                    content: 'Do you really want to remove this user?',
                    buttons: {
                        confirm: {
                            btnClass: 'btn-danger',
                            action: function () {  
                                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                                
                                $.ajax({
                                    url: "{{ route('user.management.delete') }}",
                                    type: "post",
                                    data: ({ id: id, _token: token }),  
                                    success: function () {         
                                        window.scrollTo(0, 0);     
                                        location.reload(true);
                                    },
                                    error: function (xhr, status, error) {
                                        console.log(xhr);
                                        window.scrollTo(0, 0);
                                        $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                                    }      
                                });
                                
                            }
                        },
                        close: function () {
                        }
                    }
                }); 
            }
            else{
                $.alert({
                    type: 'red',
                    title: 'Alert!',
                    content: "Can't delete this user"
                });
            }
        });

    });

    $(function() {
          // Initialize form validation on the registration form.
          // It has the name attribute "registration"
        $("form[id='userAdd']").validate({
            rules: {          
                name: {
                    required: true
                },
                role: {
                    required: true
                },
                email: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter the name of the user"
                },
                role: {
                    required: "Please select the role"
                },
                email: {
                    required: "Please enter a Email"
                }
            },
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote, .checkbox-template, .form-control-custom),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } 
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {              

                var name = $("#name").val();
                var role = $("#role").val();
                var email = $("#email").val();

                var token = "{{ Session::token() }}";

                $.ajax({
                url: "{{ route('user.management.store') }}",
                type: "post",
                data: ({ name: name, role: role, email: email, _token: token }),  
                success: function (data) {
                    if(data=="Success"){                                       
                      location.reload(true);                     
                    }
                    else{
                      $.alert({
                          type: 'red',
                          title: 'Alert!',
                          content: data,
                      });
                    }                    
                },
                error: function (msg) {   
                    console.log(msg); 
                    window.scrollTo(0, 0);
                    $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                }      
                });
            }
        });
    });

</script>
   
@endsection