@extends('layouts.main')

@section('title')
Settings/ <a href="{{ route('setting.home') }}">Home</a>
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
            <div class="col-sm-6">
                <div class="card border-dark">
                    <div class="card-header">Change Password</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="passwordChange">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="oldPass" class="col-sm-6 control-label">Current Password</label>
                                <div class="col-sm-6">
                                <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Current Password">
                                </div>
                            </div>            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="newPass" class="col-sm-6 control-label">New Password</label>
                                <div class="col-sm-6">
                                <input type="password" class="form-control" id="newPass" name="newPass" placeholder="New Password">
                                </div>
                            </div>            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="newPassA" class="col-sm-6 control-label">New Password Again</label>
                                <div class="col-sm-6">
                                <input type="password" class="form-control" id="newPassA" name="newPassA" placeholder="New Password Again">
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
        
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(function() {
        $("form[name='passwordChange']").validate({
            rules: {
                oldPass: {
                required: true
                },
                newPass: {
                required: true
                },
                newPassA: {
                required: true,
                equalTo: newPass
                }
            },
            messages: {
                oldPass: {
                required: "Please enter your current password"
                },
                newPass: {
                required: "Please enter a new password"
                },
                newPassA: {
                required: "Please enter the new password again",
                equalTo: "New password not matching"
                }
            },
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote, .checkbox-template, .form-control-custom),.note-editable.card-block',
            errorPlacement: function (error, element) {
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
                
                var oldPass = $("#oldPass").val();
                var newPass = $("#newPass").val();
                var newPassA = $("#newPassA").val();
                var id = $("#id").val();

                var token = "{{ Session::token() }}";
                        
                $.ajax({
                    url: "{{ route('setting.change') }}",
                    type: "post",
                    data: ({ oldPass: oldPass, newPass: newPass, newPassA: newPassA, _token: token }),
                    success: function (data) {

                        if(data['data']=="Success"){
                            location.reload(true);
                        }
                        else{
                            $.alert({
                                type: 'red',
                                title: 'Error!',
                                content: data['data'],
                            });
                        }
                    },
                    error: function (data) {
                        console.log(data.responseText);
                        window.scrollTo(0, 0);
                        $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                    }
                });
            }
        });
    }); 
</script>
   
@endsection