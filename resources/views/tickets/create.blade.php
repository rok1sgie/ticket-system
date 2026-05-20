<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Naujas bilietas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <form method="POST" action="{{ route('tickets.store') }}" class="bg-white p-6 shadow sm:rounded-lg space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Pavadinimas</label>
                    <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Kategorija</label>
                    <select name="category_id" class="mt-1 w-full rounded border-gray-300" required>
                        <option value="">Pasirinkite</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Aprašymas</label>
                    <textarea name="description" rows="6" class="mt-1 w-full rounded border-gray-300" required>{{ old('description') }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button class="rounded bg-blue-600 px-4 py-2 text-white">Sukurti</button>
                    <a href="{{ route('tickets.index') }}" class="rounded bg-gray-200 px-4 py-2 text-gray-800">Atgal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
