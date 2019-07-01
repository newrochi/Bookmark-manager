@extends('layouts.app')
<?php $i=0; ?>
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('incs.messages')
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal" name="button">Add Bookmark</button>

                        <hr>
                        <h3>My Bookmarks</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Url</th>
                                <th scope="col">Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookmarks as $bookmark)
                                <?php ++$i; ?>
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$bookmark->name}}</td>
                                    <td><a href="{{$bookmark->url}}" target="_blank" >{{$bookmark->url}}</a></td>
                                    <td>{{$bookmark->description}}</td>
                                    <td><button data-id="{{$bookmark->id}}" class="delete-bookmark btn btn-danger">Delete</button></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bookmark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('bookmark.posts')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Bookmark Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>

                    <div class="form-group">
                        <label for="url">Bookmark URL</label>
                        <input type="text" class="form-control" name="url" id="url">
                    </div>

                    <div class="form-group">
                        <label for="description">Website Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
