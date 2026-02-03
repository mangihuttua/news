<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table-actions {
            white-space: nowrap;
        }

        .preview-image {
            max-width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .article-title {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .status-badge {
            font-size: 0.75rem;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/index">
                <i class="fas fa-newspaper me-2"></i>Magzine Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/index">
                            <i class="fas fa-eye me-1"></i>Lihat Website
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" onclick="logout()">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-4">
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>