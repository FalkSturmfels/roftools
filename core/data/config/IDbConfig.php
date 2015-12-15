<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 15.12.2015
 * Time: 21:55
 */

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 12.11.2015
 * Time: 21:50
 */
interface IDbConfig
{
    /**
     * @param $fileName
     */
    public function setConfigFile($fileName);

    /**
     * @return mixed
     */
    public function getHost();

    /**
     * @return mixed
     */
    public function getDbName();

    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @return mixed
     */
    public function getPw();
}