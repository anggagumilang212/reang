@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Media review successfully created</h1>

   <a href="{{ route('mediareview.create') }}" class="btn btn-primary">Back</a>
</div>
@endsection
