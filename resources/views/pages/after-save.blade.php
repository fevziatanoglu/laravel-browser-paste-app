@vite('resources/css/app.css')
<div class="h-screen w-screen  flex flex-col justify-center items-center gap-10 ">
    <div class="flex flex-row gap-3 text-6xl font-bold">
        <p>You can get your file at</p>
        <a href={{route('get.text' , $fileView->file_path)}} class="underline hover:opacity-50"> /{{ $fileView->file_path }}</a>
    </div>

    <div>
        Remember your file gonna deleted after

        <span>
            {{ $time_limit }} hour(s)
        </span>

        @if (isset($fileView->view_limit))
            <span>
                , {{ $fileView->view_limit }} view(s)
            </span>
        @endif
    </div>

</div>
