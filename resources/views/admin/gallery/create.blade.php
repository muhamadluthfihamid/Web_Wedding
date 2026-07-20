@extends('admin.layouts.admin')

@section('main-content')
    <div class="container">
        <h1 class="mb-4">Create New Galery</h1>
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_nama_pengantin_istri" class="form-label">Nama Pengantin Istri</label>
                        <select name="id_nama_pengantin_istri" id="id_nama_pengantin_istri" class="form-control" required>
                            @foreach ($infos as $info)
                                <option value="{{ $info->id }}">{{ $info->nama_pengantin_istri }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="drop-area" class="border p-5 text-center">
                        <p>Drag & drop gambar di sini atau klik</p>
                        <input type="file" id="fileElem" name="images[]" multiple hidden>
                        <button type="button" onclick="document.getElementById('fileElem').click()">
                            Pilih Gambar
                        </button>
                        <div id="preview" class="flex gap-2 mt-3 mb-2"></div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_nama_pengantin_pria" class="form-label">Nama Pengantin Pria</label>
                        <select name="id_nama_pengantin_pria" id="id_nama_pengantin_pria" class="form-control" required>
                            @foreach ($infos as $info)
                                <option value="{{ $info->id }}">{{ $info->nama_pengantin_pria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                    </div>
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <script id="9k0y3m">
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileElem');
        const preview = document.getElementById('preview');

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('bg-light');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('bg-light');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('bg-light');

            fileInput.files = e.dataTransfer.files;
            showPreview(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', () => {
            showPreview(fileInput.files);
        });

        function showPreview(files) {
            preview.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '80px';
                    img.style.height = '80px';
                    img.style.objectFit = 'cover';
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
