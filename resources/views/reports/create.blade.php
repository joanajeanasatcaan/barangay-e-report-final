<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-gray-800">
            {{ __('Add Report Page') }}
        </h2>
        <div class="flex items-start justify-between">
            <p class="text-gray-500 ">
                {{ __('Submit a new incident report to Barangay Ubojan officials') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-12 px-4 py-4 text-gray-900">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-xl font-semibold leading-tight text-gray-800">Report an Incident</h2>
                        <p class="mb-4 text-sm text-gray-500">Please provide details about the incident you want to report </p>

                        <div class="mb-4 form-group">
                            <label for="title" class="block text-sm font-medium font-semibold text-gray-700">Incident Title</label>
                            <input placeholder="Brief title of the incident" type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group" x-data="{ showOther: false }">
                            <label for="category" class="block text-sm font-medium font-semibold text-gray-700">Category</label>
                            <select
                                name="category"
                                id="category"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('category') border-red-500 @enderror"
                                required
                                x-on:change="showOther = ($event.target.value === 'Other Issue')"
                            >
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select Issue</option>
                                <option value="Vandalism" {{ old('category') == 'Vandalism' ? 'selected' : '' }}>Vandalism</option>
                                <option value="Illegal Gambling" {{ old('category') == 'Illegal Gambling' ? 'selected' : '' }}>Illegal Gambling</option>
                                <option value="Littering/Garbage Issue" {{ old('category') == 'Littering/Garbage Issue' ? 'selected' : '' }}>Littering/Garbage Issue</option>
                                <option value="Noise Complaint" {{ old('category') == 'Noise Complaint' ? 'selected' : '' }}>Noise Complaint</option>
                                <option value="Neighborhood Dispute" {{ old('category') == 'Neighborhood Dispute' ? 'selected' : '' }}>Neighborhood Dispute</option>
                                <option value="Traffic Issue" {{ old('category') == 'Traffic Issue' ? 'selected' : '' }}>Traffic Issue</option>
                                <option value="Other Issue" {{ old('category') == 'Other Issue' ? 'selected' : '' }}>Other Issue</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror

                            <div x-show="showOther" class="mt-4">
                                <label for="other_issue" class="block text-sm font-medium text-red-400">Please Specify Other Issue*</label>
                                <input
                                    type="text"
                                    name="other_issue"
                                    id="other_issue"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('other_issue') border-red-500 @enderror"
                                    value="{{ old('other_issue') }}"
                                >
                                @error('other_issue')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-4 form-group">
                            <label for="location" class="block text-sm font-medium font-semibold text-gray-700">Location</label>
                            <input placeholder="Where did this happen?" type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('location') border-red-500 @enderror" value="{{ old('location') }}" required>
                            @error('location')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="description" class="block text-sm font-medium font-semibold text-gray-700">Description</label>
                            <textarea placeholder="Provide details about what happened" name="description" id="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="photos" class="block text-sm font-medium font-semibold text-gray-700">Evidence Photos (Max 3)</label>
                            <input type="file" name="photos[]" id="photos" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('photos.*') border-red-500 @enderror" multiple accept="image/*" max="3">
                            @error('photos.*')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            @if (isset($errors) && $errors->has('photos'))
                                <p class="mt-1 text-xs text-red-500">{{ $errors->first('photos') }}</p>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-900 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
