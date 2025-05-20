<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Party</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 w-screen h-screen m-0 p-0">

    <div class="flex items-center justify-center w-full h-full">
        <div class="flex gap-2 bg-gray-800 rounded-lg shadow-lg p-1">
            <!-- Video Section -->
            <div>
                <video id="videoPlayer" controls class="w-[99%] h-[99%] bg-black rounded-lg">
                    <source src={{$url}} type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Chat Section -->
            <div class="w-[350px] h-[470px] bg-gray-700 rounded-lg shadow-md flex flex-col">
                <div class="p-3 m-0 border-b border-gray-600 font-semibold">
                    <p style="font-size:11px">invite link: {{$room_key}}</p>
                </div>
                <div id="chat-box" class="flex-1 p-3 overflow-y-auto space-y-2">

                </div>
                <form method="POST" class="flex p-3 border-t border-gray-600">
                    @csrf
                    <input type="text" name="message" placeholder="Type a message..." class="flex-1 bg-gray-800 text-white px-3 py-2 rounded-l focus:outline-none focus:ring focus:ring-purple-500">
                    <button type="submit" class="bg-purple-600 px-4 py-2 rounded-r hover:bg-purple-700">Send</button>
                </form>
                <div style="margin:4px; margin-left:10px; display: flex; align-items: center;">
                <button onclick="window.location='{{route('endParty')}}?uuid={{$room_key}}'" style="margin:2px;border:1px solid; background-color: red; padding: 4px; box-shadow: 2px 2px aliceblue;">END</button>
                <button onclick="window.location='{{route('leaveParty')}}?uuid={{$room_key}}'" style="margin:2px;border:1px solid; background-color: red; padding: 4px; box-shadow: 2px 2px aliceblue;">LEAVE</button>

                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            window.location='{{route('dashboard')}}'
        </script>
    @endif
    @if(session('error'))
    <script>
        alert('YOU ARE NOT THE INITIATOR. YOU CANNOT END THIS PARTY.');
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        const echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true, // use true if using HTTPS
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
        });
        console.log('working');
        echo.channel("party.{{ $room_key }}")
        .subscribed(() => {
            console.log("✅ Subscribed to channel: party.{{ $room_key }}");
        })
        .error((error) => {
            console.error("❌ Channel subscription error:", error);
        })
        .listen('.PartyEnded', () => {
            console.log('hellooo');
            window.location.href = "{{ route('dashboard') }}";
        });
    
        const video = document.querySelector('#videoPlayer');
        let isRemote = false;

        video.addEventListener('play',()=>{
            broadcastVideoEvent('VideoPlayed',video.currentTime)
        });
        video.addEventListener('pause',()=>{
            broadcastVideoEvent('VideoPaused', video.currentTime)
        });
        video.addEventListener('seeked',()=>{
            broadcastVideoEvent('VideoSeeked', video.currentTime)
        });

        function broadcastVideoEvent(eventName, time) {
            axios.post(`/api/video/event`, {
            event: eventName,
            time: time,
            room_key: {{$room_key}}
        }
        )};

        echo.channel('room.{{$room_key}}')
        .subscribed((=>{
            console.log('subscribed on room.{{room_key}}')
        }))
        .listen('.VideoPlayed',(e)=>{
            isRemote = true;
            video.currentTime = e.time;
            video.play();
            setTimeout(() => isRemote = false, 500);
        })
        .listen('.VideoPaused',(e)=>{
            isRemote = true;
            video.currentTime = e.time;
            video.pause();
            setTimeout(() => isRemote = false, 500);
        })
        .listen('.VideoSeeked',(e)=>{
            isRemote = true;
            video.currentTime = e.time;
            setTimeout(() => isRemote = false, 500);
        });
  
    </script>
</body>
</html>