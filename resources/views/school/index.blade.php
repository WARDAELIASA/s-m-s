@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row py-4">
            <div class="col">
                <h3>Schools</h3>
            </div>
            <div class="col text-end"> <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                    data-bs-target="#add-school">Add School</a>
            </div>
        </div>
        <table class="table table-bordered" id="example">
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
                @foreach ($schools as $school)
                    <tr>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->address }}</td>
                        <td>{{ $school->email }}</td>
                        <td>{{ $school->phone }}</td>
                        <td>{{ $school->location }}</td>
                        <td>
                            <div class="row ">
                                <div class="col text-end">
                                    <a class="btn btn-warning" href="#" data-bs-toggle="modal"
                                        data-bs-target="#edit-school-{{ $school->id }}">Edit</a>
                                </div>

                                <div class="col text-center">

                                    <form action="{{ route('schools.delete', $school->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>

                                <div class="modal modal-md fade" id="edit-school-{{ $school->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add School</h5>

                                            </div>
                                            <form class="form" action="{{ route('schools.edit', $school->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label for="name">Name</label>
                                                    <input id="name" class="form-control" type="text"
                                                        value="{{ old('name', $school->name) }}" name="name" required
                                                        placeholder="Name">
                                                    <label for="phone">Phone</label>
                                                    <input id="phone" class="form-control" type="text"
                                                        value="{{ old('phone', $school->phone) }}" name="phone" required
                                                        placeholder="Phone">
                                                    <label for="email">Email</label>
                                                    <input id="email" class="form-control" type="email"
                                                        value="{{ old('email', $school->email) }}" name="email" required
                                                        placeholder="Email">
                                                    <label for="address">Address</label>
                                                    <input id="address" class="form-control" type="text"
                                                        value="{{ old('address', $school->address) }}" name="address"
                                                        required placeholder="Address">
                                                    <label for="location">Location</label>
                                                    <input id="location" class="form-control" type="text"
                                                        value="{{ old('location', $school->location) }}" name="location"
                                                        required placeholder="Location">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save
                                                        changes</button>
                                                </div>

                                                <div>
                                                    <a href="{{route('home')}}" class="btn-primary">HOME</a>

                                                </div>
                                                
                                            </form>

                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- Modal -->
        <div class="modal modal-md fade" id="add-school" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add School</h5>
                        {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form class="form" action="{{ route('schools.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" required
                                placeholder="Name">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control" type="text" name="phone" required
                                placeholder="Phone">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" required
                                placeholder="Email">
                            <label for="address">Address</label>
                            <input id="address" class="form-control" type="text" name="address" required
                                placeholder="Address">
                            <label for="location">Location</label>
                            <input id="location" class="form-control" type="text" name="location" required
                                placeholder="Location">

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
