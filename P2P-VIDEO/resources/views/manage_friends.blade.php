<x-layouts.app :title="__('MANAGE FRIENDS')">
    
    <div id="friend-requests-container">
        
        <div style="text-align:center;background-color:black;border:1px solid; width:25%;box-shadow:5px 2px; margin:5px;">
            <h2 style="font-size:20px;">Pending Friend Requests</h2>
        </div>
        

        @foreach($friendRequests as $request)
            <div style="background-color:aliceblue;width:40%; border: 1px solid; border-radius: 5px; margin: 5px; box-shadow:2px 5px black; display: flex; justify-content:space-between; align-items:center;" class="friend-request" data-id="{{ $request->id }}">
                <span style="font-size:15px; color: black; margin: 2px;font-weight:bold;">{{ $request->user->username }} , {{$request->user->name}}</span>
                <div>
                    <button style="background-color:black;border:1px solid gray; padding:2px;font-weight: bold; box-shadow: 1px 1px gray;" onclick="window.location='{{route('requestAccepted',$request->user->id)}}'" data-id="{{ $request->id }}">Accept</button>
                    <button style="background-color:black; border:1px solid gray; margin:5px; padding: 2px; font-weight: bold; box-shadow: 1px 1px gray;" onclick="window.location='{{route('requestRejected',$request->user->id)}}'" class="reject-btn" data-id="{{ $request->id }}">Reject</button>
                </div>
                
            </div>
        @endforeach

        @if(session('accepted')) 
            <div id="flash-message" class="bg-blue-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
                {{session('accepted')}}
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

        @if(session('rejected')) 
            <div id="flash-message" class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
                {{session('rejected')}}
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

        @if(session('error4'))
            <div id="flash-message" class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
                {{session('error4')}}
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

        @if(count($friendRequests) === 0)
            <p style="font-size: 15px; color:silver;margin-left:8px;" id="no-requests-msg">You have no pending requests.</p>
        @endif

        <div style="text-align:center; background-color:black;border:1px solid; width:25%;box-shadow:5px 2px; margin:5px; margin-top:20px; margin-bottom:10px;">
            <h2 style="font-size:20px;">FRIENDS</h2>
        </div>

        @foreach ($friends as $friend)
            <div style="background-color:aliceblue;width:40%; border: 1px solid; border-radius: 5px; margin: 5px; box-shadow:2px 5px black; display:flex; justify-content: space-between; align-items: center;" class="friend-request" data-id="{{ $friend->id }}">
                <span style="font-size:15px; color: black; font-weight:bold; margin: 2px;">{{ $friend->friend->username }} , {{$friend->friend->name}}</span>
                <button onclick="window.location='{{route('removeFriend',$friend->friend->id)}}'" style="border:1px solid black; margin:5px; padding: 2px; font-weight: bold; box-shadow: 1px 1px black; background-color: red;" class="remove-btn" data-id="{{ $friend->id }}">Remove</button>
            </div>
        @endforeach

        @if(session('removed'))
            <div id="flash-message" class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
                {{session('removed')}}
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

        @if(count($friends) === 0)
            <p style="font-size: 15px; color:silver;margin-left:8px;" id="no-requests-msg">You have no friends :(</p>
        @endif

    </div>

</x-layouts.app>
