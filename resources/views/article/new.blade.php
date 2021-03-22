@extends('layouts.main')

@section('title')
Article/ <a href="{{ route('article.create') }}">New</a>
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
                    <div class="card-header">Add new article</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="article_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="oldPass" class="col-sm-6 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                </div>
                            </div>       
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="article_option" class="col-sm-6 control-label">Article Option</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="article_option" name="article_option">
                                        <option value="" selected></option>
                                        @foreach($article_options AS $article_article)
                                            <option value="{{ $article_article->id }}">{{ $article_article->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>     

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload an image (Recommended: 750x350)</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                            
                            <textarea id="article" name="article"></textarea>

                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Publish Article</button>
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
                file: {
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
                file: {
                    required: "Please upload an image"
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
                    url: "{{ route('article.store') }}",
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