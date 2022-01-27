<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	protected $fillable = array(
		'name', 
		'description', 
		'user_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;

	public function articles(){
		return $this->belongsToMany(Article::class);
	}
}
?>

