<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
{
    use Queueable;

    protected $news;
    protected $action;

    public function __construct($news, string $action)
    {
        $this->news = $news;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'news_id'   => $this->news->id ?? null,
            'gambar'    => $this->news->gambar ?? null,
            'judul'     => $this->news->judul ?? '',
            'deskripsi' => $this->news->deskripsi ?? '',
            'penulis'   => $this->news->penulis ?? '',
            'action'    => $this->action,
            'message'   => $this->makeMessage(),
        ];
    }

    protected function makeMessage(): string
    {
        $judul = $this->news->judul ?? 'Berita';

        return match ($this->action) {
            'created' => "Berita baru \"$judul\" telah ditambahkan.",
            'updated' => "Berita \"$judul\" telah diperbarui.",
            'deleted' => "Berita \"$judul\" telah dihapus.",
            default   => "Ada pembaruan pada berita \"$judul\".",
        };
    }
}
