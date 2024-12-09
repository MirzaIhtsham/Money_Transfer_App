<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h1 class="block text-3xl text-gray-700 dark:text-gray-300 font-bold">Step 1</h1>
            </div>
            <div class="max-w-xl">
                <form method="post" action="{{ route('calculate.conversion') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="currency" :value="__('From Currency:')" />
                        <select id="currency" name="sending_currency_id" class="mt-1 block w-full bg-transparent" required>
                            <option value="" {{ old('sending_currency_id') == '' ? 'selected' : '' }}>Select a Currency</option>
                            @foreach ($currencys as $currency)
                                <option value="{{ $currency->id }}" {{ old('sending_currency_id') == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->code }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('sending_currency_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="currency" :value="__('To Currency:')" />
                        <select id="currency" name="receiving_currency_id" class="mt-1 block w-full bg-transparent" required>
                            <option value="" {{ old('receiving_currency_id') == '' ? 'selected' : '' }}>Select a Currency</option>
                            @foreach ($currencys as $currency)
                                <option value="{{ $currency->id }}" {{ old('receiving_currency_id') == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->code }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('receiving_currency_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="amount" :value="__('Amount:')" />
                        <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full" value="{{ old('amount') }}" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Perform Transaction') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

