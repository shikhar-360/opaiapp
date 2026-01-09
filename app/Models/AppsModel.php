<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppsModel extends Model
{
    protected $table = 'apps';

    protected $fillable = [
        'name',
        'slug', 
        'primary_color',
        'accent_color',
        'logo_path',
        'settings',
        'currency',
        'coin_price', 
        'admin_withdraw_fee',
        'cappingx'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(UsersModel::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function customers()
    {
        return $this->hasMany(CustomersModel::class, 'app_id');
    }

    public function levelPackages()
    {
        return $this->hasMany(AppLevelPackagesModel::class, 'app_id', 'id');
    }
    
     /**
     * Generate a unique slug based on the provided name.
     */
    public static function generateUniqueSlug($name, $appId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        // Keep looping until a unique slug is found
        while (true) {
            // Start the query builder
            $query = static::where('slug', $slug);

            // If an ID is provided, tell the query to ignore that specific record
            if ($appId) {
                $query->where('id', '!=', $appId);
            }

            // Check if the current $slug already exists in the database
            if (!$query->exists()) {
                // If it doesn't exist (or only exists on the ignored ID), we found a unique slug
                break; 
            }

            // If it *does* exist, generate a new slug with an incremented counter and try again
            $slug = "{$originalSlug}-" . $count++;
        }

        return $slug;
    }
}