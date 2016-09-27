<?php
/*
Plugin Name: Plugin One
Description: Meu primeiro plugin
Author: Celso André
Version: 1.0
Author URI: https://github.com/celsoandre285/wp_plugins
*/
/*Caminho relativo, permite inserir arquivos extras(css, js, etc)*/
define ('PONE_URL', plugins_url('', __FILE__));
/*Caminho completo(fisico) , até o diretorio do plugin*/
define ('PONE_DIR',plugin_dir_path( __FILE__ ) );


/*adicionando o caminho para outros arquivos */
require_once(PONE_DIR.'admin.php');