<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //Tampilan halaman utama admin
    public function adminIndex()
    {   $news = News::paginate(4);
        $stats = [
            'total_news' => News::count(),
        ];
        return view('admin.index', compact('news', 'stats'));
    }

    //Tampilan halaman tambah berita
    public function adminAdd()
    {
        return view('admin.add');
    }

    //Proses mengirim data setelah tambah berita
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

    // Memastikan file ada sebelun disimpan
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $imagePath = $gambar->store('gambar_berita', 'public');
            }


        $news = News::create([
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'kategori' => $validatedData['kategori'],
            'gambar' => $imagePath ?? null,
            'penulis' => $validatedData['penulis'],
            'jabatan_penulis' => $validatedData['jabatan_penulis'],
            'isi_contenct' => $validatedData['isi_contenct'],
        ]);

        // Kirim notifikasi ke semua user bahwa berita baru dibuat
        $users = User::all();
        if ($users->isNotEmpty()) {
            Notification::send($users, new AdminNotification($news, 'created'));
        }

        return redirect()->route('admin.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    //Tampilan halaman edit berita
    public function adminEdit($id)
    {
        $news = News::find($id);
        return view('admin.edit', compact('news'));
    }

    //Proses mengirim data setelah edit berita
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

        // Memastikan file ada sebelum disimpan
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
       $users = User::all();
        if ($users->isNotEmpty()) {
        Notification::send($users, new AdminNotification($news, 'updated'));
        }

        return redirect()->route('admin.index')->with('success', 'Berita berhasil diperbarui.');
    }

   //Proses menghapus berita berdasarkan id
    public function adminDelete($id)
    {
        $news = News::find($id);
        $judul = $news->judul;

        Notification::send(
        User::all(),
        new AdminNotification($news, 'deleted')
         );

        $news->delete();

        return redirect()
        ->route('admin.index');
    }

    //Tampilan halaman notifikasi admin
    public function adminnotifikasi()
    {
         $notifications = auth()->user()
        ->notifications()
        ->latest()
        ->paginate(10);

        // Tandai sebagai dibaca
        auth()->user()->unreadNotifications->markAsRead();

        return view('admin.notifikasi', compact('notifications'));
    }

}
