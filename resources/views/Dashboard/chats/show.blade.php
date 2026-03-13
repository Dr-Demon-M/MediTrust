@extends('layouts.dashboardLayout')

@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="clinic-chat-box shadow-lg" style="width: 80%; border-radius: 15px; overflow: hidden;">

            <div class="chat-header d-flex align-items-center p-3 px-4 bg-primary text-white">
                <div class="ms-1">
                    <h6 class="mb-0">Clinic Consultation</h6>
                    <small class="opacity-75">Live Chat History</small>
                </div>
            </div>

            <div class="chat-body p-4 bg-light" id="chatWindow" style="height: 500px; overflow-y: auto;">

                @forelse($messages as $message)
                    @if ($message->sender_type == 'doctor')
                        <div class="message doctor-msg mb-4">
                            <div class="msg-content p-3 bg-white shadow-sm rounded-4 d-inline-block" style="max-width:80%">
                                <p class="mb-0">{{ $message->message }}</p>
                                <span class="d-block mt-1 text-muted" style="font-size:0.7rem">
                                    {{ $message->created_at->format('h:i A') }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="message patient-msg mb-4 text-end">
                            <div class="msg-content p-3 bg-primary text-white shadow-sm rounded-4 d-inline-block"
                                style="max-width:80%">
                                <p class="mb-0">{{ $message->message }}</p>
                                <span class="d-block mt-1 text-white-50" style="font-size:0.7rem">
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
                    <input type="hidden" name="sender_id" value="{{ auth()->guard('web')->user()->doctor->id }}">
                    <input type="hidden" name="sender_type" value="doctor">

                    <input type="text" id="messageInput" class="form-control border-0 bg-light rounded-pill px-3"
                        placeholder="Type your message..." required>

                    <button type="submit"
                        class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:40px;height:45px;">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>


    <script>
        let chatWindow = document.getElementById("chatWindow")

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
                                <div class="message doctor-msg mb-4">
                                <div class="msg-content p-3 bg-white shadow-sm rounded-4 d-inline-block" style="max-width:80%">
                                <p class="mb-0">${msg.message}</p>
                                <span class="d-block mt-1 text-muted" style="font-size:0.7rem">${time}</span>
                                </div>
                                </div>`

                        } else {

                            chatWindow.innerHTML += `
                                <div class="message patient-msg mb-4 text-end">
                                <div class="msg-content p-3 bg-primary text-white shadow-sm rounded-4 d-inline-block" style="max-width:80%">
                                <p class="mb-0">${msg.message}</p>
                                <span class="d-block mt-1 text-white-50" style="font-size:0.7rem">${time}</span>
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
            fetch("{{ route('chat.send') }}", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: JSON.stringify({
                        conversation_id: conversationId,
                        sender_id: "{{ auth()->guard('web')->user()->doctor->id }}",
                        sender_type: "doctor",
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
