<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $primaryKey = 'user_id';
    protected $table = 'accounts';
	  public $timestamps = false;

    protected $fillable = [
			'user_id', 
			'avatar', 
			'provider', 
			'provider_id', 
			'id_card', 
			'local_person_code', 
			'birthdate', 
			'phonenumber',
    	'gender', 
			'address', 
			'address2', 
			'city', 
			'country', 
			'zipcode', 
			'about', 
			'website', 
			'confirmation_token'
		];
	 protected $guarded = array('user_id');
    
   public static $rules = [
                'user_id' => 'required',
								'avatar' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ];
     
		public function setBirthdateAttribute($value)
		{
				 $this->attributes['birthdate'] = date('Y-m-d', strtotime($value));
		}
	
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
