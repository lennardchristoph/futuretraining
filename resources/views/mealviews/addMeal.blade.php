@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <livewire:meal-upload />
    </div>
@endsection