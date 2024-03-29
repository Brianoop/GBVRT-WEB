@extends('dashboard.layouts.default')

@section('content')


<div class="content-navigation-section">
    <h5>Chat Detail</h5>
    <a href="#" class="text text-primary">Back</a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="container">
            <img src="" alt="Avatar">
            <p>Hello. How are you today?</p>
            <span class="time-right">11:00</span>
        </div>

        <div class="container darker">
            <img src="" alt="Avatar" class="right">
            <p>Hey! I'm fine. Thanks for asking!</p>
            <span class="time-left">11:01</span>
        </div>

        <div class="container">
            <img src="" alt="Avatar">
            
            <p>Sweet! So, what do you wanna do today?</p>
            <span class="time-right">11:02</span>
        </div>

        <div class="container darker">
            <img src="" alt="Avatar" class="right">
            <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
            <span class="time-left">11:05</span>
        </div>
    </div>
</div>

@endsection