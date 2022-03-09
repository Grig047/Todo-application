@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success mt-2 col-md-12" id="message">
            <h2><i class="fas fa-check"> {{ session()->get('message') }}</i></h2>
        </div>
    @endif
    <div class="row">
        <div class="col-6 col-md-4">
            <h2>Users List</h2>
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">{{$user->name}}</li>
                @endforeach
            </ul>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#reg-modal">Add new task
            </button>
        </div>
        <div class="col-6 col-md-4">
            <h2>Task to client</h2>
            <ul class="list-group">
                @foreach($tasks as $task)
                    <li class="list-group-item">{{$task->name}} : {{$task->status}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-6 col-md-4">
            <h2>My tasks</h2>
            <ul class="list-group">
                @foreach($myTasks as $myTask)
                    <li class="list-group-item">{{$myTask->name}}
                        <button id="show_task{{$myTask->id}}" class="btn btn-primary m-lg-1" data-bs-toggle="modal"
                                data-bs-target="#show-modal{{$myTask->id}}">Show
                        </button>
                        <form action="{{route('task.update', $myTask->id)}}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="modal fade" id="show-modal{{$myTask->id}}" tabindex="-1"
                                 aria-labelledby="modal-title" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">{{$myTask->name}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{$myTask->description}}
                                        </div>
                                        <div class="modal-footer">
                                            <div>
                                                <input type="radio" id="confirmTaskBtn"
                                                       name="status" value="in_process">
                                                <label for="confirmTaskBtn">Confirm</label>

                                                <input type="radio" id="cancelTaskBtn"
                                                       name="status" value="canceled" required>
                                                <label for="cancelTaskBtn">Cancel</label>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Task</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('task.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <label for="description" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                            <label for="user_select" class="col-form-label">User:</label>
                            <select class="form-control custom-select" name="user_id" id="user_select">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger modal_close" data-bs-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
