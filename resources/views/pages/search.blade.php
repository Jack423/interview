@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <!-- Form -->
    <form action="{{ route('search') }}" class="form-horizontal" method="GET">
        {{ csrf_field() }}
        <div class="form-row">
            <!-- City Input -->
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" name="inputCity" id="inputCity" value="{{ old('inputCity') }}">
            </div>
            <!-- State Input -->
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select name="inputState" id="inputState" class="form-control">
                    <option selected></option>
                    <!-- Generates all the options but also adds the "old" function inside to get previous inputs for
                         The use in pagination or making new search requests -->
                    @foreach($states as $key => $val)
                        <option value="{{ $key }}" {{ (old("inputState") == $key ? "selected":"") }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Zip Code Input -->
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" name="inputZipCode" id="inputZip" value="{{ old('inputZipCode') }}">
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <br/>
    <!-- Data display in table -->
    @if($data ?? [])
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Zip Code</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">State FIPS</th>
                <th scope="col">County</th>
                <th scope="col">County FIPS</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">GMT</th>
                <th scope="col">DST</th>
            </tr>
            </thead>
            <!-- Make sure that we are only displaying data when we have it -->
            @if($data->count() > 0)
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->ZipCode }}</td>
                        <td>{{ $item->MixedCity }}</td>
                        <td>{{ $item->StateCode }}</td>
                        <td>{{ $item->StateFIPS }}</td>
                        <td>{{ $item->MixedCounty }}</td>
                        <td>{{ $item->CountyFIPS }}</td>
                        <td>{{ $item->Latitude }}</td>
                        <td>{{ $item->Longitude }}</td>
                        <td>{{ $item->GMT }}</td>
                        <td>{{ $item->DST }}</td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <!-- If there was no data, tell the user there were no results found -->
                <tbody>
                <tr>
                    <td colspan="12">No data found</td>
                </tr>
                </tbody>
            @endif
        </table>
        <!-- Pagination links but with the previous search query -->
        <div class="d-flex justify-content-center">
            {!! $data->withQueryString()->links() !!}
        </div>
    @else
        <!-- When the data variable doesn't exist, display that there was an issue getting the data -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Zip Code</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">State FIPS</th>
                    <th scope="col">County</th>
                    <th scope="col">County FIPS</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">GMT</th>
                    <th scope="col">DST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12">Unable to get data</td>
                </tr>
            </tbody>
        </table>
    @endif
@endsection
