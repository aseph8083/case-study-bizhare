<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
	protected $fillable = array(
		'saldo',
		'user_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}
?>

