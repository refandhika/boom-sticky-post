<?php 
/**
*
* Post on desktop view template.
*
* @author 	Jeroen Sormani
* @package 	Boombastis Sticky Post/Templates
* @version 	1.0.0
*
*/

if ( !defined( 'ABSPATH' ) ) exit; //Refuse direct access
?>

<div class="sticky-post">
	<h1 style="font-family: Gotham; font-size: 44px; font-weight: bold; line-height: 1.2;  margin-bottom: 0;  margin-top: 10px;"><?php echo get_the_title($GLOBALS['StickyID']); ?></h1>
	<?php if (function_exists('the_subtitle')) { ?>
		<p style="font-family: Gotham;font-size: 14px; padding: 0 10px; line-height: 1.5;">
			<?php echo get_the_subtitle($GLOBALS['StickyID']); ?>			
		</p>
	<?php } ?>
	<img src="<?php $post_thumbnail= wp_get_attachment_url( get_post_thumbnail_id($GLOBALS['StickyID'])  );
      		if ( strlen($post_thumbnail) ) { 
				echo $post_thumbnail;
			}   ?>" width="100%">
	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--8-col mdl-cell--4-col-tablet  mdl-cell-4-col-phone">
			<div class="author">oleh <?php echo get_author_name(get_post_field('post_author',$GLOBALS['StickyID'])); ?>
				<div class="fb-share-button" 
					data-href=<?php echo get_the_permalink($GLOBALS['StickyID']); ?> 
					data-layout="button_count">
				</div>
			</div>
			<div class="infotgl"><?php echo get_the_time('H:i A ', $GLOBALS['StickyID']); ?> on <?php echo get_the_time( ' M j, Y' , $GLOBALS['StickyID']); ?></div> 
		</div>
	
		 <!-- Load Facebook SDK for JavaScript -->
		  <div id="fb-root"></div>
		  <script>(function(d, s, id) {
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) return; 
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
		    fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));</script>
		<!--<script type="text/javascript">
		jQuery(document).ready(function($){
	      $.ajax({
	          url: 'https://image.boombastis.com/sosstats/getfbshare.php?permalink=<?php ?>',
	          dataType: 'html',
	          success: function(html) {
	            document.getElementById('postsharenct').style.display='block';
	            $('#postsharenct').html(html+' share');
	          }  
	      }); 
	    }); 
		</script>-->
		<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell-4-col-phone" style="text-align: right;">
			<a  onclick="hitungfb();" style="cursor:pointer; border-radius:7px;">
			  <img src="https://image.boombastis.com/img/desktop/fb.png" width="30" style="border-radius:7px;" class="gtm-share-fb">
			</a>
			<a href="https://plus.google.com/share?url=<?php echo get_the_permalink($GLOBALS['StickyID']); ?>?utm_source=Google%2B%26utm_medium=Social-Share%26utm_campaign=Social-Share" style="border-radius:7px;">
			  <img src="https://image.boombastis.com/googleplus.png"  width="30" style="border-radius:7px;" class="gtm-share-gplus">
			</a>
			<a href="https://twitter.com/intent/tweet?text=<?php echo get_the_permalink($GLOBALS['StickyID']); ?>?utm_source=Twitter%26utm_medium=Social-Share%26utm_campaign=Social-Share" style="border-radius:7px;">
			  <img src="https://image.boombastis.com/img/desktop/Twitter_Logo_White_On_Blue.png"  width="30" style="border-radius:7px;" class="gtm-share-tw">
			</a>
			<!--<div id="postsharenct" style="float:right;display: block;padding: 4px 10px;border-radius: 4px;margin-right: 100px;">-->
				
			<!--</div>-->
			<div style="clear:both;"></div>
			<!--<div class="mdl-grid date-views">
				<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell-4-col-phone">
					<div id="postview<?php echo $GLOBALS['StickyID']; ?>" class="post-view"></div>
					<i class="material-icons grey">&#xE8F4;</i>
				</div>
				<script>
				jQuery(document).ready(function($){get_post_view('<?php echo $GLOBALS['StickyID'];?>');});
				</script>
			</div>-->			
		</div>
	</div>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
			$isi = get_post_field('post_content', $GLOBALS['StickyID']);				
			$isi = apply_filters( 'the_content', $isi );
		    $isi = str_replace( ']]>', ']]&gt;', $isi ); 
		    $isi = preg_replace('@style="([^"]+)"@', '', $isi);
			$isi = preg_replace('(href=)', 'target="_blank" rel="nofollow" href=', $isi);
			$format = get_post_meta($GLOBALS['StickyID'], "mvp_boombastis_post_format", true);
			if ($page<$numpages) {
				$next_page=$page+1;
				$next_page_link='<a href="'.get_permalink().'/'.$next_page.'" class="pagination-next-prev">Next</a>';
				$nextprev_p=' <a href="'.get_permalink().'/'.$next_page.'" class="last-p">Next</a>';
			}
			if ($page==$numpages) {
				$nextPostObj=get_next_post();
	    		if (!empty($nextPostObj )){
	    			$nextprev_p= get_permalink( $nextPostObj->ID );
		    		$nextprev_p = ' <a href="'.$nextprev_p.'" class="last-p" >Next</a>';
	    		} else {
	    			$nextPostObj=get_previous_post();
	    			$nextprev_p= get_permalink( $nextPostObj->ID );
		    		$nextprev_p = ' <a href="'.$nextprev_p.'" class="last-p" >Prev</a>';
	    		}								
				$next_page_link='';	
			}
			/*$i=1;
			$bacajugainlink='';
			foreach ($posts_array as $key => $value) {
				if($GLOBALS['StickyID']!=$value->ID){
					if($i==1) {
						$bacajugainlink=$bacajugainlink.'<div data-advs-adspot-id="OTk5OjEzMTQ0" style="display:none"></div>
						<div class="rec-article-cont">
							<a class="ajudul" href="'.get_permalink($value->ID).'">'.get_the_title($value->ID).'</a>
						</div>';
					} elseif($i==2) {
						$bacajugainlink=$bacajugainlink.'<div class="rec-article-cont">
							<a class="ajudul" href="'.get_permalink($value->ID).'">'.get_the_title($value->ID).'</a>
						</div>';
						break;
					}
					$i++;
				}
			}
			$bacajugain='<div class="rec-article">
					<div class="rec-article-title">Baca Juga</div>'.
					$bacajugainlink.'
				</div>';*/
			#$adslota='<!-- Async AdSlot 2 for Ad unit "Desktop_Article_IndonesiaBanget" ### Size: [[300,250]] -->
			#	<!-- Adslots refresh function: googletag.pubads().refresh([gptadslots[1]]) -->
			#	<div id="div-gpt-ad-8479972-2">
			#	  <script>
			#	  	document.body.addEventListener("mdl-componentupgraded", function (event) {
			#			if (event.target.className.split(" ").indexOf("mdl-js-layout") < 0) {return;};
			#	        googletag.cmd.push(function() { googletag.display("div-gpt-ad-8479972-2"); });
			#		});
			#	  </script>
			#	</div>
			#	<!-- End AdSlot 2 -->';
			$adslota='';
			$adslotb='';
			#$adslotb='<div class="in-article-ads">
			#		<!--  ad tags Size: 300x250 ZoneId:1208437-->
			#		<script type="text/javascript" src="https://js.genieessp.com/t/208/437/a1208437.js"></script>
			#	</div>';
			$keywords = explode('</p>', $isi);
			$bqflag = false;
			$pc=0;
			for ($i=0;$i<count($keywords);$i++){
				if (strpos($keywords[$i], '<blockquote') !== false) {
					$bqflag = true;
				}
				if ($bqflag === false){
					if ($pc==1) {
						#$keywords[$i] = $keywords[$i].$bacajugain;
					} elseif ($pc==2) {
						$keywords[$i] = $keywords[$i].$adslotb;
					}
					$pc++;
				}
				if (strpos($keywords[$i], '</blockquote') !== false) {
					$bqflag = false;
				}
			}
			$isi=implode('</p>', $keywords);
			$isi=preg_replace("(image\.boombastis\.com\/images)","d1e3uqeqtqrv1j.cloudfront.net/wp-content/uploads",$isi);
			$isi=$isi.$nextprev_p;
			switch ($format) {
				case 'general':							
					$isi='<div style="float:left; margin-right:15px; margin-top:5px;">'.$adslota.'</div>'.$isi;
					break;	
				case 'step' :
					$arrh2=explode('<h2>', $isi);
					foreach ($arrh2 as $key => $value) {
						if($key>0) {
							$posisi_titik=strpos($value, '.');
							$value=substr_replace($value, '</span>', $posisi_titik+1, 0);
							$arrh2[$key]='<h2  class="step-h2 m-t-3 m-b-1"><span class="step-number">'.$value;
						}
					}
					$isi=implode('', $arrh2);
					$letakp1=strpos($isi, '</p>');
					$isi=substr_replace($isi, '</p><div style="float:left; margin-right:15px; margin-top:5px;">'.$adslota.'</div>', $letakp1, 0);
					// letakkan iklan ke 2
					$arrimg=explode('</figure>', $isi);
					foreach ($arrimg as $key => $value) {
						if($key==3) {
							$arrimg[$key]=$value.'</figure>
							<div class="iklan-cnt">'.$adslota.'</div>';
						} else {
							$arrimg[$key]=$value.'</figure>';
						}
					}
					$isi=implode('', $arrimg);
					break;	
				case 'tips' :
					$isi = preg_replace('(<h2>)', '<h2 class="step-h2  m-t-3 m-b-1"><span class="toggle-title">', $isi);
					$isi = preg_replace('(<\/h2>)', '</span><span class="toggle-arrow">&gt;</span></h2>', $isi);
					$letakp1=strpos($isi, '</p>');
					$isi=substr_replace($isi, '</p><div style="float:left; margin-right:15px; margin-top:5px;">'.$adslota.'</div>', $letakp1, 0);
					//letakkan iklan ke 2
					$arrimg=explode('</figure>', $isi);
					foreach ($arrimg as $key => $value) {
						if($key==3) {
							$arrimg[$key]=$value.'</figure>
							<div class="iklan-cnt">'.$adslota.'</div>';
						} else {
							$arrimg[$key]=$value.'</figure>';
						}
					}
					$isi=implode('', $arrimg);
					break;	
				case 'photonews' :									
					preg_match_all('(<img.*\/>)', $isi, $matches);
					if (count($matches[0])==0){	 ?>
						<img src="<?php 
						if ( has_post_thumbnail($GLOBALS['StickyID']) ) {
							$thumb_url= wp_get_attachment_url(get_post_thumbnail_id($GLOBALS['StickyID']));
							if ($thumb_url!==false) {
								echo $thumb_url;
							} 
						}  ?>"
					      layout="responsive"
					      width="100%" 
					      alt="<?php echo get_the_title($GLOBALS['StickyID']); ?>"
					      attribution="<?php echo get_the_title($GLOBALS['StickyID']); ?>" />
					      <ul class="photo-pagination">
					      	<?php photo_link_pages(); ?>
					      </ul>
					      <div class="clearfix"></div>
						<?php
					}  else {
						print_r($matches[0][0]); ?>
						<ul class="photo-pagination">
					      	<?php photo_link_pages(); ?>
					    </ul>
					    <div class="clearfix"></div> <?php 
					    $isi = preg_replace('(<img.*\/p>)', '', $isi);
					}
					$isi='<div class="general">'.$isi.'</div>';
					break;
				case 'advetorial':
					break;
				case 'ugc':
					$isi='<div class="general">'.$isi.'</div>';
					break;
				default:
					$isi='<div style="float:left; margin-right:15px; margin-top:5px;">'.$adslota.'</div>'.$isi;
					break;
			}					
			if ($format!='advetorial'||$format!='ugc') {
				// tambah iklan di h2 ke 4
				$arrh2=explode('</h2>', $isi); 					
				if (count($arrh2)>4) {
					$arrh2[4]='<div class="iklan-cnt"></div>'.$arrh2[4];
					$isi=implode('</h2>', $arrh2);
				}	
			}
			print_r($isi);
			if ($format!='advetorial'||$format!='ugc') { ?>							
			<?php } ?>
		</article>
	<nav class="pagination-cnt"><?php 
	    wp_link_pages([
	    	'before'           => '',
	        'after'            => '',
	        'link_before'      => '<span class="mdl-chip"><span class="mdl-chip__text">',
	        'link_after'       => '</span></span>',
	        'next_or_number'   => 'number',
	        'separator'        => '',
	        'nextpagelink'     => 'Berikutnya',
	        'previouspagelink' => 'Sebelumnya',
	        'pagelink'         => '%',
	        'echo'             => 1
	    ]); ?>
	</nav>
	<div style="clear: both; text-align: left; margin-bottom:30px;">						
		<a  onclick="hitungfb();" style="cursor: pointer;">
		  <img src="https://image.boombastis.com/img/desktop/fb.png" width="30" style="border-radius:7px;" class="gtm-share-fb">
		</a>
		<a href="https://plus.google.com/share?url=<?php echo get_the_permalink($GLOBALS['StickyID']); ?>?utm_source=Google%2B%26utm_medium=Social-Share%26utm_campaign=Social-Share" >
		  <img src="https://image.boombastis.com/googleplus.png"  width="30" style="border-radius:7px;" class="gtm-share-gplus">
		</a>
		<a href="https://twitter.com/intent/tweet?text=<?php echo get_the_permalink($GLOBALS['StickyID']); ?>?utm_source=Twitter%26utm_medium=Social-Share%26utm_campaign=Social-Share" >
		  <img src="https://image.boombastis.com/img/desktop/Twitter_Logo_White_On_Blue.png"  width="30" style="border-radius:7px;" class="gtm-share-tw">
		</a>
		<div style="clear:both;"></div>						
	</div>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/id_ID/all.js#xfbml=1"></script>
	<fb:comments href="<?php echo get_the_permalink($GLOBALS['StickyID']); ?>" width="100%"></fb:comments>
</div>