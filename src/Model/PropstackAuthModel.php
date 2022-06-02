<?php

namespace Oveleon\ContaoPropstackApiBundle\Model;

use Contao\Model;

/**
 * Reads and writes Propstack auth keys
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $key
 * @property boolean $restrictIp
 * @property boolean $restrictHost
 * @property string  $allowedIps
 * @property string  $allowedHosts
 *
 * @method static PropstackAuthModel|null findById($id, array $opt=array())
 * @method static PropstackAuthModel|null findOneBy($col, $val, array $opt=array())
 * @method static PropstackAuthModel|null findOneByTstamp($val, array $opt=array())
 * @method static PropstackAuthModel|null findOneByKey($val, array $opt=array())
 *
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findByTstamp($val, array $opt=array())
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findByRestrictIp($val, array $opt=array())
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findByRestrictHost($val, array $opt=array())
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findMultipleByIds($var, array $opt=array())
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findBy($col, $val, array $opt=array())
 * @method static \Model\Collection|PropstackAuthModel[]|PropstackAuthModel|null findAll(array $opt=array())
 *
 * @method static integer countById($id, array $opt=array())
 * @method static integer countByTstamp($val, array $opt=array())
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class PropstackAuthModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_propstack_auth';
}
