<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

</head>

<body>



    <main class="bg-gray-900 h-screen w-screen ">

        <form action="{{ route('save.text') }}" method="POST" class="h-full w-full flex flex-col p-3 gap-2">
            @csrf
            @method('POST')
            {{-- header inputs --}}
            <div class="w-full  flex flex-row gap-2 ">

                {{-- download limit --}}
                <div class="flex flex-col justify-center w-full   rounded">
                    <span class="block text-xs text-gray-300 ">
                        Download limit
                    </span>

                    <input type="number" name="download_limit"
                        class="w-full p-2 bg-transparent   border-2 border-blue-700 rounded-md ">
                    @error('download_limit')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                {{-- time limit --}}
                <div class="flex flex-col justify-center w-full   rounded-md">
                    <span class="block text-xs text-gray-300 ">
                        Time limit (hours)
                    </span>
                    <input type="number" name="time_limit" value="1"
                        class="w-full p-2 bg-transparent   border-2 border-blue-700 rounded-md ">
                    @error('time_limit')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                {{-- password --}}
                <div class="flex flex-col justify-center      w-full   rounded-md">
                    <span class="block text-xs text-gray-300 ">
                        Password
                    </span>
                    <input type="password" id="password" name="password"
                        class="w-full p-2 bg-transparent   border-2 border-blue-700 rounded-md ">
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- text area --}}
            <textarea name="text" id="text" class="border-4 rounded-lg border-blue-700 bg-transparent focus:border-white p-2  w-full grow "
                placeholder="Enter your text here"></textarea>
            {{-- buttom div --}}
            <div class=" p-3">
                <button class="border-4 border-white px-3 py-1 font-bold rounded-lg text-center bg-blue-700"
                    type="submit">Save</button>
                {{-- <a href={{ route('get.text') }}
                    class="border-4 border-white px-3 py-1 font-bold rounded-lg text-center bg-blue-700">Get</a> --}}



            </div>
        </form>

    </main>



</body>

</html>
