<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan : ').$report->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ __('Detail Laporan') }}
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{ __('Berikut detail laporan') }}
                            </p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                            <dl class="sm:divide-y sm:divide-gray-200">
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Tipe Laporan') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $report->type->name }}
                                    </dd>
                                </div>

                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Laporan') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $report->title }}
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Lokasi') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $report->location }}
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Deskripsi') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $report->description }}
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Gambar') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if(is_null($report->image))
                                            {{ __('Tidak ada gambar') }}
                                        @else
                                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                                            <img src="{{ $report->image_url }}" class="img" alt="">
                                        </div>
                                        @endif
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ __('Data Pelapor') }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <dl class="sm:divide-y sm:divide-gray-200">
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Nama') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->name }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Jenis Kelamin') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->gender }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('NIK') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->nik }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Golongan Darah') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->blood_type }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Nomor HP') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->phone }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Nomor HP Kontak Darurat') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->emergency_phone }}
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Alamat') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $report->user->address }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </dd>
                                </div>
                            </dl>
                            <div class="px-4 py-5 sm:px-6">
                                <form action="{{ route('admin.reports.update',['report'=>$report]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-8 divide-y divide-gray-200">
                                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                            <div>
                                                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="action"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            {{ __('Aksi') }}
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            @if($report->status != 'COMPLETED')
                                            <textarea id="action" name="action" rows="3" maxlength="255"
                                                      class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                                                      required>{{ $report->action }}</textarea>
                                                            <p class="mt-2 text-sm text-gray-500">{{ __('Tuliskan aksi yang dilakukan, misal mengirimkan petugas dan estimasi petugas tersebut sampai ketempat laporan.') }}</p>
                                                            @else
                                                                {{ $report->action }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="stakeholder_id"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            {{ __('Petugas Dari') }}
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            @if($report->status != 'COMPLETED')
                                                                <select id="stakeholder_id" name="stakeholder_id"
                                                                        class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                                                    @foreach($stakeHolders as $stakeHolder)
                                                                        <option value="{{ $stakeHolder->id }}">{{ $stakeHolder->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                {{ $report->stakeholder->name }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="action"
                                                               class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                            {{ __('Status') }}
                                                        </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            @if($report->status != "COMPLETED")
                                                            <fieldset class="mt-4">
                                                                <legend class="sr-only">Status</legend>
                                                                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                                                    <div class="flex items-center">
                                                                        <input id="process" name="status" type="radio" value="PROCESS" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                                        <label for="process" class="ml-3 block text-sm font-medium text-gray-700">
                                                                            {{ __('Proses') }}
                                                                        </label>
                                                                    </div>

                                                                    <div class="flex items-center">
                                                                        <input id="completed" name="status" type="radio" value="COMPLETED" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                                        <label for="completed" class="ml-3 block text-sm font-medium text-gray-700">
                                                                            {{ __('Selesai') }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @else
                                                                {{ $report->status }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-5">
                                            <div class="flex justify-end">
                                                <a href="{{ route('admin.reports.index') }}"
                                                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Back
                                                </a>
                                                @if(($report->status != "COMPLETED"))
                                                <button type="submit"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Save
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
