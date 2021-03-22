@extends('layouts.main')

@php
    $role = \App\Role::select('name')->where('id', Auth::user()->role_id)->first()->name;
@endphp

@section('title')
Report/ <a href="{{ route('report.advertisement') }}">Advertisement</a>
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
                    <div class="card-header">Advertisement Report</div>
                    <div class="card-body text-dark">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ date('Y-m-d', strtotime('-1 months')) }}" placeholder="Start Date" id="start" readonly="">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" placeholder="End Date" id="end" readonly="">
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="price" name="price">
                                    <option value="0">Select Price</option>
                                    
                                    <option value="150">>1000</option>
                                    <option value="200">>2000</option>
                                    <option value="300">>3000</option>
                                    <option value="400">>4000</option>
                                    {{-- @foreach($prices AS $price)
                                    <option value="{{ $price->id }}">{{ $price->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            
                            
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-4">
                                <select class="form-control" placeholder="Executive" id="userName" name="userName">
                                    <option value="0">All Users</option>
                                    @foreach($users AS $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="salesMonth" name="salesMonth">
                                    <option value="0">All Months</option>
                                    <option value="LOctober">Last October</option>
                                    <option value="LNovember">Last November</option>
                                    <option value="LDecember">Last December</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                            </select>
                            </div>
                            {{-- <div class="col-sm-4">
                                <button type="submit" id="update" class="btn btn-success">Update</button>
                            </div> --}}
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-3">
                                <select class="form-control" id="category" name="category">
                                    <option value="0">All Categories</option>
                                    @foreach($categories AS $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <select class="form-control" id="size" name="size">
                                    <option value="0">All Sizes</option>
                                    @foreach($sizes AS $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <select class="form-control" id="colour" name="colour">
                                    <option value="0">All Colour Options</option>
                                    @foreach($colours AS $colour)
                                        <option value="{{ $colour->id }}">{{ $colour->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-sm-3">
                                <button type="submit" id="update" class="btn btn-success">Update</button>
                            </div>
                        </div>

                        <form class="form-inline" style="margin-top: 30px;">                        
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="from"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="to"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="tableUser" ></p>
                                </div>
                            </div>      
                        </form>

                        <form class="form-inline" style="margin-top: 10px;">                        
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="category_text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="size_text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="colour_text" ></p>
                                </div>
                            </div>      
                        </form>
    
                        <form class="form-inline" style="margin-top: 10px;">                                
                            <div class="form-group">
                                <div class="col-sm-12">
                                <p class="form-control-static" id="amount"></p>
                                </div>
                            </div>        
                        </form>

                        <div class="table-responsive">
                            <table id="advertisement" class="table table-hover table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Colour</th>
                                        <th>Submitted On</th>
                                        <th>User Name</th>
                                        <th>Price</th>
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

        var table = $('#advertisement').DataTable({
                "bLengthChange": false, //pagination length 
                "pagingType": "simple", //prev next
                "ordering": false, //column asc or desc
                dom: 'Bfrtip', 
                buttons:[{ 
                    extend: 'excel', 
                    text: 'Save as Excel', 
                    title: 'Advertisement Report' } 
                ],
                language: { 
                    search: "_INPUT_", 
                    searchPlaceholder: "Search..." 
                },
                "ajax": {
                    url : "{{ route('report.ad_list') }}", 
                    data : function(d) { 
                        d.starting = document.getElementById("start").value; 
                        d.ending = document.getElementById("end").value;
                        d.salesMonth = document.getElementById("salesMonth").value; 
                        d.user = document.getElementById("userName").value; 
                        d.category = document.getElementById("category").value; 
                        d.colour = document.getElementById("colour").value; 
                        d.size = document.getElementById("size").value;
                }, 
                dataSrc : function(json){ 
                        $('#from').html("<b>From: </b>"+json.from); 
                        $('#to').html("<b>To: </b>"+json.to); 
                        $('#tableUser').html("<b>User: </b>"+json.user); 
                        $('#tableExecutive').html("<b>Executive: </b>"+json.executive); 
                        $('#category_text').html("<b>Category: </b>"+json.category); 
                        $('#size_text').html("<b>Size: </b>"+json.size); 
                        $('#colour_text').html("<b>Colour: </b>"+json.colour);
                        $('#amount').html("<b>Total: </b> Rs. "+json.amount); return json.data; 
                    } 
                }, 
                columns: [   //read the column name from the database
                    { data: "id" }, 
                    { data: "category" }, 
                    { data: "size" }, 
                    { data: "colour" }, 
                    { data: "submitted_on" }, 
                    { data: "user" }, 
                    { data: "price" } 
                ]
        });

        //table.buttons().container().appendTo('.outstanding_wrapper' );

        $( "button" ).click(function(event) {
            event.preventDefault();    //the page is not reloading

            var startDate = $('#start').val();
            var endDate = $('#end').val();
            // var executive = $('#executive').val();
            // var user = $('#userName').val();
            // var salesMonth = $('#salesMonth').val();

            if(startDate==""){
                $('#start').val("");
                $('#end').val("");
            }

            table.ajax.reload();

            // var serializedData = "startDate=" + startDate + "&endDate=" + endDate + "&executive=" + executive + "&user=" + user + "&salesMonth="+ salesMonth;

            // $.alert({
            //     type: 'red',
            //     title: 'Alert!',
            //     content: "No records found for the selected month",
            // });

        });

        $('#start').datetimepicker({
            minView: 2,
            format: 'yyyy-mm-dd',
            startDate: '2017-03-01',
            endDate: new Date(),
            weekStart: 1,
            todayBtn:  1,
            todayHighlight: 1,
            showMeridian: 1,
            startView: 2,
            forceParse: 0,                    
            autoclose: true
        });

        $('#end').datetimepicker({
            minView: 2,
            format: 'yyyy-mm-dd',
            endDate: new Date(),
            weekStart: 1,
            todayBtn:  1,
            todayHighlight: 1,
            showMeridian: 1,
            startView: 2,
            forceParse: 0,                    
            autoclose: true
        });

        $('#start').datetimepicker().on('changeDate', function(ev){
            $('#end').datetimepicker('setStartDate', $('#start').val());                
            $('#end').datetimepicker('show');  //automatically open
            $("#salesMonth").val("0");  //value of all months is 0
        });

        $('#end').on('click', function(ev){  //if someone selects the end date automatically start date will come
            if($('#start').val()==""){
                $('#end').datetimepicker('hide');
                $('#start').datetimepicker('show');
            }
        });

        $('#end').datetimepicker().on('changeDate', function(ev){
            $("#salesMonth").val("0");
        });

        $('#salesMonth').on('change', function (e) {  //if we select the month start and date is empty
            $('#start').val("");
            $('#end').val("");
        });

    }); 

    // function historyMonth(receivedMonth){
    //     if(receivedMonth=="LDecember"){
    //         var month = "December";
    //         var year = new Date().getFullYear()-1;            
    //     }
    //     else if(receivedMonth=="LNovember"){
    //         var month = "November";
    //         var year = new Date().getFullYear()-1; 
    //     }
    //     else{
    //         var month = receivedMonth;
    //         var year = new Date().getFullYear();
    //     }

    //     return month +" "+year;
    // }


</script>
   
@endsection