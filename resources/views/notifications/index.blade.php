@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">消息通知</div>
                    <div class="panel-body">
                        @foreach($user->notifications as $notification)
                            {{$notification->data['name']}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection