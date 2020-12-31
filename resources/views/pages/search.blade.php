@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <!-- Form -->
    <form action="{{ route('search') }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" name="inputCity" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select name="inputState" id="inputState" class="form-control">
                    <option selected></option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" name="inputZipCode" id="inputZip">
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <br/>
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
                <tbody>
                <tr>
                    <td colspan="12">No data found</td>
                </tr>
                </tbody>
            @endif
        </table>
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>
    @else
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
                    <td colspan="12">No data found</td>
                </tr>
            </tbody>
        </table>
    @endif
@endsection
