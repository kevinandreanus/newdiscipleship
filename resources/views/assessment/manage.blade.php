@extends('template.template')

@push('custom-css')
<style>
    #manageTable_wrapper{
        padding-top: 30px !important;
    }
    table.dataTable tbody th, table.dataTable tbody td{
        padding: 8px 18px !important;
    }
    #manageTable td{
        font-size: 12px !important;
    }
    #manageTable_filter{
        font-size: 10px !important;
    }
    #manageTable_length{
        font-size: 10px !important;
    }
    #manageTable_paginate{
        margin-top: 10px !important;
    }
    #manageTable thead{
        font-size: 12px !important;
    }
    .dataTables_wrapper .dataTables_length{
        float: left !important;
    }
    .dataTables_wrapper .dataTables_filter{
        float: right !important;
        text-align: right !important;
    }
    @media screen and (max-width: 640px){
        .dataTables_wrapper .dataTables_filter{
            margin-top: 0px !important;
        }
    }
    #deleteBtn{
        padding: 3px 6px !important;
        font-size: 10px !important;
    }
    #editBtn{
        padding: 3px 6px !important;
        font-size: 10px !important;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <div class="text-end">
            <a href="/assessment/add" id="addSliderBtn" class="btn btn-primary btn-sm mt-3">Add Assessment</a>
        </div>
        <table style="width: 100% !important" class="stripe" id="manageTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Evaluation by</th>
                    <th>Description</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assessment as $key => $a)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ ucfirst($a->evaluation_method) }}</td>
                        <td>{{ $a->description }}</td>
                        <td><a href="/assessment/edit/{{ $a->id }}" class="btn btn-sm btn-warning" id="editBtn" style="margin-right: 5px">Edit</a><a class="btn btn-sm btn-danger btnDeleteNih" id="deleteBtn" data-id="{{ $a->id }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('custom-js')
@if (\Session::has('success-add'))
    <script>
        function showAlert(title){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: title
            });
        }

        showAlert('Successfully Add Assessment!');
    </script>
@endif
@if (\Session::has('success-delete'))
    <script>
        function showAlert(title){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: title
            });
        }

        showAlert('Successfully Delete Assessment!');
    </script>
@endif
<script>
    $('#manageTable').DataTable({
        responsive: true,
    });

    $('#deleteBtn').on('click', function(){
        if (confirm('Are you sure you want to delete?') == true) {
            var id = $(this).data('id');
            
            $(this).attr('href', '/assessment/delete/'+id);
        }
    });
</script>
@endpush