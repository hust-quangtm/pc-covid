@extends('layouts.app', ['title' => __('Tư Vấn Trực Tuyến')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Xin chào') . ' '. auth()->user()->name,
        'description' => __('Hãy cùng chung tay đẩy lùi Covid'),
        'class' => 'col-lg-12'
    ])

    {{--<div class="app">--}}
        {{--<header>--}}
            {{--<h1>Let's Talk!</h1>--}}
            {{--<input type="text" name="username" id="username" placeholder="Please enter a username...">--}}
        {{--</header>--}}

        {{--<div id="messages">--}}

        {{--</div>--}}

        {{--<form id="message_form">--}}
            {{--<input type="text" name="message" id="message_input" placeholder="Write a message...">--}}
            {{--<button type="submit" id="message_send">Send Message</button>--}}
        {{--</form>--}}
    {{--</div>--}}
    <div id="app" class="container">
        <div class="messaging">
            <div class="inbox_msg">
                <!-- <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Search">
                                <span class="input-group-addon">
                                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                        alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="mesgs col-12">
                    <div class="msg_history messages mb-4">
                        @foreach($chats as $key => $chat)
                            {{--@if($chat->sender_id === Auth::user()->id)--}}
                            {{--<div class="outgoing_msg" id="outgoing_msg">--}}
                                {{--<div class="sent_msg">--}}
                                    {{--<p>{{$chat->message}}</p>--}}
                                    {{--<span class="time_date">{{$chat->created_at}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@else--}}
                            <div class="incoming_msg mt-3" id="incoming_msg">
                                <div class="old-msg">
                                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png"
                                                                        alt="sunil"> </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <b>{{$chat->sender_name}}</b>
                                            <p>{{$chat->message}}</p>
                                            {{--<span class="time_date">{{$chat->created_at}}</span>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--@endif--}}
                        @endforeach
                            <div id="new_msg">

                            </div>
                    </div>
                    <div class="type_msg mb-3">
                        <div class="input_msg_write">
                            <form id="message_form">
{{--                                @if (auth()->user()->hasRole('admin'))--}}
                                    <input type="hidden" id="username" name="username" value="{{ auth()->user()->id }}">
                                {{--@endif--}}
                                <input type="text" class="write_msg" id="message_input" placeholder="Type a message" name="message" @keyup.enter="sendMessage"/>
                                <button class="msg_send_btn" id="message_send" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
