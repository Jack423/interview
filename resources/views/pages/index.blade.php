@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if($message = session()->get('success'))
        <div class="alert alert-success fade show" role="alert">
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif
    <br/>
    <!-- Form -->
    <form action="{{ route('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="import_file"/>
        <button class="btn btn-primary">Import File</button>
    </form>
@endsection
