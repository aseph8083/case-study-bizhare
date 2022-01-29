<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
	protected $fillable = array(
		'name', 
		'description', 
		'type',
		'user_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}
?>

