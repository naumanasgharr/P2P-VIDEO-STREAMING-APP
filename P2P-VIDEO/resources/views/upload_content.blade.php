<x-layouts.app :title="__('UPLOAD CONTENT')">
    <form id="upload-form" enctype="multipart/form-data">
        @csrf
        <input style="padding:2px;background-color:aliceblue;color:black; width: 25%; margin:7px; box-shadow: 5px 5px black;" type="file" id="file-input" name="file">
        <button style=" background-color:black;border:1px;color:aliceblue; padding: 2px; box-shadow: 2px 2px aliceblue;" type="submit" style="margin-top: 10px;">Upload</button>
        <div style="margin-top: 10px;">
            <progress id="upload-progress" value="0" max="100" style="width: 100%; display: none; color: aliceblue;"></progress>
        </div>
    </form> 

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">{{session('error')}}</div>
    @endif
    @if(session('success'))
        <div class="bg-blue-500 text-white p-4 rounded-lg mb-4 w-1/2 mx-auto">{{session('success')}}</div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('upload-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const fileInput = document.getElementById('file-input');
            const progressBar = document.getElementById('upload-progress');
            const formData = new FormData();

            formData.append('file', fileInput.files[0]);

            progressBar.style.display = 'block';
            progressBar.value = 0;

            axios.post("{{ route('uploadContent') }}", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                onUploadProgress: function (progressEvent) {
                    const percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progressBar.value = percent;
                }
            })
            .then(function (response) {
                alert("Upload successful!");
                progressBar.style.display = 'none';
            })
            .catch(function (error) {
                alert("Upload failed.");
                progressBar.style.display = 'none';
            });
        });
    </script>
</x-layouts.app>