<div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-6">Upcoming Meetups & Events</h1>

        @if($meetups->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($meetups as $meetup)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        @if($meetup->image_url)
                            <img src="{{ $meetup->image_url }}" alt="{{ $meetup->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <h2 class="font-bold text-xl mb-2">{{ $meetup->title }}</h2>
                            <p class="text-gray-700 text-sm mb-1">
                                <strong>Date:</strong> {{ \Carbon\Carbon::parse($meetup->date)->format('M d, Y') }}
                                @if($meetup->time)
                                    at {{ \Carbon\Carbon::parse($meetup->time)->format('h:i A') }}
                                @endif
                            </p>
                            <p class="text-gray-700 text-sm mb-3"><strong>Location:</strong> {{ $meetup->location }}</p>
                            <p class="text-gray-600 text-base mb-4">{{ Str::limit($meetup->description, 100) }}</p>
                            @if($meetup->event_url)
                                <a href="{{ $meetup->event_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold">View Event</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $meetups->links() }}
            </div>
        @else
            <p class="text-gray-700">No meetups scheduled at the moment. Please check back later!</p>
        @endif
    </div>
</div>
