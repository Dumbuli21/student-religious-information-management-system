<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'religion_id',
        'role_id',
        'level_id',
        'department_id',
        'programme_id',
        'region_id',          // , now FK
        'name',
        'email',
        'student_number',
        'phone',
        'gender',
        'year_of_study',
        'password',
        'is_active',
        'password_changed',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'password_changed' => 'boolean',
        'gender'           => 'string',
        'year_of_study'    => 'integer',
        'password'         => 'hashed',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class); // ✅ NEW
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // ─── Role helpers ─────────────────────────────────────────────────────────

    public function hasRole(string $role): bool
    {
        return $this->role?->name === $role;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function isReligiousAdmin(): bool
    {
        return $this->hasRole('religious_admin');
    }

    public function isSubAdmin(): bool
    {
        return $this->hasRole('sub_admin');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    // ─── Dashboard redirect helper ────────────────────────────────────────────

    public function dashboardRoute(): string
    {
        $this->loadMissing('role');

        return match($this->role?->name) {
            'super_admin'     => 'super_admin.dashboard',
            'religious_admin' => 'religious_admin.dashboard',
            'sub_admin'       => 'sub_admin.dashboard',
            'student'         => 'student.dashboard',
            default           => 'login',
        };
    }

    // ─── Helper Methods for Student Info ─────────────────────────────────────

    public function academicInfo(): string
    {
        if (!$this->isStudent()) {
            return 'N/A';
        }

        $parts = [];
        if ($this->level)        $parts[] = $this->level->name;
        if ($this->department)   $parts[] = $this->department->name;
        if ($this->programme)    $parts[] = $this->programme->name;
        if ($this->year_of_study) $parts[] = "Year " . $this->year_of_study;

        return implode(' | ', $parts) ?: 'Not Set';
    }
}