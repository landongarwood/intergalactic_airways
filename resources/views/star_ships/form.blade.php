@extends('layout')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post">
                @csrf

                <div class="card">
                    <div class="card-header">
                        Get List of Transpotions
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Number of Passengers:</label>
                            <input type="number" class="form-control" placeholder="300" name="number_of_passengers">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Get List</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scriptsAfter')
    <script>
        $(document).ready(function () {
            $("form").submit(function() {
                $(this).find('button[type=submit]')
                    .attr('disabled', 'disabled')
                    .addClass('disabled')
                    .text('Loading...');
            })
        });
    </script>
@endpush
