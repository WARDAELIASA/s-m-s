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
                <h3>STUDENTS</h3>
            </div>
            <div class="col text-end"> <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                    data-bs-target="#add-student">Add student</a>
            </div>
        </div>
        <table class="table table-bordered" id="example">
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->level->name}}</td>
                        <td>
                            <div class="row ">
                                <div class="col text-end"> <a class="btn btn-warning" href="#" data-bs-toggle="modal"
                                        data-bs-target="#edit-student-{{ $student->id }}">Edit</a>
                                </div>

                                <div class="col text-center">
                                    <form action="{{ route('student.delete', $student->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                </div>
                                </form>

                                <div class="modal modal-md fade" id="edit-student-{{ $student->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add student</h5>

                                            </div>
                                            <form class="form" action="{{ route('student.edit', $student->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label for="name">Name</label>
                                                    <input id="name" class="form-control" type="text"
                                                        value="{{ old('name', $student->name) }}" name="name" required
                                                        placeholder="Name">

                                                        <label for="email">email</label>
                                                        <input id="email" class="form-control" type="email"
                                                            value="{{ old('name', $student->email) }}" name="email" required
                                                            placeholder="email">

                                                            <label for="address">address</label>
                                                    <input id="address" class="form-control" type="text"
                                                        value="{{ old('address', $student->address) }}" name="address" required
                                                        placeholder="address">


                                                    <label for="level_id">level</label>

                                                    <select id="leve_id" class="form-select" type="number"
                                                        name="level_id" required>
                                                        @foreach ($levels as $level)
                                                            <option value={{ $level->id }}
                                                                {{ $student->level_id == $level->id ? 'selected' : '' }}>
                                                                {{ $level->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save
                                                        changes</button>
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
        <div class="modal modal-md fade" id="add-student" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add student</h5>
                        {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form class="form" action="{{ route('student.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" required
                                placeholder="Name">

                                <label for="email">email</label>
                                <input id="email" class="form-control" type="text" name="email" required
                                    placeholder="email">


                                    <label for="name">address</label>
                            <input id="address" class="form-control" type="text" name="address" required
                                placeholder="address">



                            <label for="level_id">level</label>
                            <select id="level_id" class="form-select" type="number" name="level_id" required>
                                <option value="">-Select levell-</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>


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
