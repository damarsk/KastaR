@extends('layouts.app')
@section('title', 'KastaR - AI CHAT')
@section('styles')
    <style>
        .chat-container {
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header {
            color: white;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .chat-header h2 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .input-field {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f5f5f5;
            border-top: 1px solid #ddd;
        }

        .input-field #userInput {
            flex: 1;
            border: none;
            background: #fff;
            padding: 10px;
            border-radius: 20px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-right: 10px;
            outline: none;
            transition: box-shadow 0.3s;
        }

        .input-field #userInput:focus {
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-send {
            border: none;
            background: #0090a3;
            color: white;
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-send:hover {
            background: #064e46;
        }

        #response {
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .response-content {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #6a11cb;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .error {
            color: #dc3545;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div class="container-fluid py-1">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-12">
                    <div class="chat-container">
                        <div class="bg-primary chat-header">
                            <h2>AI Assistant</h2>
                        </div>
                        <div id="response">
                            <div class="response-content c-grey-800" id="responseContent"></div>
                        </div>
                        <div class="input-field">                            
                            <textarea id="userInput" placeholder="Type a message..." rows="1" style="max-height: 160px; resize: none;"></textarea>
                            <button class="btn-send" onclick="sendMessage()"><i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userInput').keydown(function(event) {
                if (event.key === 'Enter') {
                    if (event.shiftKey) {
                        const cursorPos = this.selectionStart;
                        const textBefore = this.value.substring(0, cursorPos);
                        const textAfter = this.value.substring(cursorPos);
                        this.value = textBefore + '\n' + textAfter;
                        this.selectionStart = cursorPos + 1;
                        this.selectionEnd = cursorPos + 1;
                        event.preventDefault();
                    } else {
                        sendMessage();
                        event.preventDefault();
                    }
                }
            });

            const $textarea = $('textarea');

            $textarea.on('input', function() {
                $(this).css('height', '');
                $(this).css('height', Math.min(this.scrollHeight, 160) + 'px');
            });

            $textarea.on('keydown', function(event) {
                if (event.shiftKey && event.key === 'Enter') {
                    setTimeout(() => {
                        $(this).css('height', '');
                        $(this).css('height', Math.min(this.scrollHeight, 160) + 'px');
                    }, 0);
                }
            });
        });

        async function sendMessage() {
            const input = $('#userInput').val();
            const responseContent = $('#responseContent');

            if (!input) {
                responseContent.html('<div class="error">Pertanyaan tidak boleh kosong</div>');
                return;
            }

            responseContent.html('<div class="loader"></div>');

            try {
                const response = await fetch('{{ route('robot.send_message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ message: input })
                });
                
                const data = await response.json();
                const markdownText = data.content || 'No response';
                responseContent.html(marked.parse(markdownText));
            } catch (error) {
                responseContent.innerHTML = `<div class="error">Error: ${error.message}</div>`;
            }
        }
    </script>
@endsection

