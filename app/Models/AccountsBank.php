<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AccountsBank extends Model
{
  use SoftDeletes;
    
  protected $table = 'accounts_bank';

  protected $fillable = [
    'number_account',
    'bank_name',
    'type_account',
    'details'
  ];


}
