<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    //
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    public function childColumns(){
        return $this->hasMany('App\Models\Column','parent_id','id');
    }
    public function allContents(){
        return $this->hasMany('App\Models\Content','column_id','id');
    }
    public function columnId(){
        return $this->hasOne('App\Models\Column','path','id');
    }
    public function parentTopId($id){
        $cols = $this->select('id','parent_id')->get();
        $arr = Array();
        foreach ($cols as $col){
            $arr[$col->id] = $col->parent_id;
        }
        while($arr[$id]) {
            $id = $arr[$id];
        }
        return $this->where('id',$id)->first();
    }
    public function parentId(){
        return $this->belongsTo('App\Models\Column','parent_id','id');
    }
    public function allChildrenColumns(){
        return $this->childColumns()->with('allChildrenColumns');
    }
}
