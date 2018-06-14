<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Animai Entity.
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $sexo
 * @property \Cake\I18n\Time $data_nasc
 * @property string $raca
 * @property string $pelagem
 * @property string $localizacao
 * @property string $status_2
 * @property string $link_video
 * @property string $foto_1
 * @property string $foto_2
 * @property string $foto_3
 * @property string $foto_4
 * @property string $geneologia
 * @property float $valor
 * @property int $parcelas
 * @property \Cake\I18n\Time $data_leilao_ini
 * @property \Cake\I18n\Time $data_leilao_fim
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Animai extends Entity
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
