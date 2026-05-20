<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Redaguoti kategoriją</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <form method="POST" action="{{ route('categories.update', $category) }}" class="bg-white p-6 shadow sm:rounded-lg space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium">Pavadinimas</label>
                    <input name="name" value="{{ old('name', $category->name) }}" class="mt-1 w-full rounded border-gray-300" required>
                </div>
                <button class="rounded bg-blue-600 px-4 py-2 text-white">Išsaugoti</button>
            </form>
        </div>
    </div>
</x-app-layout>
