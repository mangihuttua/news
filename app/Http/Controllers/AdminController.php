<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class AdminController extends Controller
{
    public function adminIndex()
    {   $news = News::paginate(4);
        $stats = [
            'total_news' => News::count(),
        ];
        return view('admin.index', compact('news', 'stats'));
    }

    public function adminAdd()
    {
        return view('admin.add');
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|unique:news',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,gif|max:2048',
            'penulis' => 'required|string',
            'jabatan_penulis' => 'required|string',
            'isi_contenct' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $imagePath = $gambar->store('gambar_berita', 'public');
            }


        News::create([
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'kategori' => $validatedData['kategori'],
            'gambar' => $imagePath ?? null,
            'penulis' => $validatedData['penulis'],
            'jabatan_penulis' => $validatedData['jabatan_penulis'],
            'isi_contenct' => $validatedData['isi_contenct'],
        ]);

        return redirect()->route('admin.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function adminEdit($id)
    {
        $news = News::find($id);
        return view('admin.edit', compact('news'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|unique:news,judul,' . $id,
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,gif|max:2048',
            'penulis' => 'required|string',
            'jabatan_penulis' => 'required|string',
            'isi_contenct' => 'required|string',
        ]);

        $news = News::find($id);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $imagePath = $gambar->store('gambar_berita', 'public');
            $news->gambar = $imagePath;
        }

        $news->judul = $validatedData['judul'];
        $news->deskripsi = $validatedData['deskripsi'];
        $news->kategori = $validatedData['kategori'];
        $news->penulis = $validatedData['penulis'];
        $news->jabatan_penulis = $validatedData['jabatan_penulis'];
        $news->isi_contenct = $validatedData['isi_contenct'];
        $news->save();
        return redirect()->route('admin.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function adminDelete($id)
    {
        $news = News::find($id);
        $judul = $news->judul;
        $kategori = $news->kategori;
        
        $news->delete();

        // Kirim notifikasi ke semua user
        $users = User::all();
        $deletedNews = (object) [
            'id' => null,
            'judul' => $judul,
            'kategori' => $kategori,
            'penulis' => $news->penulis,
        ];
        foreach ($users as $user) {
            $user->notify(new NewsNotification($deletedNews, 'deleted'));
        }

        return redirect()->route('admin.index');
    }
}
