<!-- Chatbot Widget -->
<style>
    /* Chatbot Styles */
    .chatbot-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
    }

    .chatbot-toggle {
        width: 60px;
        height: 60px;
        background-color: #00bcd4; /* Cyan to match hotel theme */
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 188, 212, 0.4);
        transition: transform 0.3s ease;
    }

    .chatbot-toggle:hover {
        transform: scale(1.1);
    }

    .chatbot-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        display: none; /* Hidden by default */
        flex-direction: column;
        overflow: hidden;
        border: 1px solid #e0e0e0;
    }

    .chatbot-window.active {
        display: flex;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .chatbot-header {
        background-color: #1a1a2e; /* Dark theme top */
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-header h4 {
        margin: 0;
        font-size: 16px;
        color: white;
        font-weight: 500;
    }

    .close-chat {
        cursor: pointer;
        font-size: 20px;
    }

    .chat-body {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .chat-message {
        max-width: 80%;
        padding: 10px 15px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .chat-message.bot {
        background-color: #e2f1f8;
        color: #1a1a2e;
        align-self: flex-start;
        border-bottom-left-radius: 2px;
    }

    .chat-message.user {
        background-color: #00bcd4;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 2px;
    }

    .chat-input-area {
        padding: 15px;
        background-color: white;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
    }

    .chat-input-area input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
        font-size: 14px;
    }

    .chat-input-area input:focus {
        border-color: #00bcd4;
    }

    .chat-input-area button {
        background-color: #00bcd4;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.2s;
    }

    .chat-input-area button:hover {
        background-color: #009eb3;
    }

    /* Loading dots */
    .typing-indicator {
        display: none;
        align-self: flex-start;
        background-color: #e2f1f8;
        padding: 10px 15px;
        border-radius: 12px;
        border-bottom-left-radius: 2px;
    }
    .typing-indicator span {
        display: inline-block;
        width: 5px;
        height: 5px;
        background-color: #666;
        border-radius: 50%;
        margin: 0 2px;
        animation: bounce 1.4s infinite ease-in-out both;
    }
    .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
    .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }
    
    @keyframes bounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }
</style>

<div class="chatbot-widget">
    <!-- Chat Icon -->
    <div class="chatbot-toggle" id="chatbotToggle">
        <i class="fas fa-comment-dots" style="font-family: 'Font Awesome 5 Free'; font-weight: 900; font-style: normal; content: '\f4ad';"></i>
        <!-- Using inline SVG fallback just in case FontAwesome isn't loaded everywhere -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM9 11H7V9H9V11ZM13 11H11V9H13V11ZM17 11H15V9H17V11Z" fill="white"/>
        </svg>
    </div>

    <!-- Chat Window -->
    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <h4><span class="icon-robot mr-2"></span> Hotel Assistant</h4>
            <span class="close-chat" id="closeChat">&times;</span>
        </div>
        
        <div class="chat-body" id="chatBody">
            <div class="chat-message bot">
                Hello! Welcome to our StayEase hotel. How can I assist you today?
            </div>
            <!-- Messages go here -->
            <div class="typing-indicator" id="typingIndicator">
                <span></span><span></span><span></span>
            </div>
        </div>

        <div class="chat-input-area">
            <input type="text" id="chatInput" placeholder="Type your message..." autocomplete="off" onkeypress="handleKeyPress(event)">
            <button onclick="sendMessage()" id="sendBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.01 21L23 12L2.01 3L2 10L17 12L2 14L2.01 21Z" fill="white"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    // Toggle Logic
    const toggleBtn = document.getElementById('chatbotToggle');
    const closeBtn = document.getElementById('closeChat');
    const chatWindow = document.getElementById('chatbotWindow');
    const chatInput = document.getElementById('chatInput');
    const chatBody = document.getElementById('chatBody');
    const typingIndicator = document.getElementById('typingIndicator');

    toggleBtn.addEventListener('click', () => {
        chatWindow.classList.toggle('active');
        if(chatWindow.classList.contains('active')) {
            chatInput.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        chatWindow.classList.remove('active');
    });

    function handleKeyPress(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    }

    function appendMessage(sender, text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `chat-message ${sender}`;
        
        // Convert simple markdown to HTML (asterisks to bold, newlines to br)
        let formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                                .replace(/\n/g, '<br>');
        
        msgDiv.innerHTML = formattedText;
        
        // Insert before typing indicator
        chatBody.insertBefore(msgDiv, typingIndicator);
        scrollToBottom();
    }

    function scrollToBottom() {
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function sendMessage() {
        const text = chatInput.value.trim();
        if(!text) return;

        // 1. Add User Message
        appendMessage('user', text);
        chatInput.value = '';
        
        // 2. Show Typing Indicator
        typingIndicator.style.display = 'flex';
        scrollToBottom();

        // 3. Send to server
        fetch('/chatbot/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: text })
        })
        .then(response => response.json())
        .then(data => {
            typingIndicator.style.display = 'none';
            if(data.status === 'success') {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', "Sorry, I couldn't process that right now.");
            }
        })
        .catch(err => {
            typingIndicator.style.display = 'none';
            console.error(err);
            appendMessage('bot', "Network error. Please try again.");
        });
    }
</script>
