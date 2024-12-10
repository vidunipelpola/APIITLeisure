<x-app-layout :title="'Profile - APIIT Leisure'">
    <x-slot name="header">
        <h1 class="text-4xl font-semibold mb-8 text-center text-white-600" style="color:#F8F8F8;">{{ __('Profile') }}</h1>
    </x-slot>
    <div class="pt-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background:#1E1E1E;">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background:#1E1E1E;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background:#1E1E1E;">
                <div class="max-w-xl">
                    @include('profile.partials.show-sports')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background:#1E1E1E;">
                <div class="max-w-xl">
                    @include('profile.partials.show-other-sports')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background:#1E1E1E;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
