<?php

namespace App\Livewire\Chat;

use App\Events\MessageSentEvent;
use App\Models\Message as ModelsMessage;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Message extends Component
{
    public Collection $messages;
    public User $receiver;
    public int $senderId;
    public int $receiverId;
    public string $message;

    public function mount($receiverId)
    {
        $this->senderId = auth()->id();
        $this->receiverId = $receiverId;
        $this->receiver = User::find($receiverId);
        $this->messages = $this->getMessages();
    }

    public function render()
    {
        return view('livewire.chat.message');
    }

    public function getMessages()
    {
        return ModelsMessage::with(['sender:id,name', 'receiver:id,name'])
            ->where(function ($query) {
                $query->where('sender_id', $this->senderId)
                    ->where('receiver_id', $this->receiverId);
            })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->receiverId)
                    ->where('receiver_id', $this->senderId);
            })
            ->get();
    }

    public function sendMessage()
    {
        # Save Message
        $newMessage = $this->saveMessage();

        # Add New Message to Existing Messages
        $this->messages[] = $newMessage;

        # Broadcast the Message Sent Event
        broadcast(new MessageSentEvent($newMessage));

        $this->message = '';
        // $this->resetAll();
    }

    public function saveMessage()
    {
        ModelsMessage::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message
        ]);
    }
}
