<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_name',
        'photo_path',
        'photo_size'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function managedLibraries()
    {
        return $this->belongsToMany(Library::class, 'tb_gestor_biblioteca', 'id_usuario', 'id_biblioteca');
    }

    public function memberLibraries()
    {
        return $this->belongsToMany(Library::class, 'tb_usuario_biblioteca', 'id_usuario', 'id_biblioteca');
    }

    public function managerVerify($libraryId)
    {
        return DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', $this->id)
            ->where('id_biblioteca', $libraryId)
            ->exists();
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'id_usuario');
    }
}
