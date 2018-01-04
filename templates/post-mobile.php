<?php 
/**
*
* Post on mobile view template.
*
* Modify the template to match theme used.
*
* @author 	Jeroen Sormani
* @package 	Boombastis Sticky Post/Templates
* @version 	1.0.0
*
*/

if ( !defined( 'ABSPATH' ) ) exit; //Refuse direct access
?>

<div class="sticky-post">
	<h1 style="font-family: Gotham; font-size: 22px; padding: 0 10px; font-weight: bold; margin-top: 10px; margin-bottom: 0;"><?php echo get_the_title($GLOBALS['StickyID']); ?></h1><?php 
	if (function_exists('the_subtitle')) { ?>
		<p style="font-family: Gotham;font-size: 14px; padding: 0 10px; line-height: 1.5;">
			<?php echo get_the_subtitle($GLOBALS['StickyID']); ?>
		</p>
	<img src="<?php echo get_the_post_thumbnail_url($GLOBALS['StickyID'], 'medium'); ?>" width="100%" height="auto">
	<?php } ?>
	<div id="postsharenct2" style="float:right;display: none;background: steelblue;padding: 4px 10px;border-radius: 4px;margin: 5px;color: #fff;font-weight: bold;"></div>
	<script type="text/javascript">
	jQuery(document).ready(function($){
	  $.ajax({
	      url: 'https://image.boombastis.com/sosstats/getfbshare.php?permalink=<?php echo get_the_permalink($GLOBALS['StickyID']); ?>',
	      dataType: 'html',
	      success: function(html) {
	        document.getElementById('postsharenct2').style.display='block';
	        $('#postsharenct2').html(html+' share');
	      }  
	  }); 
	}); 
	</script>
	<div class="author"><?php echo get_author_name(get_post_field('post_author',$GLOBALS['StickyID'])); ?></div>
	<div class="infotgl"><?php echo get_the_time('H:i A ', $GLOBALS['StickyID']); ?> on <?php echo get_the_time(' M j, Y', $GLOBALS['StickyID']); ?></div>
	<!--<div class="date-views">
		<div id="postview<?php echo $GLOBALS['StickyID']; ?>" class="post-view"></div>
		<i class="material-icons grey">&#xE8F4;</i>
		<script>
		jQuery(document).ready(function($){get_post_view('<?php echo $GLOBALS['StickyID'];?>');});
		</script>
	</div>-->
	<?php $format = get_post_meta($GLOBALS['StickyID'], "mvp_boombastis_post_format", true);
	if($format!='advetorial') { ?>
		<!--<script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
		<!-- Responsive Boombastis -->
		<!--<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-9926554266023886"
		     data-ad-slot="3938772884"
		     data-ad-format="horizontal"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>--><?php 
	} ?>	
	<article id="post-<?php echo $GLOBALS['StickyID']; ?>" <?php post_class(); ?>><?php  
		$isi = get_post_field('post_content', $GLOBALS['StickyID']);
		$isi = apply_filters( 'the_content', $isi );	
	    $isi = str_replace( ']]>', ']]&gt;', $isi ); 
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
				$bacajugainlink=$bacajugainlink.'<div class="rec-article-cont">
					<a class="ajudul" href="'.get_permalink($value->ID).'">'.get_the_title($value->ID).'</a>
				</div>';
				$i++;
				if($i==3) {break;}
			}
		}
		$i=1;
		$terkaitinlink='';
		$contextin  = stream_context_create([			
			'http' => [
			    'ignore_errors' => true,
			    'method' => 'POST',
			    'content' => http_build_query(['size' => 2]),
			    'header' => [
			      	0 => 'Content-Type: application/x-www-form-urlencoded',
			    ],
		  	],
		]);
		$responsein = file_get_contents(
		    'https://public-api.wordpress.com/rest/v1/sites/71359903/posts/'.$GLOBALS['StickyID'].'/related', false, $contextin
		);
		$relatedObjin=json_decode($responsein);		
		if(isset($relatedObjin->total)){
			foreach ($relatedObjin->hits as $key => $value) {
				if($GLOBALS['StickyID']!=$value->fields->post_id){
				$terkaitinlink=$terkaitinlink.'<div class="rec-article-cont">
					<a class="ajudul" href="'.get_permalink($value->fields->post_id).'">'.get_the_title($value->fields->post_id).'</a>
				</div>';
				$i++;
				if($i==3) {break;}
				}
			}
			// Insert Artikle Terkait To Box
			$terkaitin='<div class="rec-article">
					<div class="rec-article-title">Artikel Terkait</div>
					<!-- Ad Slot : Native Article Terkait -->
					<div data-advs-adspot-id="OTczOjE0MDA5" style="display:none"></div>'.
					$terkaitinlink.'
				</div>';
		}
		$bacajugain='<div class="rec-article">
				<div class="rec-article-title">Baca Juga</div>
				<div data-advs-adspot-id="OTk5OjEzMTQ0" style="display:none"></div>'.
				$bacajugainlink.'
			</div>';*/
		$adslotin1='<div class="rectangle-ads">
			<!-- Async AdSlot 3 for Ad unit "Mobile_Article_IndonesiaBanget" ### Size: [[300,250]] -->
			<!-- Adslots refresh function: googletag.pubads().refresh([gptadslots[2]]) -->
			<div id="div-gpt-ad-1556515-3">
			  <script>
			  	document.body.addEventListener("mdl-componentupgraded", function (event) {
					if (event.target.className.split(" ").indexOf("mdl-js-layout") < 0) {return;};
				    googletag.cmd.push(function() { googletag.display("div-gpt-ad-1556515-3"); });
				});
			  </script>
			</div>
			<!-- End AdSlot 3 -->
			</div>';
		$adslotin2='';
		#$adslotin2='<div class="slider-ads">
		#	<!--  ad tags Size: 300x250 ZoneId:1208440-->
		#	<script type="text/javascript" src="https://js.genieessp.com/t/208/440/a1208440.js"></script>
		#</div>';
		$keywords = explode('</p>', $isi);
		$bqflag = false;
		$pc=0;
		for ($i=0;$i<count($keywords);$i++){
			if (strpos($keywords[$i], '<blockquote') !== false) {
				$bqflag = true;
			}
			if ($bqflag === false){
				switch ($pc) {
				 	case 1:
						$keywords[$i] = $keywords[$i].$adslotin1;
						break;
					case 2:
						#$keywords[$i] = $keywords[$i].$bacajugain;
						break;
					case 4:
						$keywords[$i] = $keywords[$i].$adslotin2;
						break;
				 	default:
				 		break;
				}
				$pc++;
			}
			if (strpos($keywords[$i], '</blockquote') !== false) {
				$bqflag = false;
			}
		}
		$isi=implode('</p>', $keywords);
		$isi=preg_replace("(image\.boombastis\.com\/images)","d1e3uqeqtqrv1j.cloudfront.net/wp-content/uploads",$isi);
		$isi = $isi.$terkaitin.$nextprev_p;
		switch ($format) {
			case 'general':	
				break;	
			case 'step' :				
				// letakkan iklan ke 2
				$arrimg=explode('</figure>', $isi);
				foreach ($arrimg as $key => $value) {
					if($key==3) {
						$arrimg[$key]=$value.'</figure>';
					} else {
						$arrimg[$key]=$value.'</figure>';
					}
				}
				$isi=implode('', $arrimg);
				break;	
			case 'tips' :			
				//letakkan iklan ke 2
				$arrimg=explode('</figure>', $isi);
				foreach ($arrimg as $key => $value) {
					if($key==3) {
						$arrimg[$key]=$value.'</figure>';
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
			case 'ugc': 
				break;
			case 'advetorial': 
				break;
			default:			
				break;	
		}
		unset($arrh2);
		$arrh2=explode('</h2>', $isi); 
		if (count($arrh2)>4) {
			if ($format!='advetorial') {		
				// <!-- IKLAN KEDUA -->				
				$arrh2[4]=''.$arrh2[4];
				$isi=implode('</h2>', $arrh2);
			}
		}		
		print_r($isi);
		if ($format!='advetorial'||$format!='ugc') { ?>
			<?php 
		} ?>
	</article>
</div>