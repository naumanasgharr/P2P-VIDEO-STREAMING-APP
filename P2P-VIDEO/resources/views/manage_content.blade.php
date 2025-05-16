<x-layouts.app :title="__('MANAGE CONTENT')">
    <div style="text-align:center;background-color:black;border:1px solid; width:25%;box-shadow:5px 2px; margin:5px;">
        <h2>CONTENT UPLOADED</h2>
    </div>

    @foreach ($fileList as $file)
        <div style="background-color:aliceblue;width:40%; border: 1px solid; border-radius: 5px; margin: 5px; box-shadow:2px 5px black; display: flex; justify-content:space-between; align-items:center;">
            <span style="font-size:15px; color: black; margin: 2px;font-weight:bold;">{{$file['name']}}</span>
            <button onclick="window.location='{{route('removeContent',['file'=>$file['url']])}}'" style="border:1px solid black; margin:5px; padding: 2px; font-weight: bold; box-shadow: 1px 1px black; background-color: red;">remove</button>
        </div>
    @endforeach

    @if(session('success'))
        <div id="flash-message"
        class="bg-green-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
            {{session('success')}}
        </div>

        <script>
            setTimeout(() => {
                const el = document.getElementById('flash-message');
                if (el) {
                    el.style.opacity = 0;
                    setTimeout(() => el.remove(), 500);
                }
            }, 2000);
        </script>
    @endif

    @if(count($fileList) === 0)
            <p style="font-size: 15px; color:silver;margin-left:8px;" id="no-requests-msg">You have no uploaded content</p>
    @endif
    
</x-layouts.app>