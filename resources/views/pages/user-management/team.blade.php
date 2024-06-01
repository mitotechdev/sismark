@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Personil Business</h4>
        @foreach ($grouped_personils as $key => $personils)
        <div class="row g-3 my-3">
            <h5 class="mb-0 text-muted">{{ $key }}</h5>
            @foreach ($personils as $personil)
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body pb-0">
                        <div>
                            <div class="col-5 mx-auto py-3">
                                @if ($personil->image)
                                    <img src="{{ asset('storage/'. $personil->image) }}" class="img-thumbnail rounded-circle border border-secondary" />
                                @else
                                    <img src="{{ Vite::asset('resources/img/avatar.png') }}" class="img-thumbnail rounded-circle border border-secondary"/>    
                                @endif  
                            </div>
                            <h5 class="card-title mb-1">{{ $personil->full_name }}</h5>
                            <p class="card-text mb-0">{{ $personil->title }}</p>
                            <div class="row my-3">
                                <div class="col-4">
                                    <h6 class="mb-0">
                                        {{ $personil->projects->filter(function ($project) {
                                            return $project->prospect_id == 2;
                                        })->count();
                                        }}
                                    </h6>
                                    <small class="text-primary">P</small>
                                </div>
                                <div class="col-4">
                                    <h6 class="mb-0">
                                        {{ $personil->projects->filter(function ($project) {
                                            return $project->prospect_id == 3;
                                        })->count();
                                        }}
                                    </h6>
                                    <small class="text-success">HP</small>
                                </div>
                                <div class="col-4">
                                    <h6 class="mb-0">
                                        {{ $personil->projects->filter(function ($project) {
                                            return $project->prospect_id == 4;
                                        })->count();
                                        }}
                                    </h6>
                                    <small class="text-warning">LP</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-sm btn-primary">See More Profile</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection