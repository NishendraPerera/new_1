@extends('layouts.main')

@section('title')
Advertisement/ Edit/ <a href="{{ route('advertisement.edit', ['id' => $advertisement->id ]) }}">{{ $advertisement->id }}</a>
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
                    <div class="card-header">Edit advertisement</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="advertisement_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="user" class="col-sm-6 control-label">Advertisement from</label>
                                <div class="col-sm-6">
                                    <p> {{ $advertisement->user }}</a></p>
                                </div> 
                            </div> 
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="date" class="col-sm-6 control-label">Date</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Select a date" value="{{ $advertisement->date }}" readonly>
                                </div>
                            </div>       

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Size</label>
                                <div class="col-sm-6">
                                    <p> {{ \App\AdSize::select('name')->where('id',$advertisement->size )->first()->name }} </p>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Colour</label>
                                <div class="col-sm-6">
                                    <p> {{ \App\AdColour::select('name')->where('id',$advertisement->colour )->first()->name }} </p>
                                </div> 
                            </div>

                            {{-- <div class="form-group" style="margin-top: 20px;">
                                <label for="size" class="col-sm-6 control-label">Size</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="size" name="size">
                                        @foreach($sizes AS $size)
                                            <option value="{{ $size->id }}" @if($size->id==$advertisement->size) selected @endif>{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>    

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="colour" class="col-sm-6 control-label">Colour</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="colour" name="colour">
                                        @foreach($colours AS $colour)
                                            <option value="{{ $colour->id }}" @if($colour->id==$advertisement->colour) selected @endif>{{ $colour->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> --}}
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="language" class="col-sm-6 control-label">Language</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="language" name="language">
                                        @foreach($languages AS $language)
                                            <option value="{{ $language->id }}" @if($language->id==$advertisement->language) selected @endif>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="category" class="col-sm-6 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="category" name="category">
                                        @foreach($categories AS $category)
                                            <option value="{{ $category->id }}" @if($category->id==$advertisement->category) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>  

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Uploaded Ad File</label>
                                <div class="col-sm-6">
                                    <p> <a href="{{ $advertisement->link }}" target="_blank">{{ $advertisement->file_name }}</a></p>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload new file</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="uploaded" class="col-sm-6 control-label">Price</label>
                                <div class="col-sm-6">
                                    <p> <b>{{ $advertisement->price }}</b> </p>
                                </div> 
                            </div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Advertisement</button>
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
            startDate: new Date(),
            weekStart: 1,
            //todayBtn:  1,
            //todayHighlight: 1,
            showMeridian: 1,
            startView: 2,
            forceParse: 0,                    
            autoclose: true,
            daysOfWeekDisabled: [1,2,3,4,5,6]
        });

        $("form[name='advertisement_add']").validate({
            rules: {
                date: {
                    required: true
                },
                size: {
                    required: true
                },
                colour: {
                    required: true
                },
                language: {
                    required: true
                },
                category: {
                    required: true
                },
            },
            messages: {
                date: {
                 required: "Please enter a date"
                },
                size: {
                    required: "Please select a size"
                },
                colour: {
                    required: "Please select a colour"
                },
                language: {
                    required: "Please select a language"
                },
                category: {
                    required: "Please select a category"
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
                //var date = $("#date").val();
                //var article_option_id = $("#article_option").val();

                var token = "{{ Session::token() }}";

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                var form_data = new FormData();
                form_data.append('date', $("#date").val());
                form_data.append('size', $("#size").val());
                form_data.append('colour', $("#colour").val());
                form_data.append('language', $("#language").val());
                form_data.append('category', $("#category").val());
                form_data.append('file', $('#file').prop('files')[0]);
                form_data.append('_token', token);
                        
                $.ajax({
                    url: "{{ route('advertisement.update', [ 'id' => $advertisement->id ]) }}",
                    type: "post",
                    //data: ({ date: date, _token: token }),
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if(data=="Success"){
                            location.reload(true);
                        }
                        else{
                            alert(data);
                            $.alert({
                                type: 'red',
                                title: 'Error!',
                                content: "An error occured!",
                            });
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        window.scrollTo(0, 0);
                        $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                    }
                });
            }
        });

    }); 
</script>
   
@endsection