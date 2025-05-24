<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    protected $table = 'tbl_contacts';
    protected $fillable = ['name', 'phone', 'file_path'];
}
