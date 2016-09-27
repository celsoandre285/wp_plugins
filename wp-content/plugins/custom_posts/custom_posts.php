<?php
/*
Plugin Name: Exemplo de uso de custom posts e custom taxonomies
Description: este plugin exemplifica como utilizar o custom posts e as custom taxonomies
Author: Celso André
Version: 1.0
Author URI: https://github.com/celsoandre285/wp_plugins
*/

add_action('init', 'my_custom_post_product');

function my_custom_post_product(){
    //Nome Singular
    $nome  = "produto";
    //Nome Plural
    $nomes = "produtos";
    /**/
    $labels = array(
        'name'           => $nomes,
        'singular_name'  => $nome,
        'add_new'        => 'adicionar novo',
        'add_new_item'   => 'adicionar novo ' . $nome,
        'edit_item'      => 'Editar '.$nome,
        'new_item'       => 'novo '.$nome,
        'view_item'      => 'inspecionar '.$nome,
        'search_items'   => 'Buscar '.$nome,
        'not_found'      => $nome . ' nao encontrado'
        
    );
    /**/
    $suporte = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'custom-fields',
        'comments',
    );
    
    /**/
    $args   = array(
        'public'       => true,
        'labels'       => $labels,
        'has_archive'  =>true,
        'menu_posicion'=>5,
        'supports'     =>$suporte
        
    );
    /**/
    register_post_type('produto', $args);
}


/*Mensagens de atualização*/
add_filter('post_updated_messages', 'my_updated_messages');

function my_updated_messages($messages){
    global $post_ID;
    
    $messages['produto'] = array(
        0 =>'',
        1 =>'Produto atualizado. <a href="'.esc_url(get_permalink($post_ID)).'">Visualizar Post</a>'
    );
    return $messages;
}

/**/
add_action('contextual_help','my_contextual_help', 10, 3 );

function my_contextual_help($contextual_help, $screen_id, $screen){
    if('edit-produto'==$screen->id){
        $contextual_help = '<h2>Produtos</h2>
        <p>Texto de Auxilia, Este texto deverá ajudar o usuario</p>';    
    }else if('produto'==$screen->id){
        $contextual_help = '<h2>Produtos 2</h2>
        <p>Texto de Auxilia, Este texto deverá ajudar o usuario</p>';    
    }
    
    return $contextual_help;
}