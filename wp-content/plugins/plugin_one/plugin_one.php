<?php
/*
Plugin Name: Plugin One
Description: Meu primeiro plugin
Author: Celso André
Version: 1.0
Author URI: https://github.com/celsoandre285/wp_plugins
*/

/*Adicionando e registrando um novo menu*/
add_action('admin_menu', 'pone_register_menus');

/*Criando um novo menu no dashbord do wordpress*/
function pone_register_menus(){
    add_options_page('Plugin One',      /*titulo da pagina*/
                     'Hello World',     /*Titulo do menu*/
                     'manage_options',  /*permissão de visualização*/
                     'pone_hello_page', /*identificador unico - Slug*/
                     'pone_render_page' /*função de renderizar pagina*/
                     );
}

/*Função para renderizar pagina dentro do menu*/
function pone_render_page(){
    ?>
        <div class="wrap">
            <h2>Hello World</h2>
            <p class="description">Seja bem vindo ao Painel do Wordpress</p>
        </div>
    <?php
}



