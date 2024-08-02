@vite('resources/css/app.css')
<form class="h-screen px-10 w-full gap-3 flex flex-row justify-center items-center" action="{{ route('get.text') }}" method="GET">
    @method('GET')
    @csrf
    <label for="password" class="text-blue-700">Password:</label>
    <input type="text" name="password" id="password"    class="w-full p-2 bg-transparent   border-2 border-blue-700 rounded-md ">
    <button class="border-4 border-white px-3 py-1 font-bold rounded-lg text-center bg-blue-700">
        Get</button>
</form>