<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['notifiable_type', 'notifiable_id', 'title', 'message', 'is_read'];

    public function notifiable()
    {
        return $this->morphTo();
    }

    public static function push($tipeAkun, $idAkun, $judul, $pesan)
    {
        return self::create([
            'notifiable_type' => $tipeAkun,
            'notifiable_id'   => $idAkun,
            'title'           => $judul,
            'message'         => $pesan,
            'is_read'         => false,
        ]);
    }
}
