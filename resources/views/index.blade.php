@extends('layout')

@section('content')
    <div class="container-lg py-5">
        <div class="row g-4">
             @foreach($news as $items)
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white border h-100">
                    <img src="{{ asset('storage/' . $items->gambar) }}" alt="Article" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <p class="text-secondary small text-uppercase mb-2">
                            <a href="#" class="text-secondary text-decoration-none">{{ $items->kategori }}</a>,
                            <a href="#" class="text-secondary text-decoration-none"></a> {{ $items->created_at->format('d M Y') }}
                        </p>
                        <h5 class="card-title fw-bold mb-3"><a href="/detail/{{ $items->id }}"
                                class="text-dark text-decoration-none">{{ $items->judul }}</a></h5>
                        <p class="card-text text-secondary mb-4 flex-grow-1">{{ $items->deskripsi }}</p>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sergey" alt="Author"
                                class="rounded-circle" width="40" height="40">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $items->penulis }}</h6>
                                <p class="mb-0 small text-secondary">{{ $items->jabatan_penulis}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $news->links() }}
                </div>
</div>
@endsection