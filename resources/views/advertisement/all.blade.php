@extends('layouts.main')

@php
    $role = \App\Role::select('name')->where('id', Auth::user()->role_id)->first()->name;
@endphp

@section('title')
Advertisement/ <a href="{{ route('advertisement.home') }}">All</a>
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
                    <div class="card-header">Advertisement List</div>
                    <div class="card-body text-dark">
                        <table id="table" class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Size</th>
                                    <th>Colour</th>
                                    <th>Category</th>
                                    <th>Language</th>  
                                    <th>Price</th>                                  
                                    <th>Paid</th>
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
            var content = '<a href="javascript:void(0)" title="View Advertisement"><i class="icon-padnote" id="view"></i></a> <a href="javascript:void(0)" title="Edit Advertisement"><i class="icon-padnote" id="edit"></i></a>';
        @elseif($role=="Editor")
            var content = '<a href="javascript:void(0)" title="View Advertisement"><i class="icon-padnote" id="view"></i></a> ';
        @else
            var content = '<a href="javascript:void(0)" title="View Advertisement"><i class="icon-padnote" id="view"></i></a> <a href="javascript:void(0)" title="Delete Advertisement"><i class="icon-close" id="delete"></i></a>';
        @endif

        var table1 = $('#table').DataTable({
            "bLengthChange": false, "pagingType": "simple", "ordering": false,
            language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
            "ajax": '{{ route('advertisement.index') }}',
            columns: [  { data: "id" }, { data: "user" }, { data: "date" }, { data: "size" }, { data: "colour" }, { data: "category" }, { data: "language" }, { data: "price" }, { data: "paid" },
                {  "defaultContent": content }],
            columnDefs: [ {"targets": 9, "className": "text-center" } ]
        }); 

        // var table1 = $('#table').DataTable({
        //     "bLengthChange": false, "pagingType": "simple", "ordering": false,
        //     language: { search: "_INPUT_", searchPlaceholder: "Search...", infoEmpty: "Nothing to show", infoFiltered: "" },
        //     "ajax": '{{ route('advertisement.index') }}',
        //     columns: [  { data: "id" },
        //         {  "defaultContent": '<a href="javascript:void(0)" title="View Article"><i class="icon-padnote" id="view"></i></a> <a href="javascript:void(0)" title="Edit Article"><i class="icon-padnote" id="edit"></i></a> <a href="javascript:void(0)" title="Delete Article"><i class="icon-close" id="delete"></i></a>' }],
        //     //columnDefs: [ {"targets": 7, "className": "text-center" } ]
        // }); 

        $('#table tbody').on( 'click', '#view', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var link = data['link'];

            var win = window.open(link, '_blank');
        });

        $('#table tbody').on( 'click', '#edit', function () {
            var data = table1.row( $(this).parents('tr') ).data();
            var id = data['id'];
            var url = "{{ URL::to('advertisement/edit') }}/" + id;

            var win = window.open(url, '_self');
        });

        $('#table tbody').on( 'click', '#delete', function () {
            var data = table1.row( $(this).parents('tr') ).data();

            var id = data['id'];
            var token = "{{ Session::token() }}";
            
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you really want to delete this advertisement?',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        action: function () {  
                            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                            
                            $.ajax({
                                url: "{{ route('advertisement.delete') }}",
                                type: "post",
                                data: ({ id: id, _token: token }),  
                                success: function () {         
                                    window.scrollTo(0, 0);     
                                    location.reload(true);
                                },
                                error: function (xhr, status, error) {
                                    window.scrollTo(0, 0);
                                    $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                                    console.log(xhr);
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