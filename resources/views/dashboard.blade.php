<x-layouts.app :title="__('Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading class="font-mono !font-bold !text-2xl mb-2" level="1">{{ __('User List') }}</flux:heading>
        <flux:separator variant="subtle" />
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left w-12">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-32">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->email }}
                        </td>
                        <td class="relative border border-gray-300 px-4 py-2">
                            <a href="{{ route('chat.show', ['receiverId' => $user->id]) }}" wire:navigate >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </a>
                            <span class="{{$user->unread_messages_count > 0 ? 'absolute right-11 top-2 rounded-full px-2 py-1 bg-red-500 text-white font-bold text-sm' : ''}}">{{ $user->unread_messages_count > 0 ? $user->unread_messages_count : '' }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
