// Chat Widget JavaScript - TEQRIOUS
(function () {
    var body = document.body;
    var whatsapp = body.getAttribute('data-whatsapp') || '';
    var phone = body.getAttribute('data-phone') || '';
    var email = body.getAttribute('data-email') || '';

    if (!whatsapp) return;

    var chatWidgetBtn = document.getElementById('chatWidgetBtn');
    var chatWindow = document.getElementById('chatWindow');
    var chatCloseBtn = document.getElementById('chatCloseBtn');
    var chatBody = document.getElementById('chatBody');
    var chatInput = document.getElementById('chatInput');
    var chatSendBtn = document.getElementById('chatSendBtn');
    var quickOptions = document.querySelectorAll('.quick-option-btn');
    var notificationBadge = document.getElementById('chatNotificationBadge');

    if (!chatWidgetBtn || !chatWindow) return;

    chatWidgetBtn.classList.add('enabled');
    chatWindow.classList.add('enabled');

    chatWidgetBtn.addEventListener('click', function () {
        chatWindow.classList.toggle('show');
        this.classList.toggle('active');
        if (chatWindow.classList.contains('show')) {
            chatInput.focus();
            notificationBadge.style.display = 'none';
        }
    });

    chatCloseBtn.addEventListener('click', function () {
        chatWindow.classList.remove('show');
        chatWidgetBtn.classList.remove('active');
    });

    function sendMessage(message) {
        if (!message.trim()) return;
        addMessage(message, 'user');
        chatInput.value = '';
        chatSendBtn.disabled = true;
        scrollToBottom();
        showTypingIndicator();
        setTimeout(function () {
            hideTypingIndicator();
            handleBotResponse(message);
        }, 1500);
    }

    function addMessage(text, sender) {
        var messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message ' + sender;
        var avatar = document.createElement('div');
        avatar.className = 'chat-message-avatar';
        avatar.innerHTML = sender === 'bot' ? '<i class="bi bi-building"></i>' : '<i class="bi bi-person-fill"></i>';
        var bubbleContainer = document.createElement('div');
        var bubble = document.createElement('div');
        bubble.className = 'chat-message-bubble';
        bubble.textContent = text;
        bubbleContainer.appendChild(bubble);
        if (sender === 'bot') messageDiv.appendChild(avatar);
        messageDiv.appendChild(bubbleContainer);
        if (sender === 'user') messageDiv.appendChild(avatar);
        chatBody.appendChild(messageDiv);
        scrollToBottom();
    }

    function handleBotResponse(userMessage) {
        var lowerMessage = userMessage.toLowerCase();
        if (lowerMessage.indexOf('quote') !== -1 || lowerMessage.indexOf('price') !== -1 || lowerMessage.indexOf('cost') !== -1) {
            addMessage("I'd be happy to help you get a quote! Please reach out to us:", 'bot');
            addContactOptions();
        } else if (lowerMessage.indexOf('service') !== -1 || lowerMessage.indexOf('consulting') !== -1 || lowerMessage.indexOf('development') !== -1) {
            addMessage("We offer web development, mobile apps, and IT consulting. Contact us:", 'bot');
            addContactOptions();
        } else if (lowerMessage.indexOf('contact') !== -1 || lowerMessage.indexOf('support') !== -1 || lowerMessage.indexOf('help') !== -1) {
            addMessage("Here are the best ways to reach our team:", 'bot');
            addContactOptions();
        } else {
            addMessage("Thanks for reaching out! Contact us through:", 'bot');
            addContactOptions();
        }
    }

    function addContactOptions() {
        var optionsDiv = document.createElement('div');
        optionsDiv.className = 'contact-options';
        var html = '<a href="https://wa.me/' + whatsapp + '?text=Hello" target="_blank" class="contact-option-card"><div class="contact-option-icon whatsapp"><i class="bi bi-whatsapp"></i></div><div class="contact-option-text"><h6>WhatsApp</h6><p>Chat instantly</p></div></a>';
        if (phone) html += '<a href="tel:' + phone + '" class="contact-option-card"><div class="contact-option-icon phone"><i class="bi bi-telephone-fill"></i></div><div class="contact-option-text"><h6>Call Us</h6><p>' + phone + '</p></div></a>';
        if (email) html += '<a href="mailto:' + email + '" class="contact-option-card"><div class="contact-option-icon email"><i class="bi bi-envelope-fill"></i></div><div class="contact-option-text"><h6>Email</h6><p>' + email + '</p></div></a>';
        optionsDiv.innerHTML = html;
        chatBody.appendChild(optionsDiv);
        scrollToBottom();
    }

    function showTypingIndicator() {
        var indicator = document.createElement('div');
        indicator.className = 'chat-message bot';
        indicator.id = 'typingIndicator';
        indicator.innerHTML = '<div class="chat-message-avatar"><i class="bi bi-building"></i></div><div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div>';
        chatBody.appendChild(indicator);
        scrollToBottom();
    }

    function hideTypingIndicator() {
        var indicator = document.getElementById('typingIndicator');
        if (indicator && indicator.parentNode) indicator.parentNode.removeChild(indicator);
    }

    function scrollToBottom() {
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    chatSendBtn.addEventListener('click', function () { sendMessage(chatInput.value); });
    chatInput.addEventListener('keypress', function (e) { if (e.key === 'Enter') sendMessage(chatInput.value); });
    chatInput.addEventListener('input', function () { chatSendBtn.disabled = !this.value.trim(); });
    quickOptions.forEach(function (btn) { btn.addEventListener('click', function () { sendMessage(this.getAttribute('data-message')); }); });

    setTimeout(function () { if (!chatWindow.classList.contains('show')) notificationBadge.style.display = 'flex'; }, 5000);
})();