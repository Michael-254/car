@extends('layouts.parent')

@section('content')

   @livewire('nonconformance',['selectedTask' => $selectedTask])

@endsection