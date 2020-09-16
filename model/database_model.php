<?php
/**
 * Created by PhpStorm.
 * User: Аня
 * Date: 15.09.2020
 * Time: 10:42
 */

namespace model;

use \PDO;

class database_model extends default_model
{

    const timedate_format='Y-m-d H:i:s';

    /**
     * @return PDO
     */
    protected function dbh()
    {
        $dbh = $this->get_data(['sys', 'pdo_dbh']);
        if (empty($dbh)) {
            $dbh = new PDO(
                sprintf('mysql:host=%s;dbname=%s', $this->get_data(['option', 'db_host']), $this->get_data(['option', 'db_base'])),
                $this->get_data(['option', 'db_user']),
                $this->get_data(['option', 'db_password'])
            );
            $this->put_data(['sys', 'pdo_dbh'], $dbh);
        }
        return $dbh;
    }

    /**
     * Кэширование
     * @param $key
     * @return mixed
     */
    function cache($key)
    {
        $dbh = $this->dbh();
        $stmt = $dbh->prepare("SELECT * from cache where `key`=? and `time` >? ");
        $stmt->execute([$key, date(self::timedate_format, strtotime('+0 hours'))]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function cache_put($key, $value, $expire = '+1 hours')
    {
        $dbh = $this->dbh();
        $stmt = $dbh->prepare("insert into cache set `key`=?, `time`=?, cache=? on duplicate key update `time`=VALUES(`time`), `cache`=VALUES(`cache`)");
        $stmt->bindParam(1, $key);
        $stmt->bindParam(2, date(self::timedate_format, strtotime($expire)));
        $stmt->bindParam(3, $value, PDO::PARAM_LOB);
        $stmt->execute();
    }

    /**
     * сохранение результатов поиска
     */
    function storeresult($text, $uri, $reason, $result)
    {
        $dbh = $this->dbh();
        $stmt = $dbh->prepare("select id from search_try where `uri`=? and `date`>? and `reason`=? and `text`=?");
        $stmt->execute([$uri, date(self::timedate_format, strtotime('-1 hours')), $reason, $text]);
        if ($res = $stmt->fetch()) return;

        $stmt = $dbh->prepare("INSERT INTO search_try (`uri`,`date`,`reason`,`text`) VALUES(?,?,?,?)");
        $stmt->execute([$uri, date(self::timedate_format, strtotime('+0 hours')), $reason, $text]);
        $lastid = $dbh->lastInsertId();
        $stmt = $dbh->prepare("INSERT INTO search_result (`id`,`foundtext`) VALUES(?,?)");
        if (!is_array($result)) {
            $stmt->execute([$lastid, $result]);
        } else if (!empty($result)) {
            foreach ($result as $r)
                $stmt->execute([$lastid, $r]);
        }
    }

    /**
     * поиск результатов по набору ключей
     */
    function findresult($timestamp)
    {
        $dbh = $this->dbh();
        $stmt = $dbh->prepare("select * from search_try where `date`>? order by `date` desc limit 10");
        $stmt->execute([date(self::timedate_format, strtotime($timestamp))]);
        $res = $stmt->fetchAll();
        if (!empty($res)) {
            foreach ($res as &$r) {
                $stmt = $dbh->prepare("select foundtext as found from search_result where id=?");
                $stmt->execute([$r['id']]);
                $r['found'] = $stmt->fetchAll();
            }
        }

        return $res;
    }

}