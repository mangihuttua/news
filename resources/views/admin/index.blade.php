@extends('admin.layout')    

@section('content')
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Kelola Berita</h1>
                <p class="text-muted mb-0">Buat, edit, dan kelola artikel berita</p>
            </div>
            <a href="/admin/add" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Berita
            </a>
        </div>


        <!-- Articles Table -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Berita</h5>
                    <span class="badge bg-secondary" id="totalArticles">Total: {{ $stats['total_news'] }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Penulis</th>
                                <th>Jabatan</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTable">
                              @foreach($news as $items)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $items->gambar) }}" alt="{{ $items->judul }}"
                                        class="preview-image">
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $items->judul }}</div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $items->deskripsi }}</small>
                                </td>
                                <td>{{ $items->penulis }}</td>
                                <td>{{ $items->jabatan_penulis }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $items->kategori }}</span>
                                </td>
                                <td class="table-actions">
                                    <div class="btn-group btn-group-sm">
                                        <a href="/admin/edit/{{ $items->id }}" class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/delete/{{ $items->id }}" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $news->links() }}
                </div>

            </div>
        </div>
    </div>
    @endsection