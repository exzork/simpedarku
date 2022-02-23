<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stake Holder') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.stakeholders.store') }}" method="POST">
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                <div>
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Tambah Stake Holder
                                        </h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            Mohon isikan data berikut.
                                        </p>
                                    </div>
                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                            <label for="type_id"
                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                Tipe
                                            </label>
                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <select id="type_id" name="type_id"
                                                        class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                            <label for="name"
                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                Nama Instansi
                                            </label>
                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <input type="text" name="name" id="name"
                                                       class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                                       required>
                                            </div>
                                        </div>

                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                            <label for="phone"
                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                Nomor Telepon
                                            </label>
                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <input type="tel" name="phone" id="phone"
                                                       class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                                       required>
                                            </div>
                                        </div>

                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                            <label for="address"
                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                Alamat
                                            </label>
                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                            <textarea id="address" name="address" rows="3"
                                                      class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                                                      required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <a href="{{ route('admin.stakeholders.index') }}"
                                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
