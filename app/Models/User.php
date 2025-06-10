<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Diperlukan untuk manajemen peran
use Illuminate\Database\Eloquent\Relations\HasOne; // Diperlukan untuk relasi HasOne
use Illuminate\Database\Eloquent\Relations\HasMany; // Diperlukan untuk relasi HasMany
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Diperlukan untuk relasi BelongsTo
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Diperlukan untuk relasi BelongsToMany (skills)

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles; // Menggunakan trait HasFactory, Notifiable, dan HasRoles

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    
    // =====================================================================
    // RELATIONS
    // =====================================================================

    /**
     * Get the applicant record associated with the user.
     * @return HasOne
     */
    public function applicant(): HasOne
    {
        return $this->hasOne(Applicant::class);
    }

    /**
     * Get the company record associated with the user.
     * Karena users.id adalah foreign key di companies.user_id, ini adalah relasi hasOne.
     * @return HasOne
     */
    public function company(): HasOne
    {
        // Pastikan 'user_id' adalah nama kolom foreign key di tabel 'companies'
        return $this->hasOne(Company::class, 'user_id'); 
    }

    /**
     * Get the jobs posted by the company associated with this user (if the user is a company),
     * atau jobs yang diposting langsung oleh user (jika skemanya demikian).
     * @return HasMany
     */
    public function jobs(): HasMany
    {
        // Asumsi user langsung memiliki banyak job, atau melalui Company.
        // Jika melalui Company, logikanya akan lebih kompleks dan biasanya diakses via Auth::user()->company->jobs
        return $this->hasMany(Job::class); 
    }

    /**
     * Get the skills associated with the user.
     * Asumsi relasi many-to-many dengan model Skill.
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * Get the location associated with the user.
     * Asumsi relasi many-to-one (User belongs to Location).
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    // =====================================================================
    // CUSTOM METHODS / ACCESSORS (BUKAN RELASI ELOQUENT)
    // =====================================================================

    /**
     * Get the preferred type of work for the user.
     * Ini adalah accessor yang mengembalikan atribut langsung dari user.
     */
    public function preferred_type_of_work()
    {
        return $this->type_of_work; // Mengakses atribut langsung dari model User
    }

    // =====================================================================
    // SCOPES
    // =====================================================================

    /**
     * Scope a query to search by name or email.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Scope a query to filter by user role.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByRole($query, $role)
    {
        if ($role && $role !== 'all') {
            return $query->where('role', $role);
        }
        return $query;
    }
}