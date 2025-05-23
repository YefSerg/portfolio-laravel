<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow app__header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
                        {{ $header }}

                        <div class="profile-dropdown__wrapper hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48" contentClasses='profile-dropdown__hide'>
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.index')">
                                        {{ 'Admin' }}
                                    </x-dropdown-link>

                                    @if(true)
                                        <x-dropdown-link :href="back()->getTargetUrl()">
                                            {{ 'Return' }}
                                        </x-dropdown-link>
                                    @endif

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>


                </header>
            @endisset


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <style>
        .app__header, .profile-edit__wrapper {
            background-color: #454d55;
        }

        .app__header h2,
        .profile-edit__wrapper h2,
        .profile-edit__wrapper p,
        .profile-edit__wrapper label {
            color: #fff;
        }

        .profile-edit__wrapper input {
            background-color: transparent;
            color: #fff;
        }

        .profile-edit button + p {
            color: green;
        }

        .profile-edit {
            background-color: #343a40;
        }

        .profile-dropdown__wrapper button {
            background-color: #454d55 !important;
            color: #fff !important;
        }

        .profile-dropdown__hide {
            background-color: #454d55;
        }

        .profile-dropdown__hide a {
            color: #fff;
        }

        .profile-dropdown__hide a:hover {
            color: #fff;
            background-color: #343a40;
        }
    </style>
</html>
