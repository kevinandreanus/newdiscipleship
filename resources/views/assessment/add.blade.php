@extends('template.template')

@push('custom-css')
    
@endpush

@section('content')
    <div class="container" style="padding-top: 20px">
        <div class="card">
            <div class="card-body">
                <form action="/assessment/store" method="POST">
                    @csrf
                    <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleTextarea1">Description</label>
                        <textarea class="form-control" id="exampleTextarea1" name="description" cols="3" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="evaluation_method">Evaluation Method</label>
                        <select class="form-select" id="evaluation_method" name="evaluation_method" aria-label="Default select example">
                          <option value="manual" selected>Evaluate Manually</option>
                          <option value="system">Evaluate by System</option>
                        </select>
                      </div>     
                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    
@endpush