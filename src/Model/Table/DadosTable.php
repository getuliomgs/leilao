<?php
namespace App\Model\Table;

use App\Model\Entity\Dado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dados Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class DadosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('dados');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('nome_razao', 'create')
            ->notEmpty('nome_razao');

        $validator
            ->requirePresence('cpf_cnpj', 'create')
            ->notEmpty('cpf_cnpj');

        $validator
            ->date('data_nasc')
            ->requirePresence('data_nasc', 'create')
            ->notEmpty('data_nasc');

        $validator
            ->allowEmpty('tel');

        $validator
            ->allowEmpty('cel');

        $validator
            ->allowEmpty('cep');

        $validator
            ->allowEmpty('logradouro');

        $validator
            ->allowEmpty('numero');

        $validator
            ->allowEmpty('complemento');

        $validator
            ->allowEmpty('bairro');

        $validator
            ->allowEmpty('estado');

        $validator
            ->allowEmpty('cidade');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        return $rules;
    }
}
