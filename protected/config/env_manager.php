<?php

/**
 * This file is a configuration manager that will allow this codebase to run in
 * a multi-server environment and to change environments without friction.
 *
 * @author Pierce Moore <me@prex.io>
 */
$env = getenv('YOUTOO_ENVIRONMENT');

class Config{}

$config = new Config();

switch($env) {
  case "aws-staging":
    $config->db_name = "ytt_laliga_stage";
    $config->db_user = "yii";
    $config->db_pass = "n)/xC$724P)9m#43;,N32t),q.83JR";
    $config->db_host = "172.31.9.134";
    $config->db_port = 3306;
    $config->db_prefix = "ytt_";
    $config->memcached_host = "127.0.0.1";
    $config->memcached_port = 11211;
    break;
  case "aws-development":
    $config->db_name = "ytt_laliga_dev";
    $config->db_user = "yii";
    $config->db_pass = "n)/xC$724P)9m#43;,N32t),q.83JR";
    $config->db_host = "172.31.9.134";
    $config->db_port = 3306;
    $config->db_prefix = "ytt_";
    $config->memcached_host = "127.0.0.1";
    $config->memcached_port = 11211;
    break;
  case "aws-eu-production":
    $config->db_name = "ytt_laliga";
    $config->db_user = "yii";
    $config->db_pass = "n)/xC$724P)9m#43;,N32t),q.83JR";
    $config->db_host = "youtooeudb.csaowsgjja9a.eu-west-1.rds.amazonaws.com";
    $config->db_port = 3306;
    $config->db_prefix = "ytt_";
    $config->memcached_host = "youtoo-eu.bkavji.0001.euw1.cache.amazonaws.com";
    $config->memcached_port = 11211;
    break;
  case "aws-production":
  default:
    $config->db_name = "ytt_laliga";
    $config->db_user = "yii";
    $config->db_pass = "n)/xC$724P)9m#43;,N32t),q.83JR";
    $config->db_host = "strategicgamingus.coz6nx9zzwhf.us-east-1.rds.amazonaws.com";
    $config->db_port = 3306;
    $config->db_prefix = "ytt_";
    $config->memcached_host = "youtoo.xmuhnx.0001.use1.cache.amazonaws.com";
    $config->memcached_port = 11211;
    break;
}

return $config;