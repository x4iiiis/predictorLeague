@extends('layouts.app')

@section('content')
    <!-- Backend Vue Component -->
    <backend :users="{{ $users }}"/>
@endsection
