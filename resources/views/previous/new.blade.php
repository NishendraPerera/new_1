@extends('layouts.main')

@section('title')
Previous Newspapers/ <a href="{{ route('previous.create') }}">New</a>
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
                    <div class="card-header">Add a previous newspaper</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="previous_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="date" class="col-sm-6 control-label">Date</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Select a date">
                                </div>
                            </div>  

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload the newspaper</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit Newspaper</button>
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
        $("#date").datetimepicker({
            minView: 2,
            format: 'yyyy-mm-dd',
            endDate: new Date(),
            weekStart: 1,
            //todayBtn:  1,
            //todayHighlight: 1,
            showMeridian: 1,
            startView: 2,
            forceParse: 0,                    
            autoclose: true,
            daysOfWeekDisabled: [1,2,3,4,5,6]
        });

        $("form[name='previous_add']").validate({
            rules: {
                date: {
                    required: true
                },
                file: {
                    required: true
                },
            },
            messages: {
                date: {
                 required: "Please enter a date"
                },
                file: {
                    required: "Please upload the file"
                },
                
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
                
                var token = "{{ Session::token() }}";

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                var form_data = new FormData();
                form_data.append('date', $("#date").val());
                form_data.append('file', $('#file').prop('files')[0]);
                form_data.append('_token', token);
                        
                $.ajax({
                    url: "{{ route('previous.store') }}",
                    type: "post",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if(data=="Success"){
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