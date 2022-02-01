<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	protected $fillable = array(
		'id',
		'gambar'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}
?>

