<?php namespace ShahiemSeymor\Bbcode\Models;

use Model;

class Emoticon extends Model
{

	public $table          = 'shahiemseymor_bbcode_emoticons';
    public $attachOne      = [
	    'emoticon'         => ['System\Models\File']
	];

    protected $jsonable    = ['notation'];
    public $rules          = [
        'name'            => 'required',
    ];

    protected $fillable = ['name', 'emoticon', 'notation', 'in_editor', 'in_forum'];

    public static function getEmoctions()
    {
        $image = Emoticon::get(array('id', 'name', 'notation'));
        $emoticon = array();

        foreach($image as $fetch)
        {
            $notation        = array_pluck($fetch->notation, 'notation');
            $path            = Emoticon::find($fetch->id)->emoticon->getPath();
            $emoticon[$path] = $notation;
        }

        return $emoticon;
    }

	public static function getJsonEmoctions()
    {
    	$image = Emoticon::where('in_editor', 1)->get();
        $emoticon = [];
    	foreach($image as $fetch)
    	{
            $notation   = array_pluck($fetch->notation, 'notation');
            $emoticon[] = ['title' => 'ss', 'img' => '<img src="'.Emoticon::find($fetch->id)->emoticon->getPath().'" />', 'bbcode' => $notation[0]];
    	}

    	return json_encode(array_values($emoticon));
    }

    public function getImageAttribute()
    {
        return '<img src="'.Emoticon::find($this->id)->emoticon->getPath().'" />';
    }
    
}