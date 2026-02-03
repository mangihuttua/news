<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Admin</title>
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
                        <a class="nav-link" href="../index.html">
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
                        <i class="fas fa-plus-circle text-primary me-2"></i>Tambah Berita Baru
                    </h2>
                </div>

                <!-- Form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Input Berita</h5>
                    </div>
                    <div class="card-body">
                        <form id="addForm" method="POST" action="/admin/store" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">
                                            Judul <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title" name="judul" required>
                                        @error('judul')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                        
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            Deskripsi <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="description" name="deskripsi" rows="3"
                                            required></textarea>
                                            @error('deskripsi')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label">
                                            Kategori <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-select" id="category" name="kategori" required>
                                            <option value="">Pilih kategori...</option>
                                            <option value="bisnis">Bisnis</option>
                                            <option value="teknologi">Teknologi</option>
                                            <option value="olahraga">Olahraga</option>
                                            <option value="hiburan">Hiburan</option>
                                            <option value="politik">Politik</option>
                                            <option value="kesehatan">Kesehatan</option>
                                            @error('kategori')
                                            <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            Gambar Berita <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" id="" name="gambar" class="@error('gambar') is-invalid @enderror">
                                            @error('gambar')
                                            <div class="text-danger small">{{ $message }}</div> 
                                            @enderror
                                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                                        <div class="mt-2">
                                            <img id="imagePreview" src="" alt="Preview"
                                                style="max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 4px; display: none;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Author -->
                                    <div class="mb-3">
                                        <label for="author" class="form-label">
                                            Penulis <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="author" name="penulis" required>
                                        @error('penulis')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Author Position -->
                                    <div class="mb-3">
                                        <label for="position" class="form-label">
                                            Jabatan Penulis <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="position" name="jabatan_penulis" required>
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
                                <textarea class="form-control" id="content" name="isi_contenct" rows="8" required
                                    placeholder="Tulis isi berita di sini..."></textarea>
                                    @error('isi_contenct')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="/admin/index" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan
                                </button>
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