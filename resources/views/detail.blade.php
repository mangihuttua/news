@extends('layout')

@section('content')
    <article class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <!-- Author Info -->
                    <div class="text-center mb-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sergey" alt=""
                            class="rounded-circle mb-3" width="80" height="80">
                        <h6 class="mb-0 text-dark">{{$news->penulis}}</h6>
                    </div>

                    <!-- Article Title -->
                    <h1 class="display-5 fw-bold text-dark text-center mb-4">
                       {{ $news->judul }}
                    </h1>

                    <!-- Article Subtitle -->
                    <p class="lead text-secondary text-center mb-5">
                        {{ $news->deskripsi }}
                    </p>

                    <!-- Featured Image -->
                    <div class="mb-5">
                        <img src="{{ asset('storage/' . $news->gambar) }}" alt="Article featured image"
                            class="img-fluid rounded">
                    </div>

                    <!-- Article Content -->
                    <div class="text-secondary lh-lg">
                        <p class="mb-4">
                            {{ $news->isi_contenct}}
                        </p>
                    </div>

                    <!-- Article Meta -->
                    <div class="border-top border-secondary pt-4 mt-5">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="text-secondary small">
                                Dipublikasikan pada {{ $news->created_at->format('d F Y') }}
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-secondary text-dark">{{ $news->kategori }}</span>
                                <span class="badge bg-secondary text-dark">Perjalanan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="border-top border-secondary pt-4 mt-4">
                        <div class="d-flex gap-3">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sergey" alt="Sergey Campbell"
                                class="rounded-circle flex-shrink-0" width="60" height="60">
                            <div>
                                <h6 class="mb-1 fw-semibold text-dark">{{ $news->penulis }}</h6>
                                <p class="mb-2 small text-secondary">{{ $news->jabatan_penulis }}</p>
                                <p class="mb-0 text-secondary small">
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Articles -->
                    <div class="text-center mt-5">
                        <a href="/index" class="btn btn-outline-secondary">← Kembali ke Artikel</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection