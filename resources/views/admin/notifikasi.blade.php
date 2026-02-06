@extends('admin.layout')

@section('content')
        <!-- Notifications Table -->
    <div class="container-fluid p-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Penulis</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($notifications as $notif)
                        <tr class="{{ is_null($notif->read_at) ? 'table-warning' : '' }}">
                            <td>
                              @if(!empty($notif->data['gambar']))
                                <img src="{{ asset('storage/' . $notif->data['gambar']) }}"
                                class="preview-image"
                                alt="{{ $notif->data['judul'] }}">
                              @else
                                <span class="text-muted">Tidak ada gambar</span>
                              @endif
                            </td>
                            <td>
                             <div class="fw-semibold">
                             {{ $notif->data['judul'] ?? '-' }}
                             </div>
                             @if(is_null($notif->read_at))
                             <span class="badge bg-danger status-badge">Baru</span>
                             @endif
                             </td>
                             <td>
                              <small class="text-muted">
                              {{ $notif->data['deskripsi']}}
                              </small>
                             </td>

                             <td>
                              {{ $notif->data['penulis'] }}
                             </td>
                             </tr>
                             @empty
                             <tr>
                             <td colspan="4" class="text-center text-muted">
                               Tidak ada notifikasi
                             </td>
                             </tr>
                             @endforelse
                    </tbody>
                    </table>
                     {{ $notifications->links() }}
                </div>
            </div>
    </div>
    @endsection 