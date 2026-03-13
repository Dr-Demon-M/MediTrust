@extends('layouts.dashboardLayout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/all-chats-full.css') }}">

    <div class="full-inbox-container">
        <div class="inbox-header">
            <div class="header-info">
                <h2>Patient Consultations</h2>
                <p>Direct communication with your registered patients</p>
            </div>
            <div class="header-badges">
                <span class="badge total">Total: {{ $chats->count() }}</span>
                {{-- <span class="badge pending">Pending: 3</span> --}}
            </div>
        </div>

        <div class="inbox-wrapper">
            @foreach ($chats as $chat)
                <a href="{{ route('chat.show', $chat->id) }}" class="inbox-row {{ $chat->messages->last()->sender_type == 'patient' ? 'unread-row' : '' }}">
                    <div class="row-main">
                        <div class="patient-avatar">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($chat->patient->name) }}&background=eef2ff&color=4f46e5"
                                alt="">
                            @if ($chat['status'] == 'online')
                                <span class="dot-online"></span>
                            @endif
                        </div>

                        <div class="message-preview">
                            <div class="p-meta">
                                <span class="p-name">{{ $chat->patient->name }}</span>
                                <span class="p-id">#{{ $chat->patient->id }}</span>
                            </div>
                            <p class="p-last-msg">{{ $chat->messages->last()->message }}</p>
                        </div>
                    </div>

                    <div class="row-info">
                        <span class="p-date">{{ $chat->messages->last()->created_at->format('M j, Y g:i A') }}</span>
                        @if ($chat['unread'] > 0)
                            <span class="unread-pill">{{ $chat['unread'] }}</span>
                        @else
                            <i class="fas fa-chevron-right next-icon"></i>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
