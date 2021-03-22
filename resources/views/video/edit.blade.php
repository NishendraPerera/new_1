@extends('layouts.main')

@section('title')
Video/ Edit/ <a href="{{ route('video.edit', ['id' => $video->id ]) }}">{{ $video->id }}</a>
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
                    <div class="card-header">Edit video</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="video_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="title" class="col-sm-6 control-label">Uploaded by</label>
                                <div class="col-sm-6">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="title" class="col-sm-6 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title" value="{{ $video->title }}">
                                </div>
                            </div>   
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="description" class="col-sm-6 control-label">Description</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter a description" value="{{ $video->description }}">
                                </div>
                            </div>  

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Uploaded thumbnail</label>
                                <div class="col-sm-6">
                                    <p> <a href="{{ $video->thumbnail_link }}" target="_blank">{{ $video->thumbnail_file_name }}</a></p>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="thumbnail" class="col-sm-6 control-label">Upload a thumbnail (Recommended: 400x225)</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Uploaded video</label>
                                <div class="col-sm-6">
                                    <p> <a href="{{ $video->link }}" target="_blank">{{ $video->file_name }}</a></p>
                                </div> 
                            </div> 
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Video Details</button>
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

        $("form[name='video_add']").validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                },
            },
            messages: {
                title: {
                 required: "Please enter a title"
                },
                description: {
                    required: "Please select a description"
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
                form_data.append('title', $("#title").val());
                form_data.append('description', $("#description").val());
                form_data.append('thumbnail', $('#thumbnail').prop('files')[0]);
                form_data.append('_token', token);

                var token = "{{ Session::token() }}";
                        
                $.ajax({
                    url: "{{ route('video.update', ['id' => $video->id ]) }}",
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
                                content: data,
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