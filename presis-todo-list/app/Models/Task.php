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
        if(!(collect($validStatuses)->contains($status))) {
            throw new BadRequestException('The status is invalid');
        }
        return $status;
    }
    

    public static function validateTitle(string $title){
        $titleRegex = '/^[\w-]*$/';
        if(!(preg_match($titleRegex, $title))) {
            throw new BadRequestException('The title is invalid');
        }
        return $title;
    }
}
