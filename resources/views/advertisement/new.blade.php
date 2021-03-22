@extends('layouts.main')

@section('title')
Advertisement/ <a href="{{ route('advertisement.create') }}">New</a>
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
                    <div class="card-header">Add new advertisement</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="advertisement_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="date" class="col-sm-6 control-label">Date</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Select a date" readonly>
                                </div>
                            </div>       
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="size" class="col-sm-6 control-label">Size</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="size" name="size">
                                        <option value="0" selected></option>
                                        @foreach($sizes AS $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>    

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="colour" class="col-sm-6 control-label">Colour</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="colour" name="colour">
                                        <option value="0" selected></option>
                                        @foreach($colours AS $colour)
                                            <option value="{{ $colour->id }}">{{ $colour->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="language" class="col-sm-6 control-label">Language</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="language" name="language">
                                        <option value="" selected></option>
                                        @foreach($languages AS $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="category" class="col-sm-6 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="category" name="category">
                                        <option value="" selected></option>
                                        @foreach($categories AS $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>  

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="file" class="col-sm-6 control-label">Upload your advertisement</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>

                            <div id="price"></div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" id="ad_submit" class="btn btn-primary">Submit Advertisement & Pay</button>
                                </div>
                            </div>
        
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="checkout_modal" role="dialog">
    <div class="modal-dialog">        
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Checkout</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">    
                <form name="checkout">        
                <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="cc-name">Name on card</label>
                      <input type="text" class="form-control" id="cc-name" placeholder="" required>
                      <small class="text-muted">Full name as displayed on card</small>
                      {{-- <div class="invalid-feedback">
                        Name on card is required
                      </div> --}}
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="cc-number">Credit card number</label>
                      <input type="text" class="form-control" id="cc-number" placeholder="" required>
                      {{-- <div class="invalid-feedback">
                        Credit card number is required
                      </div> --}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <label for="cc-expiration">Expiration</label>
                      <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY" required>
                      {{-- <div class="invalid-feedback">
                        Expiration date required
                      </div> --}}
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="cc-expiration">CVV</label>
                      <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                      {{-- <div class="invalid-feedback">
                        Security code required
                      </div> --}}
                    </div>
                  </div>
                  <hr class="mb-4">
                  <button class="btn btn-primary btn-lg btn-block" type="submit">Pay</button>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>        
    </div>    
</div>

<script>

    $(function() {
        both_changes();

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
                file: {
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

                $("#checkout_modal").modal();

            }
        });

        $("form[name='checkout']").validate({
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
                    url: "{{ route('advertisement.store') }}",
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

    $("#size").change(function(){ both_changes(); }); 

    $("#colour").change(function(){ both_changes(); }); 

    //alert($('button').prop('class'));

    function both_changes()
    {
        $('#ad_submit').prop('disabled', true);

        $(function() {
            var size    = $("#size").val();
            var colour  = $("#colour").val();

            if(size==0||colour==0){
                $('#ad_submit').prop('disabled', true);
                $("#price").html("");
            }
            else{
                $('#ad_submit').prop('disabled', false);
                price_calculator();
            }
        });
    }

    function price_calculator()
    {
        var size    = $("#size").val();
        var colour  = $("#colour").val();

        var price = 1000;

        $.ajax({
            url: "{{ route('advertisement.price_ajax') }}",
            type: "get",
            data: ({ size: size, colour: colour }),
            async: false, 
            success: function (data) {

                $("#price").html('<div class="form-group" style="margin-top: 20px;"><label for="user" class="col-sm-6 control-label">Price</label><div class="col-sm-6"><p> <b>Rs. '+ number_format(data, 0, '.', ',') +' </b></a></p></div></div> ');

            }
            , error: function (data) {
                $("#price").html('<div class="form-group" style="margin-top: 20px;"><label for="user" class="col-sm-6 control-label">Price</label><div class="col-sm-6"><p> <b>Rs. '+ number_format(1000, 0, '.', ',') +' </b></a></p></div></div> ');
                // console.log(data);
                // window.scrollTo(0, 0);
                // $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
            }
        });
    }

    function number_format (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
   
@endsection