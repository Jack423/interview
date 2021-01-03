@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <!-- Form -->
    <form action="{{ route('advanced-search') }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputZip1">Zip 1</label>
                <input type="text" class="form-control" name="inputZip1" id="inputZip1">
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip2">Zip 1</label>
                <input type="text" class="form-control" name="inputZip2" id="inputZip2">
            </div>
            <div class="form-group col-md-4">
                <label for="inputDistance">Distance</label>
                <input type="text" class="form-control" name="inputDistance" id="inputDistance">
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary" id="button-search">Search</button>
        </div>
    </form>
    @if ($errors->any())
        <br />
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br/>
    @if($data ?? [] && $data->count() > 0)
        @foreach($data as $item)
            <div class="card">
                <div class="card-body">
                    <p>Zip Code 1: {{ $item->zip_code1 }}</p>
                    <p>Zip Code 2: {{ $item->zip_code2 }}</p>
                    <p>Distance: {{ $item->distance }} Miles</p>
                </div>
            </div>
            <br />
        @endforeach
    @else
        <div class="alert alert-info">
            No data found! Enter a zip code in the first box and zip codes separated by a comma in the second box along with a distance.
        </div>
    @endif
@endsection
