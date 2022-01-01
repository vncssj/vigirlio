<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
 
	public function initialize(array $config)
	{
	  $this->table('gym_member');
	}
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'um nome de usuario é obrigatório')
            ->notEmpty('password', 'A senha é obrigatória')
            ->notEmpty('role', 'A role is required');            
    }
}