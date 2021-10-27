@extends('dashboard.layouts.default')

@section('content')

    <h5>My Chats</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2 mb-2 p-2 shadow-sm">
                <div style="display: flex; align-items: start; padding-bottom: 0.5rem;">
                    <img src="" alt="Avatar" class="right" style="padding-right: 0.8rem;">
                    <strong class="pl-4">Akwii Saraphina</strong>
                 </div>
                <p>Hello. How are you today?</p>
                <span class="time-right">11:00</span>
            </div>

            <div class="card darker mt-2 mb-2 p-2 shadow-sm">
                <div style="display: flex; align-items: start; padding-bottom: 0.5rem;">
                    <img src="" alt="Avatar" class="right" style="padding-right: 0.8rem;">
                    <strong class="pl-4">Akwii Saraphina</strong>
                 </div>
                <p>Hey! I'm fine. Thanks for asking!</p>
                <span class="time-left">11:01</span>
            </div>

            <div class="card mt-2 mb-2 p-2 shadow-sm">
                <div style="display: flex; align-items: start; padding-bottom: 0.5rem;">
                    <img src="" alt="Avatar" class="right" style="padding-right: 0.8rem;">
                    <strong class="pl-4">Akwii Saraphina</strong>
                 </div>
                <p>Sweet! So, what do you wanna do today?</p>
                <span class="time-right">11:02</span>
            </div>

            <div class="card darker mt-2 mb-2 p-2 shadow-sm">
                 <div style="display: flex; align-items: start; padding-bottom: 0.5rem;">
                    <img src="" alt="Avatar" class="right" style="padding-right: 0.8rem;">
                    <strong class="pl-4">Akwii Saraphina</strong>
                 </div>
                <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                <span class="time-left">11:05</span>
            </div>
        </div>
    </div>

@endsection
