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
                <h3>Classes</h3>
            </div>
            <div class="col text-end"> <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                    data-bs-target="#add-level">Add Class</a>
            </div>
        </div>
        <table class="table table-bordered" id="example">
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>School</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td>{{ $level->school->name }}</td>
                        <td>
                            <div class="row ">
                                <div class="col text-end"> <a class="btn btn-warning" href="#" data-bs-toggle="modal"
                                        data-bs-target="#edit-level-{{ $level->id }}">Edit</a>
                                </div>

                                <div class="col text-center">
                                    <form action="{{ route('levels.delete', $level->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                </div>
                                </form>

                                <div class="modal modal-md fade" id="edit-level-{{ $level->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Class</h5>

                                            </div>
                                            <form class="form" action="{{ route('levels.edit', $level->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label for="name">Name</label>
                                                    <input id="name" class="form-control" type="text"
                                                        value="{{ old('name', $level->name) }}" name="name" required
                                                        placeholder="Name">
                                                    <label for="school_id">School</label>

                                                    <select id="school_id" class="form-select" type="number"
                                                        name="school_id" required>
                                                        @foreach ($schools as $school)
                                                            <option value={{ $school->id }}
                                                                {{ $level->school_id == $school->id ? 'selected' : '' }}>
                                                                {{ $school->name }}
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
        <div class="modal modal-md fade" id="add-level" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Class</h5>
                        {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form class="form" action="{{ route('levels.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" required
                                placeholder="Name">
                            <label for="school_id">School</label>
                            <select id="school_id" class="form-select" type="number" name="school_id" required>
                                <option value="">-Select School-</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
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
