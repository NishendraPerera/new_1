@extends('layouts.main')

@php
    $role = \App\Role::select('name')->where('id', Auth::user()->role_id)->first()->name;
@endphp

@section('title')
Orders/ <a href="{{ route('order.home') }}">All</a>
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
                    <div class="card-header">User List</div>
                    <div class="card-body text-dark">
                        <table id="table" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Language</th>
                                    <th>Delivery Method</th>
                                    <th>Payment Method</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>

</section>

<script type="text/javascript">
          
    $( document ).ready( function () {

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        @if($role=="User")
            var content = '<a href="javascript:void(0)" title="Edit Order"><i class="icon-padnote" id="edit"></i></a>';
        @elseif($role=="Editor")
            var content = '';
        @else
            var content = '<a href="javascript:void(0)" title="Delete Order"><i class="icon-close" id="delete"></i></a>';
        @endif

        var table1 = $('#table').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false,
            language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
            "ajax": '{{ route('order.index') }}',
            columns: [  { data: "id" }, { data: "user" }, { data: "date" }, { data: "language" }, { data: "delivery_method" }, { data: "payment_method" }, { data: "qty" },
                {  "defaultContent": content }],
            columnDefs: [ {"targets": 7, "className": "text-center" } ]
        }); 

        $('#table tbody').on( 'click', '#edit', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var url = "{{ URL::to('order/edit') }}/" + id;

            var win = window.open(url, '_self');
        });

        $('#table tbody').on( 'click', '#delete', function () {
            var data = table1.row( $(this).parents('tr') ).data();

            var id = data['id'];
            var token = "{{ Session::token() }}";
            
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you really want to remove this order?',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {  
                            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                            
                            $.ajax({
                                url: "{{ route('order.delete') }}",
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

</script>
   
@endsection