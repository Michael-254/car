<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="site" :value="__('Site')" />

                <select id="site" class="block mt-1 w-full rounded-md shadow-sm border-green-300 
                focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" name="site" :value="old('site')" required>
                <option value="">--Select Site--</option>
                <option value="Head Office">Head Office</option>
                <option value="Nyongoro">Nyongoro</option>
                <option value="Kiambere">Kiambere</option>
                <option value="Dokolo">Dokolo</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="department" :value="__('Department')" />

                <select id="department" class="block mt-1 w-full rounded-md shadow-sm border-green-300 
                focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" name="department" :value="old('department')" required>
                <option value="">--Select Department--</option>
                <option value="Forestry">Forestry</option>
                <option value="Operations">Operations</option>
                <option value="HR">HR</option>
                <option value="IT">IT</option>
                <option value="Communications">Communications</option>
                <option value="Miti Magazine">Miti Magazine</option>
                <option value="Accounts">Accounts</option>
                <option value="ME">M&E</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="HOD" :value="__('HOD Email')" />

                <x-input id="HOD" class="block mt-1 w-full" type="email" name="HOD" :value="old('HOD')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-green-500 hover:text-red-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
