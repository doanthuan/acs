<?php
/**
 * Created by PhpStorm.
 * User: doanthuan
 * Date: 3/5/2015
 * Time: 3:36 PM
 */

namespace App;

use Doanthuan\Ladmin\Model\Model;

class DeviceLending extends Model{

    protected $table = 'DeviceLending';
    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = ['DeviceId', 'EmployeeId', 'StartDate', 'EndDate'];

}