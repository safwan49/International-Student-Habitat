package com.ish.services;
import com.ish.models.Message;
import com.ish.repositories.MessageRepository;
import java.time.LocalDateTime;
import java.util.List;
// fetches chat thread from MessageController

public class ChatService {
    private final MessageRepository messageRepository;
    public ChatService(MessageRepository messageRepository) { this.messageRepository = messageRepository;}
    /*Sends a message*/
    public Message sendMessage(long senderId, long receiverId, String body) {
        if (body == null || body.isBlank()) throw new IllegalArgumentException("Message body cannot be empty.");
        if (senderId == receiverId) throw new IllegalArgumentException("A user cannot message themselves.");
        Message message = new Message();
        message.setSenderId(senderId);
        message.setReceiverId(receiverId);
        message.setBody(body.trim());
        message.setCreatedAt(LocalDateTime.now());
        return messageRepository.save(message);
    }
    /*Marks all messages as read if receiver opens chat*/
    public void markThreadAsRead(long viewerId, long partnerId) {
        List<Message> unread = messageRepository.findBySenderIdAndReceiverIdAndReadAtIsNull(partnerId,viewerId);
        LocalDateTime now = LocalDateTime.now();
        for (Message msg : unread) msg.setReadAt(now);
        messageRepository.saveAll(unread);
    }
    /*Fetches full message thread of two users*/
    public List<Message> getThread(long userA, long userB) {return messageRepository.findThread(userA, userB);}
    /* shows count of unread messages*/
    public int countUnread(long userId) { return messageRepository.countByReceiverIdAndReadAtIsNull(userId);}
}
