@component('layouts.master')

    <div class="w-screen h-screen bg-gray-100 flex items-center justify-center">
        <div class="mx-auto w-1/4 rounded-md bg-white flex px-10 py-8">
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf

                <h1 class="text-4xl">Welcome</h1>

                <div class="mt-6 flex flex-col py-4">
                    <label for="email" class="text-sm font-extrabold">Email</label>
                    <input id="email" class="mt-1 bg-gray-200 rounded px-4 py-2" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div class="flex flex-col py-4">
                    <label for="password" class="text-sm font-extrabold">Password</label>
                    <input id="password" class="mt-1 bg-gray-200 rounded px-4 py-2" type="password" name="password" required autocomplete="current-password">
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="px-4 py-2 rounded bg-indigo-700 text-white font-extrabold transition duration-200 | hover:bg-indigo-800 hover:text-gray-100">Log in</button>
                </div>
            </form>
        </div>
    </div>

@endcomponent
