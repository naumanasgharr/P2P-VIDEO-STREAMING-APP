<x-layouts.app :title="__('MANAGE FRIENDS')">
    <div id="friend-requests-container">
    <h2 class="bg-gray-50">Pending Friend Requests</h2>

    @foreach($friendRequests as $request)
        <div style="background-color:#2A4759;width:50%; border: 1px; border-radius: 5px; margin: 5px; box-shadow:2px 5px;" class="friend-request" data-id="{{ $request->id }}">
            <span style="font-size:15px; color: #DDDDDD; margin: 2px;">{{ $request->user->username }} , {{$request->user->name}}</span>
            <button style="border:1px solid #DDDDDD; padding:2px;font-weight: bold; box-shadow: 1px 1px;" onclick="window.location='{{route('requestAccepted',$request->user->id)}}'" data-id="{{ $request->id }}">Accept</button>
            <button style="border:1px solid #DDDDDD; margin:5px; padding: 2px; font-weight: bold; box-shadow: 1px 1px;" onclick="window.location='{{route('requestRejected',$request->user->id)}}'" class="reject-btn" data-id="{{ $request->id }}">Reject</button>
        </div>
    @endforeach

    @if(session('accepted')) 
    <div class="bg-blue-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">
        {{session('accepted')}}
    </div>    
    @endif
    @if(session('rejected')) 
    <div class="bg-red-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">
        {{session('rejected')}}
    </div>    
    @endif

    @if(session('error4'))
    <div class="bg-red-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">
        {{session('error4')}}
    </div>
    @endif

    @if(count($friendRequests) === 0)
        <p style="font-size: 10px; color:silver;" id="no-requests-msg">You have no pending requests.</p>
    @endif


    <h2>FRIENDS</h2>
    @foreach ($friends as $friend)
        <div style="background-color:#2A4759;width:50%; border: 1px; border-radius: 5px; margin: 5px; box-shadow:2px 5px;" class="friend-request" data-id="{{ $friend->id }}">
            <span style="font-size:15px; color: #DDDDDD; margin: 2px;">{{ $friend->friend->username }} , {{$friend->friend->name}}</span>
            <button onclick="window.location='{{route('removeFriend',$friend->friend->id)}}'" style="border:1px solid #DDDDDD; margin:5px; padding: 2px; font-weight: bold; box-shadow: 1px 1px; background-color: red;" class="remove-btn" data-id="{{ $friend->id }}">Remove</button>
        </div>
    @endforeach
    @if(session('removed'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">
        {{session('removed')}}
    </div>
    @endif
    @if(count($friends) === 0)
        <p style="font-size: 10px; color:silver;" id="no-requests-msg">You have no friends :(</p>
    @endif
</div>
</x-layouts.app>
