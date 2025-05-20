<x-layouts.app :title="__('JOIN PARTY')">
    <div style="display: flex; border: 1px solid; border-radius:5px; width:50%; box-shadow: 2px 5px; margin: auto; padding:5px; align-items: center; align-self: center; background-color: black;">
        <form action="/joinParty" method="POST">
            @csrf
            <label for="uuid">ENTER INVITE LINK:</label>
            <input name="uuid" type="text" style="background-color: aliceblue; color: black; width:85%;">
            <button type="submit" style="background-color: aliceblue; box-shadow: 2px 2px gray; margin: 2px; padding: 4px; color:black;">JOIN</button>
        </form>
            
    </div>

    @if(session('error1'))
        <div id="flash-message" class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
            {{ session('error1') }}
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
    @if(session('error2'))
        <div id="flash-message" class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-md mx-auto text-center shadow-lg transition-opacity duration-500">
            {{ session('error2') }}
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
</x-layouts.app>