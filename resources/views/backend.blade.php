@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Backend Vue Component -->
    <backend :users="{{ $users }}"/>
    
</div>
@endsection
