<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    public $timestamps = true;

    protected $fillable = ['name', 'class_id','user_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function attendanceRecords()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public static function CreateValidate()
    {
        return [
           'name' => 'required|min:3',
           'class_id' => 'required|exists:classes,id',
           

        ];
    }
}
