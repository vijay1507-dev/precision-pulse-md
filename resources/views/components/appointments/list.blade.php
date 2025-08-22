<div class="overflow-x-auto">
    <form method="GET" action="{{ route('admin.appointments') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
            class="border rounded px-3 py-2 w-1/3" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
    </form>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                 <th class="px-4 py-2">#</th>
                 <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Doctor</th>
                 <th class="px-4 py-2">Date</th>
                 <th class="px-4 py-2">Reason</th>
                 <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
           @forelse ($appointments as $appointment)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $appointment->id }}</td>
                <td class="px-4 py-2">{{ $appointment->name }}</td>
                <td class="px-4 py-2">{{ $appointment->doctor?->user?->first_name }} {{ $appointment->doctor?->user?->last_name }}</td>
                <td class="px-4 py-2">{{ $appointment->scheduled_at }}</td>
                <td class="px-4 py-2">{{ $appointment->reason }}</td>
                <td class="px-4 py-2">{{ $appointment->status }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.appointment.edit', $appointment->id) }}" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-gray-500">No appointments found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $appointments->links() }}
    </div>
</div>
