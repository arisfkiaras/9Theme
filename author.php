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
			<div id="TagTitle">Uploads by<?php echo $curauth->nickname ?></div>
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
						<div id="stats">900 points - <?php comments_number( 'No comments', 'One comment', '% comments' ); ?>
							<div id="tags"> <?php the_tags( 'Tags:', ',', '.' ); ?> </div>
						</div>
						<div class="vote">
							<li><a class="voteup" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,1);"></a></li>
							<li><a class="votedown" href="javascript:void(0);" onclick="vote(<?php echo get_the_ID(); ?>,2);"></a></li>
						</div>
					</div>
				</div>

			<?php endwhile; else: ?>
				<?php _e('It seems there are no posts here.'); ?></p>
			<?php endif; ?>

			<div id="Paging">
				<div id="NewerPages"><?php previous_posts_link('&laquo; Newer Entries') ?></div>
				<div id="OlderPages"><?php next_posts_link('Older Entries &raquo;') ?></div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
