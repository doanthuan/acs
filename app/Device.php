<?php
/**
 * Created by PhpStorm.
 * User: doanthuan
 * Date: 3/5/2015
 * Time: 3:36 PM
 */

namespace App;

use Doanthuan\Ladmin\Model\Model;

class Device extends Model{

    protected $table = 'Devices';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'CreationDate';
    const UPDATED_AT = 'LastModified';

    protected $fillable = ['CreationDate', 'IsActive', 'LastModified', 'Name', 'BarCode', 'DeviceTypeId', 'EmployeeId'];

}