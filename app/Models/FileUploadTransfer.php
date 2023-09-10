<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FileUploadTransfer extends Model
{
  use SoftDeletes;
    
  protected $table = 'file_upload_transfer';

  protected $fillable = [
    'original_name',
    'filename',
    'extension',
    'size',
    'cart_shop_id'
  ];
}
