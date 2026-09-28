<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon Profil
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                <div class="relative z-10 flex items-center space-x-6">
                    <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center text-4xl font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-1">{{ auth()->user()->name }}</h1>
                        <p class="text-green-100">{{ auth()->user()->email }}</p>
                        @if(auth()->user()->role)
                            <span class="inline-block mt-2 px-3 py-1 bg-white/20 rounded-full text-sm font-medium">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white rounded-3xl shadow-lg">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white rounded-3xl shadow-lg">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white rounded-3xl shadow-lg border-2 border-red-100">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
