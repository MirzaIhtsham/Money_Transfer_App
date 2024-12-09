<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 sm:px-8 lg:px-12  ">
        <!-- Heading Section -->
        <div class="text-center mb-8">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-200 leading-tight">
                Manage Balance for {{ $user->name }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">
                <strong>Current Balance:</strong> ${{ number_format($user->balance, 2) }}
            </p>
        </div>

        <!-- Deposit Section -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Deposit Funds</h3>
            <form action="{{ route('wallet.deposit', $user->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-6">
                    <x-input-label for="balance" :value="__('Deposit Amount:')" class="text-gray-700 dark:text-gray-300"/>
                    <x-text-input id="balance" name="amount" type="number" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500"
                        :value="old('amount')" required autofocus autocomplete="phone" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2 text-sm text-red-500"/>
                </div>
                <div class="flex justify-center">
                    <x-primary-button class="w-full sm:w-auto py-2 px-6 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200">
                        {{ __('Deposit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

       
    </div>
</x-app-layout>

