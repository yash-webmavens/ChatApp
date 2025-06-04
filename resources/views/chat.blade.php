<x-layouts.app :title="__('Dashboard')">
    @livewire('Chat.message', ['receiverId' => $receiverId], key($receiverId))
</x-layouts.app>
