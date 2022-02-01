<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
	public $table = "business_categories";
	protected $fillable = array(
		'name', 
		'description'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}
?>

