@extends('template.template')

@push('custom-css')
    
@endpush

@section('content')
    <div class="container">
        @if (Auth::user()->isAdmin == 1)
            <a href="/assessment/manage" class="btn btn-primary btn-sm mt-3">Manage Assessment</a>
        @endif
        <div class="card" style="margin-top: 15px">
            <div class="card-body">
                <div class="accordion accordion-style-three" id="accordionStyle3">
                    @foreach ($assessment as $a)
                        <!-- Single Accordion -->
                        <div class="accordion-item">
                            <div class="accordion-header" id="accordion{{ $a->id }}uy">
                                <h6 class="shadow-sm rounded collapsed border" data-bs-toggle="collapse" data-bs-target="#accordionStyle{{ $a->id }}uy" aria-expanded="false" aria-controls="accordionStyle{{ $a->id }}uy">{{ $a->name }}
                                <svg class="bi bi-arrow-down-short" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"></path>
                                </svg>
                                </h6>
                            </div>
                            <div class="accordion-collapse collapse" id="accordionStyle{{ $a->id }}uy" aria-labelledby="accordion{{ $a->id }}uy" data-bs-parent="#accordionStyle{{ $a->id }}uy">
                                <div class="accordion-body">
                                <p class="mb-0" style="white-space: pre-line">{{ $a->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    
@endpush