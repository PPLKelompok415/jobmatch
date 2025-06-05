<div class="container-fluid px-0" style="max-width: 800px;">
    <!-- Chat Header -->
    <div class="bg-gradient-primary text-white rounded-3 d-flex align-items-center p-4 mb-3 shadow-sm position-sticky top-0" style="z-index: 100;">
        <a href="{{ url()->previous() }}" class="text-white me-3 fs-4 text-decoration-none hover-scale" title="Go back">
            <i class="bi bi-arrow-left"></i>
        </a>
        
        <div class="d-flex align-items-center flex-grow-1">
            <div class="me-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                     style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                    <i class="bi bi-building fs-5"></i>
                </div>
            </div>
            
            <div class="flex-grow-1">
                <div class="fw-bold fs-5 mb-0">GOJEK</div>
                <small class="opacity-75">HR Department</small>
            </div>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-link text-white p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical fs-5"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>View Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-flag me-2"></i>Report</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i>End Chat</a></li>
            </ul>
        </div>
    </div>

    <!-- Chat Timestamp -->
    <div class="text-center text-muted small mb-4 px-3">
        <div class="d-inline-block px-3 py-1 rounded-pill" style="background: rgba(59, 130, 246, 0.1);">
            <i class="bi bi-clock me-1"></i>
            Thursday, 3 Jan 17:02
        </div>
    </div>

    <!-- Chat Messages Container -->
    <div class="px-3">
        <div id="chatBox" class="mb-4" style="min-height: 400px; max-height: 60vh; overflow-y: auto;">
            <!-- Welcome Message -->
            <div class="d-flex justify-content-center mb-4">
                <div class="text-center p-3 rounded-3" style="background: rgba(59, 130, 246, 0.05); border: 1px solid rgba(59, 130, 246, 0.1); max-width: 300px;">
                    <div class="mb-2">
                        <i class="bi bi-chat-heart text-primary-custom fs-3"></i>
                    </div>
                    <small class="text-muted">
                        <strong>Welcome to JobMatch Chat!</strong><br>
                        You're now connected with GOJEK's HR team.
                    </small>
                </div>
            </div>

            <!-- Default HR Message -->
            <div class="d-flex justify-content-start mb-3">
                <div class="message-bubble message-hr">
                    <div class="message-header">
                        <div class="d-flex align-items-center">
                            <div class="avatar-small me-2">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <small class="fw-semibold">Raisa Leonore - HR</small>
                        </div>
                        <small class="text-muted ms-auto">17:02</small>
                    </div>
                    <div class="message-content">
                        Good Afternoon! Previously, let me introduce myself, my name is Raisa Leonore, I am glad you can match with our company. We're excited to discuss this opportunity with you. How can I assist you today?
                    </div>
                    <div class="message-status">
                        <i class="bi bi-check2-all text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Input -->
    <div class="sticky-bottom bg-white border-top p-3" style="box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);">
        <form id="chatForm" action="" wire:submit.prevent="sendMessage" class="d-flex align-items-end gap-3">
            <!-- Attachment Button -->
            <button type="button" class="btn btn-link text-muted p-2 rounded-circle hover-bg" title="Attach file">
                <i class="bi bi-paperclip fs-5"></i>
            </button>

            <!-- Message Input Container -->
            <div class="flex-grow-1 position-relative">
                <textarea 
                    id="chatInput" 
                    class="form-control border-2 rounded-3 resize-none" 
                    placeholder="Type your message..."
                    rows="1"
                    style="max-height: 120px; border-color: rgba(59, 130, 246, 0.3); transition: all 0.3s ease;"
                    wire:model="messageContent"
                ></textarea>
                
                <!-- Emoji Button -->
                <button type="button" class="btn btn-link text-muted position-absolute end-0 top-50 translate-middle-y me-2" title="Add emoji">
                    <i class="bi bi-emoji-smile"></i>
                </button>
            </div>

            <!-- Send/Voice Button -->
            <div class="d-flex flex-column gap-2">
                <button type="submit" id="sendBtn" class="btn btn-navbar-solid rounded-circle p-2" title="Send message" style="width: 45px; height: 45px;">
                    <i class="bi bi-send-fill"></i>
                </button>
                <button type="button" id="voiceBtn" class="btn btn-navbar-outline rounded-circle p-2" title="Voice message" style="width: 45px; height: 45px;">
                    <i class="bi bi-mic-fill"></i>
                </button>
            </div>
        </form>

        <!-- Typing Indicator -->
        <div id="typingIndicator" class="text-muted small mt-2 px-3" style="display: none;">
            <div class="d-flex align-items-center">
                <div class="typing-dots me-2">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span>Raisa is typing...</span>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Chat-specific styles */
    .hover-scale:hover {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }

    .hover-bg:hover {
        background: rgba(59, 130, 246, 0.1) !important;
    }

    /* Message Bubbles */
    .message-bubble {
        max-width: 75%;
        margin-bottom: 1rem;
        animation: messageSlideIn 0.3s ease-out;
    }

    .message-hr {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border-radius: 18px 18px 18px 5px;
        padding: 1rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .message-user {
        background: linear-gradient(135deg, #e5e7eb 0%, #f3f4f6 100%);
        color: #374151;
        border-radius: 18px 18px 5px 18px;
        padding: 1rem;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .message-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.8rem;
    }

    .avatar-small {
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }

    .message-content {
        line-height: 1.5;
        margin-bottom: 0.5rem;
    }

    .message-status {
        text-align: right;
        font-size: 0.8rem;
    }

    /* Chat Input Enhancements */
    #chatInput:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
    }

    .resize-none {
        resize: none;
    }

    /* Typing Indicator */
    .typing-dots {
        display: inline-flex;
        gap: 2px;
    }

    .typing-dots span {
        width: 6px;
        height: 6px;
        background: var(--primary-color);
        border-radius: 50%;
        animation: typingDots 1.4s infinite ease-in-out;
    }

    .typing-dots span:nth-child(1) { animation-delay: -0.32s; }
    .typing-dots span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typingDots {
        0%, 80%, 100% {
            transform: scale(0.8);
            opacity: 0.5;
        }
        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Scrollbar for chat */
    #chatBox {
        scroll-behavior: smooth;
    }

    #chatBox::-webkit-scrollbar {
        width: 4px;
    }

    #chatBox::-webkit-scrollbar-track {
        background: transparent;
    }

    #chatBox::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.3);
        border-radius: 2px;
    }

    /* Auto-resize textarea */
    .auto-resize {
        transition: height 0.2s ease;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .message-bubble {
            max-width: 85%;
        }
        
        .container-fluid {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }
</style>
@endpush