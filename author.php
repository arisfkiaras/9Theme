<?php  get_header(); ?>
<?php
        //can call curauth->get description and shit
        if(isset($_GET['author_name'])) :
            $curauth = get_userdatabylogin($author_name);
        else :
            $curauth = get_userdata(intval($author));
        endif;
    ?>
<div id="container">
    <div id="main">
        <div id="posts">
            <div id="PageTitleBox"><div id="PageTitle">Uploads by <?php echo $curauth->nickname ?></div></div>
            <div id="postslist">

            <?php $yo=$curauth->ID;  query_posts('author='.$yo.'&paged=' . get_query_var('paged'));?>
               <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div id="singlepost">
                        <div id="posttitle">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                    <div id="postcontent">
                        <a href="<?php the_permalink(); ?>"><?php the_content(); ?></a>
                    </div>
                    <div id="postdata">
                        <div id="stats"><a id=<?php echo '"score ' . get_the_ID() . '"'; ?>><?php $scored=get_post_meta(get_the_ID(),'postscore',true);if($scored==""){echo 0;}else{echo $scored;} ?></a> points - <?php comments_number( 'No comments', 'One comment', '% comments' ); ?>
                            <div id="tags"> <?php the_tags( 'Tags:', ',', '' ); ?> </div>
                        </div>
                        <div class="vote">
                            <?php if (is_user_logged_in()) {?>
                                <?php $hasivote=checkvote(get_the_ID()); if($hasivote=='-1'){?>
                                    <li><a id=<?php echo '"upvoteicon ' . get_the_ID() . '" '; ?>class="voteup" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,1);"></a></li>
                                    <li><a id=<?php echo '"downvoteicon ' . get_the_ID() . '" '; ?>class="votedown" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,2);"></a></li>
                                <?php }elseif($hasivote=='0'){?>
                                    <li><a id=<?php echo '"upvoteicon ' . get_the_ID() . '" '; ?>class="voteup" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,1);"></a></li>
                                    <li><a id=<?php echo '"downvoteicon ' . get_the_ID() . '" '; ?>class="votedownactive" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,0);"></a></li><?php }else{ ?>
                                    <li><a id=<?php echo '"upvoteicon ' . get_the_ID() . '" '; ?> class="voteupactive" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,0);"></a></li>
                                    <li><a id=<?php echo '"downvoteicon ' . get_the_ID() . '" '; ?>class="votedown" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,2);"></a></li>
                                <?php } ?>
                            <?php }else{ ?>
                                <li><a id=<?php echo '"upvoteicon ' . get_the_ID() . '" '; ?>class="voteup" href="javascript:void(0);" onclick="jQuery('#show_login').click();"></a></li>
                                <li><a id=<?php echo '"downvoteicon ' . get_the_ID() . '" '; ?>class="votedown" href="javascript:void(0);" onclick="jQuery('#show_login').click();"></a></li>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php endwhile; else: ?>
                <?php _e('It seems there are no posts here.'); ?></p>
            <?php endif; ?>
        </div>
            <div id="Paging">
                <div id="NewerPages"><?php previous_posts_link('&laquo; Newer Posts') ?></div>
                <div id="OlderPages"><?php next_posts_link('Older Posts &raquo;') ?></div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>
