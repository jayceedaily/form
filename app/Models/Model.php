<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Model extends Eloquent
{

    use SoftDeletes;

    public function save(Array $options = [])
    {
        if(Schema::hasColumn($this->getTable(), 'created_by') && $this->created_by == null) {

            $this->created_by = Auth::user()->id;
        };

        parent::save($options);
    }

    public function update(Array $attributes = [], Array $options = [])
    {
        if(Schema::hasColumn($this->getTable(), 'updated_by')) {

            $this->updated_by = Auth::user()->id;
        }

        parent::update($attributes, $options);
    }

    public function delete(Array $attributes = [], Array $options = [])
    {
        if(Schema::hasColumn($this->getTable(), 'deleted_by')) {

            $this->deleted_by = Auth::user()->id;
        }

        parent::delete($attributes, $options);
    }

    public static function findOrDie($id, $field = 'id')
    {
        $item = self::where($field, $id)->first();

        if(!$item) abort(404);

        return $item;
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function linkParser($value)
    {
        $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        return preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $value);
    }
}
