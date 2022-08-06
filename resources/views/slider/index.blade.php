@extends('template.template')

@push('custom-css')
    <style>
        #editTable_wrapper{
            padding-top: 30px !important;
        }
        table.dataTable tbody th, table.dataTable tbody td{
            padding: 8px 18px !important;
        }
        #deleteBtn{
            padding: 3px 6px !important;
            font-size: 10px !important;
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
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="text-end">
            <a id="addSliderBtn" class="btn btn-primary btn-sm mt-3">Add Slider</a>
        </div>
        <table id="editTable" style="width: 100% !important" class="stripe">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($slider as $key => $s)
                   <tr>
                       <td>{{ ++$key }}</td>
                       <td>{{ $s->title }}</td>
                       <td>{{ $s->caption }}</td>
                       <td>{{ $s->link }}</td>
                       <td><a href="/{{ $s->image_url }}" target="_blank">Click to View</a></td>
                       <td><a class="btn btn-sm btn-danger" id="deleteBtn" data-id="{{ $s->id }}">Delete</a></td>
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>

{{-- Add Slider Modal --}}
<div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Add Slider</h6>
          <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('slider-store') }}" method="POST" id="slidermodaladd" enctype="multipart/form-data">
                @csrf 
                <div class="form-group mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>   
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Caption</label>
                    <input type="text" name="caption" class="form-control">   
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Link</label>
                    <input type="text" name="link" class="form-control">   
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control">   
                </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-sm btn-success" type="submit" id="savebtn">Save</button>
        </div>
        </form>
      </div>
    </div>
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

        showAlert('Successfully Add Slider!');
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

        showAlert('Successfully Delete Slider!');
    </script>
@endif
    <script>
        $('#editTable').DataTable({
            responsive: true,
        });
        $('#addSliderBtn').on('click', function(){
            $('#addSliderModal').modal('show');
        });

        $('#deleteBtn').on('click', function(){
            if (confirm('Are you sure you want to delete?') == true) {
                var id = $(this).data('id');
                $(this).attr('href', '/slider/delete/'+id);
            }
        });

        
    </script>
@endpush
