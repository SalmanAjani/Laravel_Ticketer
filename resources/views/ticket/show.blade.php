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
                            <x-primary-button>Edit</x-primary-button>
                            <x-primary-button>Delete</x-primary-button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
