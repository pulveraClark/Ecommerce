<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-semibold mb-6">Contact Support</h1>

    <!-- Success Notification -->
    @if ($success_message)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 p-4 bg-green-500 text-white rounded shadow-lg transition duration-500"
        >
            {{ $success_message }}
        </div>
    @endif

    <form wire:submit.prevent="sendMessage" class="space-y-4">

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model.defer="name"
                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                placeholder="Your Name">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model.defer="email"
                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                placeholder="you@example.com">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Message -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Message</label>
            <textarea wire:model.defer="message"
                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                placeholder="Your message here..." rows="5"></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Send Message</span>
                <span wire:loading>Sending Message...</span>
            </button>
        </div>

    </form>
</div>
