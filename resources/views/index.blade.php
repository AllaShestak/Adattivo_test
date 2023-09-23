@extends('base')

@section('content')
<section>
    <div class="container">
        <nav class="navbar navbar-dark bg-light mb-10">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/adattivo-logo.png')}}" height="24" class="rounded" alt="image logo">
            </a>
        </nav>
        @if ($error !== '')
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        @endif
        <form class="row g-3">
            @csrf
            <div class="col-12">
                <label for="workspace" class="form-label">Workspace</label>
                <select class="form-select" id="workspace">
                    <option value="" selected>Select a workspace</option>
                    @foreach ($workspaces as $workspace)
                    <option value="{{$workspace->id}}">{{$workspace->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="space" class="form-label">Space</label>
                <select class="form-select" id="space">
                    <option value="" selected>Select a space</option>
                </select>
            </div>
            <div class="col-12">
                <label for="lists" class="form-label">List</label>
                <select class="form-select" id="lists">
                    <option value="" selected>Select a list</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="assegnatari" class="form-label">Assign</label>
                <select class="form-select" multiple id="assegnatari">

                </select>
            </div>
            <div class="col-md-6">
                <label for="osservatori" class="form-label">Watchers</label>
                <select class="form-select" multiple id="osservatori">
                </select>
            </div>
            <div class="col-12">
                <label for="slack" class="form-label">Slack channel</label>
                <select class="form-select" id="slack">
                    <option value="" selected>Select a channels</option>
                    @foreach ($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="taskName" class="form-label">Create a new task</label>
                <div class="input-group mb-3">
                    <input type="text" id='taskName' class="form-control" placeholder="Title">
                </div>
                <div class="input-group">
                    <textarea placeholder="Description" id='taskDescription' class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="col-md-3">
            <button id="task" class="btn btn-primary">Add task</button>
            </div>
        </form>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
@endsection
