@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        
        <div class="col-md-7">
            <!-- Announcement Vue Commponent -->
            <Announcement></Announcement>
            
            <!-- League Table Vue Component -->
            <League-Table></League-Table>
            <!-- Rules Vue Component -->
            <Rules></Rules>
            <!-- Key Vue Component -->
            <Key></Key>
        </div>


        <div class="col-md-5">
            <!-- Fixtures Vue Component --> 
            <Fixtures class="my-2"></Fixtures>
            <!-- Results Vue Component -->
            <Results></Results>
        </div>

        <!-- <p>Down for some gentle TLC.</p>
        <br>
        <p>Check back soon!</p> -->
    </div>
</div>
@endsection
