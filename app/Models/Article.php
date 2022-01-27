<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = array(
		'title', 
		'body', 
		'user_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;

	public function types(){
		return $this->belongsToMany(Type::class);
	}
}
?>

