<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{	
	public $table = "businesss";
	protected $fillable = array(
		'name', 
		'description', 
		'business_category_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}

?>

