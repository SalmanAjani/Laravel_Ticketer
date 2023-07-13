<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-between w-full sm:max-w-xl">
            <h1 class="text-red-500 text-lg font-bold">Support Tickets</h1>
            <a href="{{ route('ticket.create') }}" class="bg-gray-800 text-white rounded-lg px-4 py-2">Create New</a>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @if (count($tickets) === 0)
                <p>You don't have any tickets yet.</p>
            @else
                <table class="table-auto w-full text-center">
                    <thead>
                        <th>Title</th>
                        <th>Created On</th>
                        <th>Due Date</th>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="border-2 border-black">
                                <td class="p-2">
                                    <a href="{{ route('ticket.show', $ticket->id) }}">
                                        {{ $ticket->title }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('d F Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $ticket->due_date)->format('d F Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
