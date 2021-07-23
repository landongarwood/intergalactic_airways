@extends('layout')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                Available Transpotions
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($starShips as $starShip)
                    @foreach ($starShip['pilots'] as $pilot)
                        <li class="list-group-item">{{ $starShip['name'] }} - {{ $pilot['name'] }}</li>
                    @endforeach
                @endforeach
                
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>
@endsection
