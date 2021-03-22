@extends('layouts.main')

@section('title')
Setting/ <a href="{{ route('setting.slider') }}">Sliders</a>
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
                    <div class="card-header">Slider List</div>
                    <div class="card-body text-dark">
                        <table id="table" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card border-dark">
                    <div class="card-header">Add a slider</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" method="post" role="form" id="sliderAdd">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="name" class="col-sm-6 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="description" class="col-sm-6 control-label">Short Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter a short description">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload an image (Recommended: 700x350)</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add slider</button>
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
            "ajax": '{{ route('setting.slider.list') }}',
            columns: [  { data: "title" }, { data: "description" },
                {  "defaultContent": '<a href="javascript:void(0)" title="View slider image"><i class="icon-padnote" id="view"></i></a>  <a href="javascript:void(0)" title="Delete slider"><i class="icon-close" id="delete"></i></a>' }],
            columnDefs: [ {"targets": 2, "className": "text-center" } ]
        });

        $('#table tbody').on( 'click', '#view', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var url = data['link'];

            var win = window.open(url, '_blank');
        });

        $('#table tbody').on( 'click', '#delete', function () {

            var data = table1.row( $(this).parents('tr') ).data();

            var id = data['id'];
            var token = "{{ Session::token() }}";
            
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you really want to remove this slider?',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {  
                            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                            
                            $.ajax({
                                url: "{{ route('setting.slider.delete') }}",
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
        });

    });

    $(function() {
          // Initialize form validation on the registration form.
          // It has the name attribute "registration"
        $("form[id='sliderAdd']").validate({
            rules: {          
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                file: {
                    required: true
                }
            },
            title: {
                name: {
                    required: "Please enter a title"
                },
                description: {
                    required: "Please enter a description"
                },
                file: {
                    required: "Please upload the slider"
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

                var token = "{{ Session::token() }}";

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                var form_data = new FormData();
                form_data.append('title', $("#title").val());
                form_data.append('description', $("#description").val());
                form_data.append('file', $('#file').prop('files')[0]);
                form_data.append('_token', token);                

                $.ajax({
                url: "{{ route('setting.slider.store') }}",
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