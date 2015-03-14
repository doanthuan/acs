<?php
/**
 * Created by PhpStorm.
 * User: doanthuan
 * Date: 3/5/2015
 * Time: 3:36 PM
 */

namespace App;

use Doanthuan\Ladmin\Model\Model;

class Employee extends Model{

    protected $table = 'Employees';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'CreationDate';
    const UPDATED_AT = 'LastModified';

    protected $fillable = ['CreationDate', 'IsActive', 'LastModified', 'LastName', 'FirstName', 'EmployeeCode',
        'DepartmentId', 'LoginName', 'DisplayName', 'Culture', 'DistinguishedName'];

}