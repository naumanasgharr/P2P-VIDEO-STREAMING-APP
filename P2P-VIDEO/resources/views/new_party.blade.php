<x-layouts.app :title="__('NEW PARTY')">
    
    <div style="text-align:center;background-color:black;border:1px solid; width:25%;box-shadow:5px 2px; margin:5px;">
        <h2>SELECT CONTENT</h2> 
    </div>

    @foreach ($fileList as $file)
        <div style="background-color:aliceblue;width:40%; border: 1px solid; border-radius: 5px; margin: 5px; box-shadow:2px 5px black; display: flex; justify-content:space-between; align-items:center;">
            <button onclick="window.location='{{route('party',['url'=>$file['url']])}}}}'" type="button" style="font-size:15px; color: black; margin: 2px;font-weight:bold;">{{$file['name']}}</button>
        </div>
    @endforeach

    @if(count($fileList) === 0)
            <p style="font-size: 15px; color:silver;margin-left:8px;" id="no-requests-msg">You have no content to stream</p>
    @endif
    

</x-layouts.app>