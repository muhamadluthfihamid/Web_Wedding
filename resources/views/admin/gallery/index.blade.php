@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Gallery') }}</h1>
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-end mx-4">
            <a class="btn btn-primary" href="{{ route('gallery.create') }}" title="Create" role="button"><ion-icon
                    name="add-outline" size="small"></ion-icon></a>
        </div>

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
                                    <button class="btn btn-danger btn-delete" data-id="{{ $gallery->id }}">
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-delete').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var id = this.dataset.id;
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data gallery akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
