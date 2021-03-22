@extends('layouts.main')

@section('title')
Article/ Edit/ <a href="{{ route('article.edit', ['id' => $article->id ]) }}">{{ $article->id }}</a>
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
                    <div class="card-header">Edit article</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="article_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="oldPass" class="col-sm-6 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $article->title }}">
                                </div>
                            </div>       
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="article_option" class="col-sm-6 control-label">Article Option</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="article_option" name="article_option">
                                        @foreach($article_options AS $article_option)
                                            <option value="{{ $article_option->id }}" @if($article_option->id==$article->article_option_id) selected @endif>{{ $article_option->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>     

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Uploaded image</label>
                                <div class="col-sm-6">
                                    <p> <a href="{{ $article->link }}" target="_blank">{{ $article->file_name }}</a></p>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload new file</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                            
                            <textarea id="article" name="article">{{ $article->content }}</textarea>

                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Article</button>
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
    $(document).ready( function() {

        tinymce.init({
            selector: 'textarea#article',
            plugins: 'link code image imagetools',
            height: 600
        });

    });



    $(function() {

        $("form[name='article_add']").validate({
            rules: {
                title: {
                    required: true
                },
                article_option: {
                    required: true
                },
            },
            messages: {
                title: {
                 required: "Please enter a title"
                },
                article_option: {
                    required: "Please select an option"
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
                
                var content = $("#article").val();
                var token = "{{ Session::token() }}";

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                var form_data = new FormData();
                form_data.append('title', $("#title").val());
                form_data.append('article_option', $("#article_option").val());
                form_data.append('content', content);
                form_data.append('file', $('#file').prop('files')[0]);
                form_data.append('_token', token);
                        
                $.ajax({
                    url: "{{ route('article.update', ['id' => $article->id ]) }}",
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
                                content: "An error occured!",
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