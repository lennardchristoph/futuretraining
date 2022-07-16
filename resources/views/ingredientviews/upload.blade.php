@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card">
            <h1 class="card-header">Upload</h1>
            <div class="card-body">
                <form action="{{route('ingredientsAddMany')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="custom-file mb-3">
                        <input type="file" name="ingredientsFile" class="custom-file-input" id="customFile" required>
                        @if ($errors->has('ingredientsFile'))
                            <span class="help-block">
                              <strong>{{ $errors->first('ingredientsFile') }}</strong>
                          </span>
                        @endif
                        <label class="custom-file-label" for="customFile">File</label>

                        <p>CSV-Format: Name; Nachname; E-Mail; Klasse; Jahrgang; Geburtsdatum;</p>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Does the File have an header?</label>
                        <div class="switch-button switch-button-success ml-2">
                            <input type="checkbox" checked="" name="header" id="switch16"><span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" placeholder="Upload" class="btn btn-primary">
                    </div>

                    @if(\Session::has('successUpload'))
                        <span class="error text-success">{{\Session::get('successUpload')}}</span>
                    @endif

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection