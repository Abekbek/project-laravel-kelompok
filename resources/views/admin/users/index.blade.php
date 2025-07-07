<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Manajemen Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-sm">
                <div class="p-6 text-gray-100">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-300 user-datatable min-w-[640px]">
                            <thead class="text-xs text-gray-400 uppercase bg-slate-700">
                                <tr>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Admin?</th>
                                    <th class="px-4 py-3">Bergabung</th>
                                    <th class="px-4 py-3" width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">
      $(function () {
        var table = $('.user-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'is_admin', name: 'is_admin'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
      });

      function deleteUser(id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "User yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: '#1f2937',
                color: '#e5e7eb'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/' + id,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire('Terhapus!', response.success, 'success');
                            $('.user-datatable').DataTable().ajax.reload(null, false);
                        },
                        error: function(response) {
                            Swal.fire('Gagal!', response.responseJSON.error, 'error');
                        }
                    });
                }
            })
        }
    </script>
    @endpush
</x-app-layout>
