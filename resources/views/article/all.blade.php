@extends('layouts.main')

@php
    $role = \App\Role::select('name')->where('id', Auth::user()->role_id)->first()->name;
@endphp

@section('title')
Article/ <a href="{{ route('article.home') }}">All</a>
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
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card border-dark">
                    <div class="card-header">Article List</div>
                    <div class="card-body text-dark">
                        <table id="table" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
                      
        </div>
    </div>

</section>

<script type="text/javascript">
          
    $( document ).ready( function () {

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        @if($role=="Editor")
            var content = '<a href="javascript:void(0)" title="View Article"><i class="icon-padnote" id="view"></i></a> <a href="javascript:void(0)" title="Edit Article"><i class="icon-padnote" id="edit"></i></a> ';
        @else
            var content = '<a href="javascript:void(0)" title="View Article"><i class="icon-padnote" id="view"></i></a> <a href="javascript:void(0)" title="Edit Article"><i class="icon-padnote" id="edit"></i></a> <a href="javascript:void(0)" title="Delete Article"><i class="icon-close" id="delete"></i></a>';
        @endif

        var table1 = $('#table').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false,
            language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
            "ajax": '{{ route('article.index') }}',
            columns: [  { data: "id" }, { data: "date" }, { data: "category" }, { data: "title" },
                {  "defaultContent": content }],
            columnDefs: [ {"targets": 4, "className": "text-center" } ]
        }); 

        $('#table tbody').on( 'click', '#view', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var url = "{{ URL::to('article') }}/" + id;

            var win = window.open(url, '_blank');

        });

        $('#table tbody').on( 'click', '#edit', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var url = "{{ URL::to('article/edit') }}/" + id;

            var win = window.open(url, '_self');
        });

        $('#table tbody').on( 'click', '#delete', function () {
            var data = table1.row( $(this).parents('tr') ).data();

            var id = data['id'];
            var token = "{{ Session::token() }}";
            
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you really want to delete this article?',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {  
                            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                            
                            $.ajax({
                                url: "{{ route('article.delete') }}",
                                type: "post",
                                data: ({ id: id, _token: token }),  
                                success: function () {         
                                    window.scrollTo(0, 0);     
                                    location.reload(true);
                                },
                                error: function (xhr, status, error) {
                                    window.scrollTo(0, 0);
                                    $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                                    console.log(error);
                                }      
                            });
                            
                        }
                    },
                    close: function () {
                    }
                }
            });

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
                data: ({ name: name, role: role, username: username, _token: token }),  
                success: function (data) {
                    if(data['data']=="Success"){                                       
                      location.reload(true);                     
                    }
                    else{
                      $.alert({
                          type: 'red',
                          title: 'Alert!',
                          content: data['data'],
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