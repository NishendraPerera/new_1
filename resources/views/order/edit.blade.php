@extends('layouts.main')

@section('title')
Order/ Edit/ <a href="{{ route('order.edit', ['id' => $order->id ]) }}">{{ $order->id }}</a>
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
                    <div class="card-header">Add new order</div>
                    <div class="card-body text-dark">
                        <form class="form-horizontal" name="order_add">

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="date" class="col-sm-6 control-label">Date</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Select a date" value="{{ $order->date }}" readonly>
                                </div>
                            </div>       

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="language" class="col-sm-6 control-label">Language</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="language" name="language">
                                        @foreach($languages AS $language)
                                            <option value="{{ $language->id }}" @if($language->id==$order->size) selected @endif>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="payment_method" class="col-sm-6 control-label">Payment Method</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="payment_method" name="payment_method">
                                        @foreach($payment_methods AS $payment_method)
                                            <option value="{{ $payment_method->id }}" @if($payment_method->id==$order->payment_method) selected @endif>{{ $payment_method->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="delivery_method" class="col-sm-6 control-label">Delivery Method</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="delivery_method" name="delivery_method">
                                        @foreach($delivery_methods AS $delivery_method)
                                            <option value="{{ $delivery_method->id }}" @if($delivery_method->id==$order->delivery_method) selected @endif>{{ $delivery_method->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="qty" class="col-sm-6 control-label">Quantity</label>
                                <div class="col-sm-6">
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter the required quantity" min="1" value="{{ $order->qty }}">
                                </div>
                            </div>  
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Order</button>
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

        $("form[name='order_add']").validate({
            rules: {
                date: {
                    required: true
                },
                language: {
                    required: true
                },
                payment_method: {
                    required: true
                },
                delivery_method: {
                    required: true
                },
                qty: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                date: {
                 required: "Please select a date"
                },
                language: {
                    required: "Please select a language"
                },
                payment_method: {
                    required: "Please select a payment method"
                },
                delivery_method: {
                    required: "Please select a delivery method"
                },
                qty: {
                    required: "Please enter the quantity",
                    digits: "Please enter a valid quantity"
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
                
                var date = $("#date").val();
                var language = $("#language").val();
                var payment_method = $("#payment_method").val();
                var delivery_method = $("#delivery_method").val();
                var qty = $("#qty").val();

                var token = "{{ Session::token() }}";
                        
                $.ajax({
                    url: "{{ route('order.update', [ 'id' => $order->id ]) }}",
                    type: "post",
                    data: ({ date: date, language: language, payment_method: payment_method, delivery_method: delivery_method, qty: qty, _token: token }),
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