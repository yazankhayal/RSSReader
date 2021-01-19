@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach($items as $r)
                <div class="col-md-4 form-group">
                    <div class="card">
                        <img src="{{$item->get_first_image_url($r->get_content())}}"
                             style="width: 100%;height: 200px;"
                             class="card-img-top2" alt="{{$r->get_title()}}">

                        <div class="card-header">{{$r->get_title()}}</div>
                        <div class="card-body" style="overflow: hidden">
                            {!! $r->get_content(); !!}
                        </div>
                        <div class="card-footer">
                            <a href="{!! $r->get_permalink(); !!}">
                                {!! $r->get_permalink(); !!}
                            </a>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endsection
