<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button id="addFriendButton" onclick="window.location='{{route('addFriends')}}'" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">ADD A FRIEND</button>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button id="uploadFilesButton" onclick="window.location='{{route('uploadContent')}}'" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">UPLOAD CONTENT</button>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button id="startPartyButton" onclick="window.location='{{route('newParty')}}'" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">START A PARTY</button>
            </div>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button id="manageFriendsButton" onclick="window.location='{{route('manageFriends')}}'" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">MANAGE FRIENDSHIPS</button>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button id="manageContentButton" onclick="window.location='{{route('manageContent')}}'" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">MANAGE CONTENT</button>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <button onclick="window.location='{{route('join_party')}}'" id="joinPartyButton" class="w-full aspect-video rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:scale-95 transition-all duration-200 text-gray-800 dark:text-gray-100 text-lg font-medium shadow-sm">JOIN A PARTY</button>
            </div>
        </div>
    </div>
    
</x-layouts.app>
