@extends('layouts.frontLayout')

@section('content')
    <div class="container py-5">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                Chat with Doctor
            </div>

            <div class="card-body">

                <div id="chat-box" style="height:400px; overflow-y:auto;">

                    @foreach ($messages as $message)
                        <div class="mb-2 {{ $message->sender_type == 'patient' ? 'text-end' : 'text-start' }}">

                            <span
                                class="badge 
                        {{ $message->sender_type == 'patient' ? 'bg-primary' : 'bg-secondary' }}">

                                {{ $message->message }}

                            </span>

                        </div>
                    @endforeach

                </div>

            </div>

            <div class="card-footer">

                <div class="input-group">

                    <input type="text" id="message" class="form-control" placeholder="Type message...">

                    <button id="sendBtn" class="btn btn-primary">
                        Send
                    </button>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" id="conversation_id" value="{{ $conversation->id }}">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}">

    <script>
        let conversationId = document.getElementById('conversation_id').value
        let csrf = document.getElementById('csrf').value

        document.getElementById("sendBtn").addEventListener("click", function() {

            let message = document.getElementById("message").value

            fetch("/send-message", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },

                body: JSON.stringify({

                    message: message,
                    conversation_id: conversationId

                })

            })

            document.getElementById("message").value = ""

        })
        Echo.private(`chat.${conversationId}`)

            .listen('MessageSent', (e) => {

                let chatBox = document.getElementById("chat-box")

                let div = document.createElement("div")

                div.classList.add("mb-2", "text-start")

                div.innerHTML = `<span class="badge bg-secondary">${e.message.message}</span>`

                chatBox.appendChild(div)

                chatBox.scrollTop = chatBox.scrollHeight

            })
    </script>
@endsection
