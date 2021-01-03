<?php 

/**
 * Category post
 */
// Creating Shortcodes to display posts from category
function nodescorp_category_post($attr, $content = null){
 
    global $post;
 
    // Defining Shortcode's Attributes
    $shortcode_args = shortcode_atts(
        array(
                'cat'    => '',
                'num'    => '50',
                'orderby'  => 'DESC'
        ), $attr);  
     
    // array with query arguments
    $args = array(
            'cat'            => $shortcode_args['cat'],
            'posts_per_page' => $shortcode_args['num'],
            'orderby'          => $shortcode_args['orderby']
             
         );
 
    $recent_posts = get_posts($args);

    $output .= '<div class="cat-post-section">';
 
        foreach ($recent_posts as $post) :
             
            setup_postdata($post);

            $output .= '<div class="single-cat-post">';

                $output .= '<div class="single-cat-post-row1">';
 $output .= '<div class="inner-cat-post-row1">';
 
 					$output .= '<div class="current-salary-col">';
                        $output .= '<div class="current-salary">';
                            $output .= '<h3>Current Salary</h3>';
                            $output .= get_field('current_salary'); 
                        $output .= '</div>';
                    $output .= '</div>';
 
 
                    $output .= '<div class="post-img-col">';
                        $output .= get_the_post_thumbnail( $post, 'post-thumbnail');
                        $output .= '<h3>'.get_the_title().'</h3>'; 
                    $output .= '</div>';

                    $output .= '<div class="post-resume-col">';

                        $output .= '<div class="post-resume">';
                            $output .= '<a target="_blank" href="'.get_field('resume_link').'"><img src="/wp-content/uploads/2020/12/Screenshot_8.jpg"></a>';
                            $output .= '<a target="_blank"  href="'.get_field('resume_link').'">View Resume</a>';
                        $output .= '</div>';

                    $output .= '</div>';

                $output .= '</div>';
            $output .= '</div>';

                $output .= '<div class="single-cat-post-row2">';
                	$output .= '<h3>'.get_field('sub_title').'</h3>';
               
                    $output.= apply_filters( 'the_content', $post->post_content );
				$output .= '</div>';
                
                				ob_start();

    			comments_template('/comments.php', true);

    $output .= ob_get_contents();

    ob_clean();

            $output .= '</div>';
     
        endforeach; 
         
        wp_reset_postdata();

    $output .= '</div>';
     
    return $output;
 
}
 
add_shortcode( 'catPost', 'nodescorp_category_post' );

add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
return $_SERVER["HTTP_REFERER"];
}
