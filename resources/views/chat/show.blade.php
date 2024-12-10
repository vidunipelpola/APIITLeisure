<x-app-layout :title="$sport . ' Chat - APIIT Leisure'">
    <div class="container mx-auto p-4" x-data="chatRoom()">
        <div class="max-w-4xl mx-auto" style="border-radius: 10px;background-color:#1E1E1E; padding-left:20px; padding-right:20px;">
            <!-- Chat Room Header -->
            <div class="mb-2 p-4 rounded-lg">
                <h1 class="text-2xl font-semibold" style="color:#F8F8F8; text-align:center">{{ $sport }} Chat</h1>
            </div>

            <!-- Messages Container -->
            <div class="mb-4 p-4 rounded-lg h-[500px] overflow-y-auto" 
                 style="background-color:#000000;"
                 x-ref="messagesContainer">
                @foreach($messages->reverse() as $message)
                    <div class="mb-3 @if($message->user_id === Auth::id()) ml-auto @endif max-w-[80%]"
                         id="message-{{ $message->id }}">
                        <div class="mb-0.5 @if($message->user_id === Auth::id()) text-right @endif">
                            <span class="text-sm font-semibold text-gray-400">{{ $message->user->name }}</span>
                        </div>
                        <div class="rounded-lg py-2 px-3 @if($message->user_id === Auth::id()) ml-auto @else bg-gray-700 @endif" 
                             @if($message->user_id === Auth::id()) style="background-color: #8B0000;" @endif>
                            @if($message->replyTo)
                                <div class="mb-1.5 p-1.5 rounded bg-gray-800 text-sm">
                                    <div class="font-semibold text-gray-300">{{ $message->replyTo->user->name }}</div>
                                    <div class="text-gray-400">{{ Str::limit($message->replyTo->content, 50) }}</div>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-end mb-0.5">
                                <div class="flex gap-2">
                                    <button @click="replyTo($event, {{ $message->id }}, '{{ $message->user->name }}')" 
                                            class="text-gray-400 hover:text-white">
                                        <i class="fas fa-reply text-sm"></i>
                                    </button>
                                    @if($message->user_id === Auth::id())
                                        <button @click="deleteMessage($event, {{ $message->id }})"
                                                class="text-gray-400 hover:text-white">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <p class="text-gray-200 mb-0.5">{{ $message->content }}</p>
                            <div class="flex justify-end">
                                <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="p-4 " style="background-color:#1E1E1E; border-top: 1px solid #FFFFFF;">
                <!-- Reply Preview -->
                <div x-show="replyingTo.id" class="mb-2 p-2 rounded">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-sm text-gray-400">Replying to </span>
                            <span class="text-sm font-semibold text-gray-300" x-text="replyingTo.name"></span>
                        </div>
                        <button @click="cancelReply" class="text-xs text-gray-400 hover:text-white">
                            Cancel
                        </button>
                    </div>
                </div>

                <form @submit.prevent="sendMessage" class="flex gap-2">
                    <input type="text" 
                           x-model="messageContent" 
                           x-ref="messageInput"
                           class="flex-1 rounded px-4 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                           placeholder="Type your message..."
                           required>
                    <button type="submit" 
                            class="px-6 py-2 rounded text-white font-semibold"
                            style="background-color: #8B0000;"
                            onmouseover="this.style.opacity='0.8'" 
                            onmouseout="this.style.opacity='1'">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function chatRoom() {
            return {
                messageContent: '',
                replyingTo: {
                    id: null,
                    name: ''
                },

                async sendMessage() {
                    if (!this.messageContent.trim()) return;

                    try {
                        const response = await fetch('{{ route('chat.message', $sport) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                content: this.messageContent,
                                reply_to_id: this.replyingTo.id
                            })
                        });

                        if (!response.ok) throw new Error('Failed to send message');

                        const message = await response.json();
                        
                        // Add message to the UI
                        const messagesContainer = this.$refs.messagesContainer;
                        const messageElement = document.createElement('div');
                        messageElement.className = 'mb-3 ml-auto max-w-[80%]';
                        messageElement.id = `message-${message.id}`;
                        
                        let replyHtml = '';
                        if (message.reply_to) {
                            replyHtml = `
                                <div class="mb-1.5 p-1.5 rounded bg-gray-800 text-sm">
                                    <div class="font-semibold text-gray-300">${message.reply_to.user.name}</div>
                                    <div class="text-gray-400">${message.reply_to.content.substring(0, 50)}${message.reply_to.content.length > 50 ? '...' : ''}</div>
                                </div>
                            `;
                        }

                        messageElement.innerHTML = `
                            <div class="mb-0.5 text-right">
                                <span class="text-sm font-semibold text-gray-400">${message.user.name}</span>
                            </div>
                            <div class="rounded-lg py-2 px-3 ml-auto" style="background-color: #8B0000;">
                                ${replyHtml}
                                <div class="flex items-center justify-end mb-0.5">
                                    <div class="flex gap-2">
                                        <button onclick="document.querySelector('[x-data]').__x.$data.replyTo(event, ${message.id}, '${message.user.name}')" 
                                                class="text-gray-400 hover:text-white">
                                            <i class="fas fa-reply text-sm"></i>
                                        </button>
                                        <button onclick="document.querySelector('[x-data]').__x.$data.deleteMessage(event, ${message.id})" 
                                                class="text-gray-400 hover:text-white">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-gray-200 mb-0.5">${message.content}</p>
                                <div class="flex justify-end">
                                    <span class="text-xs text-gray-400">just now</span>
                                </div>
                            </div>
                        `;
                        messagesContainer.appendChild(messageElement);
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;

                        this.messageContent = '';
                        this.replyingTo = { id: null, name: '' };
                    } catch (error) {
                        console.error('Error sending message:', error);
                        alert('Failed to send message. Please try again.');
                    }
                },

                replyTo(event, messageId, userName) {
                    event.preventDefault();
                    this.replyingTo = {
                        id: messageId,
                        name: userName
                    };
                    // Remove auto-focus to prevent scrolling
                },

                cancelReply() {
                    this.replyingTo = {
                        id: null,
                        name: ''
                    };
                },

                async deleteMessage(event, messageId) {
                    event.preventDefault();
                    if (!confirm('Are you sure you want to delete this message?')) return;

                    try {
                        const response = await fetch(`/chat/message/${messageId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (!response.ok) throw new Error('Failed to delete message');
                        
                        const messageElement = document.getElementById(`message-${messageId}`);
                        if (messageElement) {
                            messageElement.remove();
                        }
                    } catch (error) {
                        console.error('Error deleting message:', error);
                        alert('Failed to delete message. Please try again.');
                    }
                }
            }
        }
    </script>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
</x-app-layout>
