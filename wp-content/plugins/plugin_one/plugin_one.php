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

/*Sobre as Actions*/
/*
    add_action('action_name', 'function', 'prioridade');
*/

//Necessario utilizar a função wp_footer()
add_action('wp_footer', 'pone_google_tracking_code');

function pone_google_tracking_code(){
    ?>
        <!-- Código do google Analytics -->
    <?php
}

/*Sobre Filtros*/
add_filter('the_content', 'pone_alter_the_content');

function pone_alter_the_content($content){
    return $content . "<br/><p>Todos os direitos reservados a Celso André</p> ";
}

add_filter('the_title', 'pone_custom_title');

function pone_custom_title($title){
    return $title ." - por Celso André";
}