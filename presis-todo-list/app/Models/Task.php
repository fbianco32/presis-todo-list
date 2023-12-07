<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Task extends Model
{
    use HasFactory;
    protected $table = "task";
    protected $fillable = [
        'title', 'status'
    ];

    public static function validateStatus(string $status){
        $validStatuses = ['pending', 'processing', 'completed'];
        if(!$status || !(collect($validStatuses)->contains($status))) {
            throw new BadRequestException('The status is invalid');
        }
        return $status;
    }
    

    public static function validateTitle($title){
        $titleRegex = '/^[\w-]*$/';
        if(!$title || !(preg_match($titleRegex, $title))) {
            throw new BadRequestException('The title is invalid');
        }
        return $title;
    }
}
