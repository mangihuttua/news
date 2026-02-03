<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="/admin/index">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="mb-4">
                    <h2 class="text-center">
                        <i class="fas fa-edit text-warning me-2"></i>Edit Berita
                    </h2>
                </div>

                <!-- Form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Edit Berita</h5>
                    </div>
                    <div class="card-body">
                        <form id="editForm" method="POST" action="/admin/update/{{ $news->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">
                                            Judul <span class="text-danger">*</span>
                                            @error('judul')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" class="form-control" id="title" name="judul" required
                                            value="{{ $news->judul }}">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            Deskripsi <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="description" name="deskripsi" rows="3"
                                            required>{{ $news->deskripsi }}</textarea>
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label">
                                            Kategori <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="category" name="kategori" required>
                                            <option value="">Pilih kategori...</option>
                                            <option value="bisnis" {{ $news->kategori == 'bisnis' ? 'selected' : '' }}>Bisnis</option>
                                            <option value="teknologi" {{ $news->kategori == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                                            <option value="olahraga" {{ $news->kategori == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                            <option value="hiburan" {{ $news->kategori == 'hiburan' ? 'selected' : '' }}>Hiburan</option>
                                            <option value="politik" {{ $news->kategori == 'politik' ? 'selected' : '' }}>Politik</option>
                                            <option value="kesehatan" {{ $news->kategori == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                            @error('kategori')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            Gambar Berita
                                        </label>
                                       <input type="file" class="form-control" id="" name="gambar" class="@error('gambar') is-invalid @enderror">
                                            @error('gambar')
                                            <div class="text-danger small">{{ $message }}</div> 
                                            @enderror
                                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.
                                            Kosongkan jika tidak ingin mengubah gambar.</small>
                                        <div class="mt-2">
                                            <img id="imagePreview" src="{{ asset('storage/' . $news->gambar) }}"
                                                alt="Current Image"
                                                style="max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 4px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Author -->
                                    <div class="mb-3">
                                        <label for="author" class="form-label">
                                            Penulis <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="author" name="penulis" required
                                            value="{{ $news->penulis }}">
                                            @error('penulis')
                                            <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <!-- Author Position -->
                                    <div class="mb-3">
                                        <label for="position" class="form-label">
                                            Jabatan Penulis <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="position" name="jabatan_penulis" required
                                            value="{{ $news->jabatan_penulis }}">
                                        @error('jabatan_penulis')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="mb-3">
                                <label for="content" class="form-label">
                                    Isi Konten <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="content" name="isi_contenct" rows="8"
                                                required>{{ $news->isi_contenct }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 justify-content-between">
                                <form action="/admin/delete/{{ $news->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                <div class="d-flex gap-2">
                                    <a href="/admin/index" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>