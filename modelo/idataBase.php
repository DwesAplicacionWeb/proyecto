<?php
abstract class idataBase
{
    abstract function  conectaDb();
    abstract function  desconectar();
    abstract function  ejecutarSql($sql);
    abstract function  ejecutarSqlActualizacion($sql, $args);
    abstract function ejecutarSqlArray($sql);
}
