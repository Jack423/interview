@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if($message = session()->get('success'))
        <div class="alert alert-success fade show" role="alert">
            <strong>Success!</strong> {{ $message }}
{{--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
        </div>
    @endif
    {{session()->forget('success')}}
    <br/>
    <!-- Form -->
    <form action="{{ route('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="import_file"/>
        <button class="btn btn-primary">Import File</button>
    </form>
@endsection
