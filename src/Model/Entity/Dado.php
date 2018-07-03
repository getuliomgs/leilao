<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dado Entity.
 *
 * @property int $id
 * @property int $users_id
 * @property \App\Model\Entity\User $user
 * @property string $nome_razao
 * @property string $cpf_cnpj
 * @property \Cake\I18n\Time $data_nasc
 * @property string $tel
 * @property string $cel
 * @property string $cep
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $estado
 * @property string $cidade
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Dado extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
