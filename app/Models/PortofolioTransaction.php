<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortofolioTransaction extends Model
{
	public $table = "portofolio_transactions";
	protected $fillable = array(
		'portofolio_id', 
		'amount', 
        'business_id'
	);

	//untuk melakukan update field created_at dan updated_at secara otomatis
	public $timestamps = true;
}
?>

