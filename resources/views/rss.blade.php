@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">RSS</div>

                    <form class="" method="post" action="{{route('save_rss')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Link</label>
                                <input id="name" name="name"
                                       class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}"
                                       placeholder="https://news.google.com/news/rss">
                            </div>
                            @if ($errors->has('name'))
                                <span class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">
                                Save RSS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">RSS Data</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $r)
                                <tr>
                                    <th scope="row">{{$r->id}}</th>
                                    <td>{{$r->name}}</td>
                                    <td><a class="btn btn-warning" href="{{route('details',['id'=>$r->id])}}">View</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
