<?php

namespace App;

use App\Scopes\BasketTrait;
use App\Scopes\TimeTravel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use TimeTravel;
    use SoftDeletes;
    use BasketTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'display_name', 'description'];

    public $validation_rules = [
        'name' => [
            'required:roles',
            'regex:/^[a-z\d\_-]+$/',
            'max:255'
        ],
        'display_name' => 'required',
        'description' => 'required'
    ];

    public function getBy()
    {
        if(\Auth::user() !== null)
            return \Auth::user()->name . ' ' . \Auth::user()->lastname;

        return 'none';
    }
}