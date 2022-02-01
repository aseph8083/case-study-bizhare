<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{	
	public $table = "portofolios";
	protected $fillable = array(
		'name', 
		'user_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}

?>

