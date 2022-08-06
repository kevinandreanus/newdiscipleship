@extends('template.template')

@push('custom-css')
    <style>
        #questionTable_wrapper {
            padding-top: 30px !important;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 8px 18px !important;
        }

        #questionTable td {
            font-size: 12px !important;
        }

        #questionTable_filter {
            font-size: 10px !important;
        }

        #questionTable_length {
            font-size: 10px !important;
        }

        #questionTable_paginate {
            margin-top: 10px !important;
        }

        #questionTable thead {
            font-size: 12px !important;
        }

        .dataTables_wrapper .dataTables_length {
            float: left !important;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right !important;
            text-align: right !important;
        }

        @media screen and (max-width: 640px) {
            .dataTables_wrapper .dataTables_filter {
                margin-top: 0px !important;
            }
        }

        #deleteBtn {
            padding: 3px 6px !important;
            font-size: 10px !important;
        }

        #editBtn {
            padding: 3px 6px !important;
            font-size: 10px !important;
        }

    </style>
@endpush

@section('content')
    <div class="container" style="padding-top: 20px">
        <div class="card">
            <div class="card-body">
                <form action="/assessment/update" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $assessment->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleTextarea1">Description</label>
                        <textarea class="form-control" id="exampleTextarea1" name="description" cols="3" rows="5"
                            required>{{ $assessment->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="evaluation_method">Evaluation Method</label>
                        <select class="form-select" id="evaluation_method" name="evaluation_method"
                            aria-label="Default select example">
                            <option value="manual" {{ $assessment->evaluation_method == 'manual' ? 'selected' : '' }}>
                                Evaluate Manually</option>
                            <option value="system" {{ $assessment->evaluation_method == 'system' ? 'selected' : '' }}>
                                Evaluate by System</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                        type="submit">Save</button>
                </form>
            </div>
        </div>
        <div class="card" style="margin-top: 12px">
            <div class="card-body">
                <h5 class="text-center"><u>Questions</u></h5>
                <div class="text-end">
                    <a id="addQuestionBtn" class="btn btn-primary btn-sm mt-3">Add Question</a>
                </div>
                <table style="width: 100% !important" class="stripe" id="questionTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Question</th>
                            <th>Total Option</th>
                            <th>#</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($questions as $key => $q)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $q->question }}</td>
                                <td>{{ $q->options_count }}</td>
                                <td><a class="btn btn-sm btn-warning" data-id="{{ $q->id }}" id="editBtn"
                                        style="margin-right: 5px">Edit</a><a class="btn btn-sm btn-danger"
                                        data-id="{{ $q->id }}" id="deleteBtn">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Question Modal --}}
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Question</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/question/store" method="POST">
                        @csrf
                        <input type="text" name="assessment_id" class="form-control" hidden
                            value="{{ $assessment->id }}">
                        <div class="form-group mb-3">
                            <label class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="number_of_option">Number of Option <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="number_of_option" aria-label="Default select example">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Option <span class="text-danger">*</span></label>
                            <div class="option_container">
                                <input type="text" name="value[]" class="form-control" placeholder="Value" required>
                                <input type="text" style="margin-top: 5px;" name="option[]" class="form-control"
                                    placeholder="Name" required>
                            </div>
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

    {{-- Edit Question Modal --}}
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Edit Question</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/question/update" method="POST">
                        @csrf
                        <input type="text" name="assessment_id" class="form-control" hidden
                            value="{{ $assessment->id }}">
                        <input type="text" name="question_id" id="question_id" class="form-control" hidden>
                        <div class="form-group mb-3">
                            <label class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" id="question_edit" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="number_of_option">Number of Option <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="number_of_option_edit" aria-label="Default select example">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Option <span class="text-danger">*</span></label>
                            <div class="option_container_edit">
                                <input type="text" name="value[]" class="form-control" placeholder="Value" required>
                                <input type="text" style="margin-top: 5px;" name="option[]" class="form-control"
                                    placeholder="Name" required>
                            </div>
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
            function showAlert(title) {
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

            showAlert('Successfully Add Question!');
        </script>
    @endif
    @if (\Session::has('success-delete'))
        <script>
            function showAlert(title) {
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

            showAlert('Successfully Delete Question!');
        </script>
    @endif
    <script>
        var initialOptionValue = $('#number_of_option').val();

        $('#questionTable').DataTable({
            responsive: true,
        });

        $('#addQuestionBtn').on('click', function() {
            $('#addQuestionModal').modal("show");
        });

        $('#number_of_option').on('change', function() {
            var value = $(this).val();
            $('.option_container').empty();

            for (let i = 0; i < value; i++) {
                $('.option_container').append(
                    `
                    <input style="margin-top: 5px;" type="text" name="value[]" class="form-control" placeholder="Value" required>
                    <input type="text" style="margin-top: 5px;" name="option[]" class="form-control" placeholder="Name" required> 
                `);
            }
        });

        $('#deleteBtn').on('click', function() {
            if (confirm('Are you sure you want to delete?') == true) {
                var id = $(this).data('id');

                $(this).attr('href', '/question/delete/' + id);
            }
        });

        $('#editBtn').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/question/edit/' + id,
                success: function(result) {
                    console.log(result);
                    var options = result.options;
                    $('.option_container_edit').empty();
                    $('#question_edit').val(result.question);
                    $('#question_id').val(result.id);
                    $('#number_of_option_edit').val(options.length);
                    $.each(options, function(key, value) {
                        $('.option_container_edit').append(
                            `
                        <input style="margin-top: 5px;" type="text" name="value[]" class="form-control" placeholder="Value" value="` +
                            value.value +
                            `" required>
                        <input type="text" style="margin-top: 5px;" name="option[]" class="form-control" placeholder="Name" value="` +
                            value.option + `" required> 
                    `);
                    });
                }
            });
            $('#editQuestionModal').modal("show");
        })
    </script>
@endpush
