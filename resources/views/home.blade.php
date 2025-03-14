@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <br><br>
                        <div class="row ">
                            <div class="col text-center">
                                <a class="btn btn-primary" href="{{ route('users') }}">USERS </a>
                            </div>

                            <div class="col text-center">
                                <a class="btn btn-primary" href="{{ route('schools.index') }}">SCHOOLS </a>
                            </div>
                            <div class="col text-center">
                                <a class="btn btn-primary" href="{{ route('levels.index') }}">CLASSES </a>
                            </div>

                            <div class="col text-center">
                                <a class="btn btn-primary" href="{{ route('students.index') }}">STUDENTS </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
