@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card main">
                <div class="card-body">
                    <h4 class="display-4 text-white">Welcome to Meru university clearance system</h4>
                    <div>
                        <p class="lead text-white">This system enables you to get cleared once reqistered and download
                            clearance
                            form</p>
                    </div>
                    <div>
                        <h5 class="text-white mb-3">By following these three simple steps</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p>Register and fill out the clearance form</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p>View clearance status,file complaint if any.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p>Upon being cleared ,Download clearance form </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3">
                            <a href="/home" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection