<!DOCTYPE html>
<html>
@include('admin.includes.head')
<style>
    .chat-boxx {
        /* border: 1px solid #ddd; */
        /* border-radius: 8px; */
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
        /* align-items: center; */
        flex-direction: column;
        position: relative;
        /* padding-right: 40px; */
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
    @include('admin.includes.header')
    @include('admin.includes.sidemenu')
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

                    @foreach($project_messages as $message)

                    @endforeach

                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="box-1">

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-2">
                            <div class="chat-boxx">
                                <div class="chat-header">
                                    Messages
                                </div>

                                <div class="messages">
                                    @foreach($project_messages as $message)
                                    <!-- Check if the message sender is the logged-in user -->
                                    <div class="message {{ Auth::user()->user_id == $message->sent_by_user_id ? 'user' : 'other' }}">
                                        <div class="message-content">
                                            <div class="sender-info">
                                                <!-- Display sender's name based on user_id -->
                                                {{ $message->sent_by_user_id == Auth::user()->id ? 'You' : $message->sender_name }}
                                            </div>
                                            {{ $message->message }}
                                            <div class="time-info">{{ $message->created_at->format('H:i A') }}</div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type a message..." id="message-input">
                                        <div class="input-right-group">
                                            <button class="btn-send">
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
        function replyToMessage(sender, message) {
            const inputField = document.getElementById('message-input');
            inputField.value = `Replying to ${sender}: "${message}" `;
            inputField.focus();
        }
    </script>
    @include('admin.includes.footer')
    @include('admin.includes.js')
</body>

</html>