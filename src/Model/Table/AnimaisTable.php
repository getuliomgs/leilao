<?php
namespace App\Model\Table;

use App\Model\Entity\Animai;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Animais Model
 *
 */
class AnimaisTable extends Table
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

        $this->table('animais');
        $this->displayField('nome');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        $validator
            ->allowEmpty('descricao');

        $validator
            ->requirePresence('sexo', 'create')
            ->notEmpty('sexo');

        $validator
            ->date('data_nasc')
            ->requirePresence('data_nasc', 'create')
            ->notEmpty('data_nasc');

        $validator
            ->requirePresence('raca', 'create')
            ->notEmpty('raca');

        $validator
            ->allowEmpty('pelagem');

        $validator
            ->allowEmpty('localizacao');

        $validator
            ->requirePresence('status_2', 'create')
            ->notEmpty('status_2');

        $validator
            ->allowEmpty('link_video');

        $validator
            ->allowEmpty('foto_1');

        $validator
            ->allowEmpty('foto_2');

        $validator
            ->allowEmpty('foto_3');

        $validator
            ->allowEmpty('foto_4');

        $validator
            ->allowEmpty('geneologia');

        $validator
            ->decimal('valor')
            ->allowEmpty('valor');

        $validator
            ->integer('parcelas')
            ->allowEmpty('parcelas');

        $validator
            ->dateTime('data_leilao_ini')
            ->allowEmpty('data_leilao_ini');

        $validator
            ->dateTime('data_leilao_fim')
            ->allowEmpty('data_leilao_fim');

        return $validator;
    }
}
