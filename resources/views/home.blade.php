@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        

        <div class="col-md-7">
            <!-- League Table Vue Component -->
            <League-Table></League-Table>
            <!-- Rules Vue Component -->
            <Rules></Rules>
        </div>


        <div class="col-md-5">
            <!-- Fixtures Vue Component --> 
            <Fixtures class="my-2"></Fixtures>
            <!-- Results Vue Component -->
            <Results></Results>
        </div>
    </div>
</div>
@endsection
