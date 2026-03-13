@extends('layouts.frontLayout')

@section('content')
    <main class="main clinic-details-page">

        <div class="page-title shadow-sm mb-5">
            <div class="container text-center">
                <h1>Appointment Chat</h1>
                <p>
                    Secure chat for patients and doctors to discuss appointment details.
                    <br>
                    <span class="badge bg-danger">
                        Available only during the active appointment and closing automatically once it is completed.
                    </span>
                </p>
            </div>
        </div>

        <div class="container d-flex justify-content-center my-5">

            <div class="clinic-chat-box shadow-lg" style="width:70%; border-radius:15px; overflow:hidden;">

                <div class="chat-header d-flex align-items-center p-3 px-4 bg-primary text-white">
                    <div class="ms-1">
                        <h6 class="mb-0">Clinic Consultation</h6>
                        <small class="opacity-75">Live Chat History</small>
                    </div>
                </div>


                <div class="chat-body p-4 bg-light" id="chatWindow" style="height:500px; overflow-y:auto;">

                    @forelse($messages as $message)
                        @if ($message->sender_type == 'doctor')
                            <div class="message doctor-msg mb-4 message-animated slide-in-left">
                                <div class="msg-content p-3 shadow-sm border-0">
                                    <p class="mb-0 text-dark">{{ $message->message }}</p>
                                    <span class="msg-time text-muted">
                                        {{ $message->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="message patient-msg mb-4 text-end message-animated slide-in-right">
                                <div class="msg-content p-3 shadow-sm border-0 bg-primary text-white">
                                    <p class="mb-0">{{ $message->message }}</p>
                                    <span class="msg-time text-white-50">
                                        {{ $message->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        @endif

                    @empty

                        <div class="text-center text-muted mt-5">
                            <i class="bi bi-chat-dots fs-1 d-block mb-2 opacity-25"></i>
                            <p>No messages yet. Start the consultation.</p>
                        </div>
                    @endforelse

                </div>


                <div class="chat-footer p-3 bg-white border-top">

                    <form id="chatForm" class="d-flex gap-2 align-items-center">

                        @csrf

                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                        <input type="hidden" name="sender_id" value="{{ auth()->guard('patient')->id() }}">
                        <input type="hidden" name="sender_type" value="patient">

                        <input type="text" id="messageInput" class="form-control border-0 bg-light rounded-pill px-3"
                            placeholder="Type your message..." required>

                        <button type="submit"
                            class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                            <i class="bi bi-send-fill" style="font-size:0.9rem;"></i>
                        </button>

                    </form>

                </div>
            </div>
        </div>


        <script>
            let chatWindow = document.getElementById("chatWindow")

            // يبدأ السكروول من الأسفل
            chatWindow.scrollTop = chatWindow.scrollHeight

            let conversationId = {{ $conversation->id }}
            let lastMessageId = {{ $messages->last()->id ?? 0 }}
            let renderedMessages = new Set()

            function fetchMessages() {

                let isNearBottom =
                    chatWindow.scrollHeight - chatWindow.scrollTop - chatWindow.clientHeight < 120

                fetch("/chat/messages/" + conversationId + "?last_id=" + lastMessageId)

                    .then(res => res.json())

                    .then(data => {

                        data.forEach(msg => {

                            if (renderedMessages.has(msg.id)) return

                            renderedMessages.add(msg.id)

                            lastMessageId = msg.id

                            let time = new Date(msg.created_at)
                                .toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                })

                            if (msg.sender_type === "doctor") {

                                chatWindow.innerHTML += `
                                    <div class="message doctor-msg mb-4 message-animated slide-in-left">
                                    <div class="msg-content p-3 shadow-sm border-0">
                                    <p class="mb-0 text-dark">${msg.message}</p>
                                    <span class="msg-time text-muted">${time}</span>
                                    </div>
                                    </div>`

                            } else {

                                chatWindow.innerHTML += `
                                    <div class="message patient-msg mb-4 text-end message-animated slide-in-right">
                                    <div class="msg-content p-3 shadow-sm border-0 bg-primary text-white">
                                    <p class="mb-0">${msg.message}</p>
                                    <span class="msg-time text-white-50">${time}</span>
                                    </div>
                                    </div>`
                            }

                        })

                        if (isNearBottom) {
                            chatWindow.scrollTop = chatWindow.scrollHeight
                        }

                    })

            }



            document.getElementById("chatForm").addEventListener("submit", function(e) {

                e.preventDefault()

                let message = document.getElementById("messageInput").value
                let renderedMessages = new Set()
                fetch("{{ route('front.chat.send') }}", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },

                        body: JSON.stringify({
                            conversation_id: conversationId,
                            sender_id: "{{ auth()->guard('patient')->id() }}",
                            sender_type: "patient",
                            message: message
                        })

                    })

                    .then(() => {

                        document.getElementById("messageInput").value = ""
                        fetchMessages()

                    })

            })


            setInterval(fetchMessages, 2000)
        </script>
    @endsection
