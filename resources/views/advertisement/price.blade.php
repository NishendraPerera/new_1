@extends('layouts.main')

@section('title')
Advertisement/ <a href="{{ route('advertisement.price') }}">Price</a>
@endsection

@section('content')

<section>
    <div class="container-fluid">

        @if (Session::has('success'))       
            <div class="alert alert-success">
                <ul>
                {{ session('success') }}
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-dark">
                    <div class="card-header">Price List</div>
                    <div class="card-body text-dark">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr> 
                                        <th>Size</th>
                                        <th>Colour</th><th>Price</th><th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $( document ).ready( function () {

        var token = "{{ Session::token() }}";

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        var table1 = $('#example1').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false, 
            "dom" : "<'row'<'col-sm-4'B><'col-sm-8'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>" ,
            buttons:[{ text: 'Add New', className: "btn-sm btn-dark", action: function ( e, dt, node, config ) { $("#PriceNew").modal();  } }],
            language: { search: "_INPUT_", searchPlaceholder: "Search..." },
            "ajax": '{{ route('advertisement.price_list') }}',
            columns: [ { data: "size" }
            , { data: "colour" }, { data: "price" }, { "defaultContent": '<a class="confirm" href="javascript:void(0)" title="Edit"><i class="icon-form"></i></a>' } 
            ]
            ,columnDefs: [ {"targets": 3, "className": "text-center" } ]

        }); 

        $('#example1 tbody').on( 'click', 'i', function () {
            $("#LoadingImage").show();

            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];

            $.get( "{{ route('advertisement.price_show') }}" ,  {id: id},function(data, status){
                          
                var id      = data['data']['id'];
                var size    = data['data']['size'];
                var colour  = data['data']['colour'];
                var price   = data['data']['price'];

                $(".modal-body #Eid").val( id );
                $(".modal-body #Esize select").val( size );
                $(".modal-body #Ecolour select").val( colour );
                $(".modal-body #Eprice").val( price );

                $("#LoadingImage").hide();
                $("#priceEdit").modal({ backdrop: 'static', keyboard: false });

            });
        });
    });

</script>

{{-- Modal PriceNew --}}
<div class="modal fade" id="PriceNew" role="dialog">
    <div class="modal-dialog">        
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">New Price</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">            
                <div class="row">
                    <div class="offset-lg-1 col-lg-10">
                        <form class="form-horizontal" name="newPrice">
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="size" class="col-sm-12 control-label">Size</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="Nsize" name="Nsize">
                                        <option value="" selected></option>
                                        @foreach($sizes AS $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="colour" class="col-sm-12 control-label">Colour</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="Ncolour" name="Ncolour">
                                        <option value="" selected></option>
                                        @foreach($colours AS $colour)
                                            <option value="{{ $colour->id }}">{{ $colour->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="date" class="col-sm-12 control-label">Price</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" id="Nprice" name="Nprice" placeholder="Enter the price">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>        
    </div>    
</div>

{{-- Modal PriceEdit --}}
<div class="modal fade" id="priceEdit" role="dialog">
    <div class="modal-dialog modal-lg">    
    
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Price Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" name="editPrice">

                    <input type="hidden" id="Eid" name="Eid">

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="size" class="col-sm-12 control-label">Size</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="Esize" name="Esize">
                                @foreach($sizes AS $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="colour" class="col-sm-12 control-label">Colour</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="Ecolour" name="Ecolour">
                                @foreach($colours AS $colour)
                                    <option value="{{ $colour->id }}">{{ $colour->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="date" class="col-sm-12 control-label">Price</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="Eprice" name="Eprice" placeholder="Enter the price">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 20px;">
                        <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>        
    </div>    
</div>

<script>
    $(function() {
        $("form[name='newPrice']").validate({
            rules: {
                Nsize: {
                    required: true
                },
                Ncolour: {
                    required: true
                },
                Nprice: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                Nsize: {
                    required: "Please select a size"
                },
                Ncolour: {
                    required: "Please select a colour"
                },
                Nprice: {
                    required: "Please enter the price",
                    digits: "Please enter a valid number"
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
                
                var size     = $("#Nsize").val();
                var colour   = $("#Ncolour").val();
                var price   = $("#Nprice").val();
                
                var token = "{{ Session::token() }}";

                $.ajax({
                    url: "{{ route('advertisement.price_store') }}",
                    type: "post",
                    data: ({
                        size: size, colour: colour, price: price, _token: token  }),
                    success: function (data) {

                        if(data=="Success"){
                            window.scrollTo(0, 0);
                            location.reload(true);
                        }
                        else{
                            $.alert({
                                type: 'red',
                                title: 'Alert!',
                                content: data
                            });
                        }                           
                    },error: function (data) {
                        console.log(data);
                        $.alert({
                            type: 'red',
                            title: 'Alert!',
                            content: "Can't process this request"
                        });
                    }
                });

            }
        });

        $("form[name='editPrice']").validate({
            rules: {
                Esize: {
                    required: true
                },
                Ecolour: {
                    required: true
                },
                Eprice: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                Esize: {
                    required: "Please select a size"
                },
                Ecolour: {
                    required: "Please select a colour"
                },
                Eprice: {
                    required: "Please enter the price",
                    digits: "Please enter a valid number"
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
                
                var id     = $("#Eid").val();
                var size     = $("#Esize").val();
                var colour   = $("#Ecolour").val();
                var price   = $("#Eprice").val();
                
                var token = "{{ Session::token() }}";

                $.ajax({
                    url: "{{ route('advertisement.price_edit') }}",
                    type: "post",
                    data: ({
                        id: id, size: size, colour: colour, price: price, _token: token  }),
                    success: function (data) {
                        if(data=="Success"){
                            window.scrollTo(0, 0);
                            location.reload(true);
                        }
                        else{
                            $.alert({
                                type: 'red',
                                title: 'Alert!',
                                content: data
                            });
                        }                           
                    },error: function (data) {
                        console.log(data);
                        $.alert({
                            type: 'red',
                            title: 'Alert!',
                            content: "Can't process this request"
                        });
                    }
                });

            }
        });
    });

</script>
   
@endsection