<?php
abstract class IDataBase
{
    abstract function  conectaDb();
    abstract function  desconectar();
    abstract function  ejecutarSql($sql);
    abstract function  ejecutarSqlActualizacion($sql, $args);
    abstract function ejecutarSqlArray($sql);
}
