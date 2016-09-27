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

/*Trabalhando com Contextual help*/
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

/*Adicionando Boxes aos posts*/
add_action('add_meta_boxes','produto_preco_box');
function produto_preco_box(){
    add_meta_box(
        'produto_preco_box',          /*id*/
        'Preço do Produto',           /*Titulo*/
        'produto_preco_box_content',  /*A Função*/
        'produto',                    /*tipo do post*/
        'side',                       /*Posição*/
        'low'                         /*Prioridade*/
    );
}

function produto_preco_box_content( $post ){
    /*Retornando o valor do Banco*/
    $preco =  get_post_meta(get_the_ID(), 'produto_valor', true);
    ?>
    
        <label for="produto_preco"></label>
        
        <input type="text" id="produto_preco" name="producto_preco" placeholder="insira o valor!" value="<?php echo $preco; ?>"/>
        
    <?php
}


add_action('save_post','produto_preco_box_save');

function produto_preco_box_save( $post_id ){
    /*Parando o Autosave*/
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    /*Verificando o post e permissão do usuario*/
    if('produto' != get_post_type() || !current_user_can('edit_post', $post_id) )
        return;
    /*Recuperando valor digitado*/
    $produto_valor = $_POST['producto_preco'];
    /*salvando no banco!*/
    update_post_meta($post_id, 'produto_valor', $produto_valor  );
}