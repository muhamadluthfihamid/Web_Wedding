@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Gallery') }}</h1>
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-end mx-4">
            <a class="btn btn-primary" href="{{ route('gallery.create') }}" title="Create" role="button"><ion-icon
                    name="add-outline" size="small"></ion-icon></a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <table class="table table-striped-column">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Pengantin Pria</th>
                        <th scope="col">Pengantin Wanita</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($galeries->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-secondary" role="alert">
                                    <span>Belum Ada Data yang tersedia!!!</span>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($galeries as $index => $gallery)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gallery->infoIstri->nama_pengantin_istri ?? 'No Data' }}</td>
                                <td>{{ $gallery->infoPria->nama_pengantin_pria ?? 'No Data' }}</td>
                                <td>
                                    @foreach ($gallery->images as $img)
                                        <img src="{{ asset('storage/' . $img->path) }}" width="100">
                                    @endforeach
                                </td>
                                <td>{{ $gallery->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete({{ $gallery->id }})">
                                        Delete
                                    </button>
                                    <form id="delete-form-{{ $gallery->id }}"
                                        action="{{ route('gallery.destroy', $gallery->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
