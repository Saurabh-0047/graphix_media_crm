<!DOCTYPE html>
<html>
@include('user.includes.head')
<style>
    /* Your existing CSS */
    .chat-boxx {
        height: 580px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-header {
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .messages {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .message .sender-info,
    .message .time-info {
        font-size: 12px;
        margin-bottom: -3px;
    }

    .message .sender-info {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .message .message-content {
        word-wrap: break-word;
        position: relative;
        padding: 5px;
    }

    .message .time-info {
        font-size: 8px;
        text-align: right;
        margin-top: 10px;
        position: absolute;
        right: 10px;
        bottom: 0px;
        padding: 2px;
    }

    .message.user {
        align-items: flex-end;
    }

    .message .message-content {
        max-width: 75%;
        padding: 10px;
        border-radius: 20px;
        position: relative;
    }

    .message.user .message-content {
        background-color: #f1f1f1;
        color: #555;
    }

    .message.other .message-content {
        background-color: #f1f1f1;
    }

    .message .sender-info {
        font-size: 12px;
        color: #555;
        margin-bottom: 0px;
    }

    .message .reply-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        display: none;
    }

    .message:hover .reply-icon {
        display: block;
    }

    .input-group {
        padding: 10px;
        border-top: 1px solid #ddd;
        display: flex;
        align-items: center;
    }

    .input-group input {
        flex: 1;
        border-radius: 20px;
        padding: 10px;
        border: 1px solid #ddd;
    }

    .input-group .btn-send {
        background-color: #007bff;
        color: white;
        margin-left: 10px;
        border: none;
        border-radius: 50%;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .replying-to {
        padding: 10px;
        background-color: #f1f1f1;
        border-left: 4px solid #007bff;
        margin-bottom: 10px;
    }

    .input-group input[type="file"] {
        display: none;
    }

    .input-right-group {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .input-right-group .btn-send {
        margin-left: 10px;
    }

    .box-1 {
        border-radius: 5px;
        height: 500px;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .box-2 {
        border-radius: 5px;
        height: 580px;
        margin-top: -80px;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
</style>

<body>
    @include('user.includes.header')
    @include('user.includes.sidemenu')
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="box" style="background: azure;">
                            <div class="box-header with-border">
                                <h4 class="box-title">Details Of Project Of <strong> {{$project_details->business_name}}</strong></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="box-1">
                            
                        <table class="table table-bordered">
                                <tr>
                                    <th>Business Name</th>
                                    <td>{{ $project_details->business_name }}</td>
                                </tr>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{{ $project_details->client_name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Number</th>
                                    <td>{{ $project_details->contact_no }}</td>
                                </tr>
                                <tr>
                                    <th>Email ID</th>
                                    <td>{{ $project_details->email_id }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $project_details->address }}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>{{ $project_details->website }}</td>
                                </tr>
                                <tr>
                                    <th>Packages</th>
                                    <td>{{ $project_details->packages }}</td>
                                </tr>
                                <tr>
    <th>Sold By</th>
    <td>{{ $project_details->user->user_name ?? 'N/A' }}</td>
</tr>
<tr>
    <th>Assigned To</th>
    <td>
        @foreach ($project_details->assigned_user_list as $user)
            <span>{{ $user->user_name }}</span>
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </td>
</tr>
                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $project_details->remarks }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $project_details->created_at }}</td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-2">
                            <div class="chat-boxx">
                                <div class="chat-header">
                                    Messages
                                </div>

                                <div class="messages" id="messages-container">
                                    @foreach($project_messages as $message)
                                    <div class="message {{ Auth::user()->user_id == $message->sent_by_user_id ? 'user' : 'other' }}">
                                        <div class="message-content">
                                            <div class="sender-info">
                                                <!-- Safely display sender's name -->
                                                {{ $message->sent_by_user_id == Auth::user()->user_id ? 'You' : $message->sender_name }}
                                            </div>
                                            {{ $message->message }}
                                            <div class="time-info">{{ $message->created_at->format('H:i A') }}</div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type a message..." id="message-input">
                                    <div class="input-right-group">
                                        <button class="btn-send" onclick="submit_message()">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        function scrollToBottom() {
            const messagesContainer = document.getElementById('messages-container');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }


        function submit_message() {
            var new_message = $('#message-input').val();

            if (new_message.trim() === '') {
                alert('Please enter a message.');
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('add_message_user') }}",
                type: 'POST',
                data: {
                    new_message: new_message,
                    user_id: '{{ Auth::user()->user_id }}',
                    project_id: '{{ $project_details->id }}'
                },
                success: function(result) {
                    if (result.success) {
                        $('#message-input').val('');
                        $('.messages').append('<div class="message user"><div class="message-content">' +
                            '<div class="sender-info">You</div>' +
                            new_message +
                            '<div class="time-info">' + new Date().toLocaleTimeString() + '</div>' +
                            '</div></div>');
                        scrollToBottom();
                    } else {
                        $('#message-input').val('');
                        $('.messages').append('<div class="message user"><div class="message-content">' +
                            '<div class="sender-info">You</div>' +
                            new_message +
                            '<div class="time-info">' + new Date().toLocaleTimeString() + '</div>' +
                            '</div></div>');
                        scrollToBottom();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    alert('Failed to send message. Please check the console for more details.');
                }

            });
        }


        // Call scrollToBottom function when the page loads
        window.onload = scrollToBottom;


        function fetchNewMessages() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch_messages_user') }}", // Adjust this route to your fetchMessages route
                type: 'GET',
                data: {
                    project_id: '{{ $project_details->id }}'
                },
                success: function(messages) {
                    // Clear the existing messages
                    $('#messages-container').html('');

                    // Append all messages
                    messages.forEach(function(message) {
                        var messageElement = '<div class="message ' +
                            (message.sent_by_user_id == '{{ Auth::user()->user_id }}' ? 'user' : 'other') + '"><div class="message-content">' +
                            '<div class="sender-info">' +
                            (message.sent_by_user_id == '{{ Auth::user()->user_id }}' ? 'You' : message.sender_name) + '</div>' +
                            message.message +
                            '<div class="time-info">' + new Date(message.created_at).toLocaleTimeString() + '</div>' +
                            '</div></div>';

                        $('#messages-container').append(messageElement);
                    });


                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    
                }
            });
        }

        setInterval(fetchNewMessages, 2000);
    </script>
    @include('user.includes.footer')
    @include('user.includes.js')
</body>

</html>