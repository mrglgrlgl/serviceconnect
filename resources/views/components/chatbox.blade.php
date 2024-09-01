<div x-data="chatComponent({{ $channelId }})" x-init="init()" class="relative" id="chatComponentRoot">
    <div class="fixed transition-all duration-300 transform bottom-10 right-12 h-60 w-80">
        <div class="mb-2">
            <button @click="open = !open" type="button" class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white rounded-lg hover:bg-indigo-400 dark:bg-indigo-600 dark:hover:bg-indigo-400">
                Chat
                <x-heroicon-o-chevron-up x-show="!open" x-cloak class="ms-auto block size-4" />
                <x-heroicon-o-chevron-down x-show="open" x-cloak class="ms-auto block size-4" />
            </button>
        </div>
        <div class="w-full h-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded overflow-auto flex flex-col px-2 py-4">
            <div x-ref="chatBox" class="flex-1 p-4 text-sm flex flex-col gap-y-1 overflow-y-auto">
                <template x-for="chat in chats" :key="chat.id">
                    <div>
                        <span class="text-indigo-600" x-text="chat.sender_name"></span>: 
                        <span class="dark:text-white" x-text="chat.message_text"></span>
                    </div>
                </template>
            </div>
            <div>
                <form @submit.prevent="sendChat" class="flex gap-2">
                    <input x-model="newMessage" x-ref="messageInput" name="message" id="message" class="block w-full" type="text" placeholder="Type your message here..." />
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const channelId = @json($channelId);

        window.Echo.private(`chat.${channelId}`)
            .listen('MessageSent', (event) => {
                console.log('Event received:', event);
                // Update the chatbox with the new message
            });
    });
</script>

  function chatComponent(channelId) {
    return {
        newMessage: '',
        chats: [],  // Store chats here
        open: true,

        init() {
            console.log("Chat component initialized.");

            // Fetch existing messages for the channel
            axios.get(`/chat/chats?channel_id=${channelId}`)
                .then(response => {
                    this.chats = response.data;
                });

            // Listen for new messages on the channel
            window.Echo.private(`chat.${channelId}`)
                .listen('MessageSent', (event) => {
                    console.log('Event received:', event);

                    this.chats.push({
                        sender_name: event.sender_name,
                        message_text: event.message_text,
                    });

                    this.$nextTick(() => {
                        this.$refs.chatBox.scrollTop = this.$refs.chatBox.scrollHeight;
                    });
                });
        },

        sendChat() {
            if (this.newMessage.trim() === '') return;

            axios.post(`/chat/send-chat`, {
                message_text: this.newMessage,
                channel_id: channelId,
            })
            .then(response => {
                this.newMessage = '';
                this.$refs.messageInput.focus();
            })
            .catch(error => {
                console.error('Error sending message:', error);
                alert('There was an error sending your message. Please try again.');
            });
        }
    }
}
</script>
