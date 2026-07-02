<template>
  <div class="chatbot-widget">
    <button 
      @click="toggleChat" 
      class="chat-button"
      :class="{ 'active': isOpen }"
    >
      <i class="bi bi-chat-dots" v-if="!isOpen"></i>
      <i class="bi bi-x-lg" v-else></i>
    </button>

    <div class="chat-window" :class="{ 'open': isOpen }">
      <div class="chat-header">
        <div class="d-flex align-items-center">
          <div class="avatar me-2">
            <i class="bi bi-robot"></i>
          </div>
          <div>
            <h6 class="mb-0">Customer Support</h6>
            <small class="text-success">Online</small>
          </div>
        </div>
      </div>

      <div class="chat-messages" ref="messagesContainer">
        <div 
          v-for="(message, index) in messages" 
          :key="index" 
          class="message"
          :class="message.sender"
        >
          <div class="message-content">
            {{ message.text }}
          </div>
          <small class="message-time">{{ message.time }}</small>
        </div>
        <div v-if="isTyping" class="message bot">
          <div class="message-content typing">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>

      <div class="chat-input">
        <form @submit.prevent="sendMessage">
          <div class="input-group">
            <input 
              v-model="inputMessage" 
              type="text" 
              class="form-control" 
              placeholder="Type your message..."
              @keyup.enter="sendMessage"
            >
            <button 
              type="submit" 
              class="btn btn-primary"
              :disabled="!inputMessage.trim() || isTyping"
            >
              <i class="bi bi-send"></i>
            </button>
          </div>
        </form>
        <div class="quick-actions mt-2">
          <button 
            v-for="action in quickActions" 
            :key="action"
            @click="sendQuickAction(action)"
            class="btn btn-sm btn-outline-secondary me-1"
          >
            {{ action }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick, onMounted } from 'vue'

const isOpen = ref(false)
const inputMessage = ref('')
const messages = ref([])
const isTyping = ref(false)
const messagesContainer = ref(null)

const quickActions = ref([
  'Track my order',
  'Return policy',
  'Payment methods',
  'Contact support'
])

const botResponses = {
  'track my order': 'To track your order, please go to the Orders page in your account. You can see the status of all your orders there.',
  'return policy': 'Our return policy allows returns within 30 days of purchase. Items must be in their original condition. Please contact support for return authorization.',
  'payment methods': 'We accept credit/debit cards (Visa, MasterCard), cash on delivery, and bank transfers. All transactions are secure.',
  'contact support': 'You can reach our support team at:\n📧 Email: support@novamart.com\n📞 Phone: +1 234 567 890\n⏰ Available: Mon-Fri, 9AM-6PM',
  'shipping': 'We offer standard shipping (3-5 business days) and express shipping (1-2 business days). Free shipping on orders over $50.',
  'hello': 'Hello! 👋 How can I help you today?',
  'hi': 'Hi there! 😊 What can I assist you with?',
  'help': 'I\'m here to help! You can ask me about orders, returns, payments, shipping, or any other questions.',
  'default': 'I understand you have a question. For detailed assistance, please contact our support team at support@novamart.com or call +1 234 567 890.'
}

const toggleChat = () => {
  isOpen.value = !isOpen.value
  if (isOpen.value && messages.value.length === 0) {
    addBotMessage('Hello! 👋 Welcome to NovaMart. How can I help you today?')
  }
  if (isOpen.value) {
    scrollToBottom()
  }
}

const addBotMessage = (text) => {
  isTyping.value = true
  setTimeout(() => {
    isTyping.value = false
    messages.value.push({
      text: text,
      sender: 'bot',
      time: getCurrentTime()
    })
    scrollToBottom()
  }, 1000)
}

const addUserMessage = (text) => {
  messages.value.push({
    text: text,
    sender: 'user',
    time: getCurrentTime()
  })
  scrollToBottom()
}

const sendMessage = () => {
  const text = inputMessage.value.trim()
  if (!text) return

  addUserMessage(text)
  inputMessage.value = ''

  const response = getBotResponse(text)
  addBotMessage(response)
}

const sendQuickAction = (action) => {
  addUserMessage(action)
  const response = getBotResponse(action.toLowerCase())
  addBotMessage(response)
}

const getBotResponse = (userMessage) => {
  const lowerMessage = userMessage.toLowerCase()

  for (const [key, response] of Object.entries(botResponses)) {
    if (lowerMessage.includes(key)) {
      return response
    }
  }

  return botResponses.default
}

const getCurrentTime = () => {
  const now = new Date()
  return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

const scrollToBottom = async () => {
  await nextTick()
  if (messagesContainer.value) {
    messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight
  }
}

onMounted(() => {
  // Optional: Auto-open chat after 30 seconds
  // setTimeout(() => {
  //   if (messages.value.length === 0) {
  //     toggleChat()
  //   }
  // }, 30000)
})
</script>

<style scoped>
.chatbot-widget {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
}

.chat-button {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #007bff;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.chat-button:hover {
  background: #0056b3;
}

.chat-button.active {
  background: #0056b3;
}

.chat-window {
  position: absolute;
  bottom: 80px;
  right: 0;
  width: 350px;
  height: 500px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  opacity: 0;
  transform: translateY(20px);
  pointer-events: none;
  transition: all 0.3s ease;
}

.chat-window.open {
  opacity: 1;
  transform: translateY(0);
  pointer-events: all;
}

.chat-header {
  background: #007bff;
  color: white;
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.avatar {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
  background: #f8f9fa;
}

.message {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
}

.message.user {
  align-items: flex-end;
}

.message.bot {
  align-items: flex-start;
}

.message-content {
  max-width: 80%;
  padding: 12px 16px;
  border-radius: 18px;
  font-size: 14px;
  line-height: 1.4;
  white-space: pre-wrap;
}

.message.user .message-content {
  background: #007bff;
  color: white;
  border-bottom-right-radius: 4px;
}

.message.bot .message-content {
  background: white;
  color: #333;
  border-bottom-left-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.message-time {
  font-size: 11px;
  color: #999;
  margin-top: 4px;
}

.typing {
  display: flex;
  gap: 4px;
  padding: 12px 16px;
}

.typing span {
  width: 8px;
  height: 8px;
  background: #999;
  border-radius: 50%;
  animation: typing 1.4s infinite;
}

.typing span:nth-child(2) {
  animation-delay: 0.2s;
}

.typing span:nth-child(3) {
  animation-delay: 0.4s;
}

@keyframes typing {
  0%, 60%, 100% {
    transform: translateY(0);
  }
  30% {
    transform: translateY(-10px);
  }
}

.chat-input {
  padding: 15px;
  background: white;
  border-top: 1px solid #eee;
}

.quick-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
}

.quick-actions .btn {
  font-size: 12px;
  padding: 4px 10px;
}

@media (max-width: 768px) {
  .chat-window {
    width: 300px;
    height: 400px;
    right: -10px;
  }
  
  .chat-button {
    width: 50px;
    height: 50px;
    font-size: 20px;
  }
}
</style>
