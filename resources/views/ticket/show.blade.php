<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-red-500 text-xl font-bold">{{ $ticket->title }}</h1>

        <div
            class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg relative">

            <table class="table-auto w-full text-center ">
                <thead>
                    <th>Description</th>
                    <th>Created On</th>
                    <th>Due Date</th>
                    <th>Attachment</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('d F Y') }}
                        </td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $ticket->due_date)->format('d F Y') }}</td>

                        <td>
                            @if ($ticket->attachment)
                                <a href="{{ '/storage/' . $ticket->attachment }}" target="_blank">Attachment</a>
                            @else
                                <p>No Attachment</p>
                            @endif
                        </td>
                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('ticket.edit', $ticket->id) }}">
                                <x-primary-button>Edit</x-primary-button>
                            </a>
                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <x-primary-button>Delete</x-primary-button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            @if (auth()->user()->isAdmin)
                @if ($ticket->status !== 'resolved' && $ticket->status !== 'rejected')
                    <div class="mt-4 flex gap-2">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="resolved">
                            <x-primary-button>Resolve</x-primary-button>
                        </form>
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected">
                            <x-primary-button>Reject</x-primary-button>
                        </form>
                    </div>
                @endif
            @else
                <p class="text-left ml-5">Status: <span class="text-red-500">{{ strtoupper($ticket->status) }}</span>
                </p>

            @endif
        </div>

    </div>
</x-app-layout>
