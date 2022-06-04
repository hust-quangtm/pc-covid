@extends('layouts.app')

@section('content')
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../../argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12 {{ $class ?? '' }}">
                    <h1 class="display-2 text-white">Xin chào {{ auth()->user()->name }}</h1>
                    <p class="text-white mt-0 mb-5">Hãy cùng chung tay đẩy lùi Covid</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <button onclick="initFirebaseMessagingRegistration()"
                        class="btn btn-danger">Allow notification
                    </button>
                </center>
                <div class="card mt-3">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('send.web-notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Message Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Message Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyD4n1dS7zBbr8Gyjibfe1jFVKIZBsgKkeQ",

            authDomain: "pc-covid-a996f.firebaseapp.com",

            projectId: "pc-covid-a996f",

            storageBucket: "pc-covid-a996f.appspot.com",

            messagingSenderId: "806316885713",

            appId: "1:806316885713:web:cdbcf235b5ee681e3227f0",

            measurementId: "G-578BHJEPRH"
        };
        firebase.initializeApp(firebaseConfig);
        const message = firebase.messaging();
        // message.onTokenRefresh(() => {
        //     message.getToken().then((currentToken) => {
        //         if (currentToken) {
        //             console.log(currentToken);
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });
        //             $.ajax({
        //                 url: '{{ route("store.token") }}',
        //                 type: 'POST',
        //                 data: {
        //                     token: currentToken
        //                 },
        //                 dataType: 'JSON',
        //                 success: function (response) {
        //                     alert('Thanks for subcribe!.');
        //                 },
        //                 error: function (err) {
        //                     console.log('User Chat Token Error'+ err);
        //                 },
        //             });
        //         }
        //     })
        // })

        function initFirebaseMessagingRegistration() {
                Notification.requestPermission()
                .then(function () {
                    return message.getToken({vapidKey: "BLkhLy4TLxhwyDsBet4e8mjvLJ0rj5USCQ_ra2NqKgdOrdlsyfWG-oOGkARKP46Es90o6OaS0qZuLd_PBbNyQg0"})
                })
                .then(function(token) {
                    console.log(token);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("store.token") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Thanks for subcribe!.');
                        },
                        error: function (err) {
                            console.log('User Chat Token Error'+ err);
                        },
                    });
                }).catch(function (err) {
                    console.log('User Chat Token Error'+ err);
                });
         }

        messaging.onMessage(function(payload) {
            console.log(payload)
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    </script> --}}
@endsection
