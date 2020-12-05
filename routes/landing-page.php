<?php 
  //to update catche from config
  $rw_cdn = app_get_config( 'custom', 'myconfigs', 'cdn_url' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
  <!-- Start Adding Cookie Consent -->
    <?php echo app_render_section('cookie-consent-style', array(),4); ?>
    <!-- Ends Adding Cookie Consent -->
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NW45RCT');</script>
  <!-- End Google Tag Manager -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rankwatch</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="<?php echo $rw_cdn; ?>/css-3gr/cdn-jQuery.mCustomScrollbar.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/2.8.1/jquery.mCustomScrollbar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" media="screen"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="%%__THEME_PATH__%%css/style-landing.css?catched1" rel="stylesheet" type="text/css" />
<link href="<?php echo $rw_cdn; ?>/css-3gr/slider.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $rw_cdn; ?>/js-3gr/bootstrap-slider.js" ></script>
<script src="%%__THEME_PATH__%%js/range-slider.js" ></script>
<script src="<?php echo $rw_cdn; ?>/js-3gr/vimeo_ga/vimeo.ga.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
            $('.detInfoBottom ul li').click(function(){
                $('.detInfoBottom ul li').removeClass('listing');
                $('.marginClass').css({'margin-left': '700px','display': 'none'});
                $(this).addClass('listing');
                var atr = $(this).attr('data-list');
                $('#'+atr).animate({'marginLeft': '0px'},400);
                $('#'+atr).css({'display': 'block'});

            });
             $('.left').click(function(){
                $('.detInfoBottom ul li').each(function(i) {
                    if($(this).hasClass('listing'))
                    {
                       if(i<1)
                        i=9;
                       var check =".list"+parseInt(i);
                       $('.detInfoBottom ul li').removeClass('listing');
                       $('.marginClass').css({'margin-left': '700px','display': 'none'});
                       $(check).addClass('listing');
                        var atr = $(check).attr('data-list');
                        $('#'+atr).animate({'marginLeft': '0px'},400);
                        $('#'+atr).css({'display': 'block'});
                         return false;
                    }

            });
            });
            $('.right').click(function(){
                $('.detInfoBottom ul li').each(function(i) {
                    if($(this).hasClass('listing'))
                    {
                        if(i>7)
                        i=-1;
                        var check1 =".list"+parseInt(i+2);
                        $('.detInfoBottom ul li').removeClass('listing');
                        $('.marginClass').css({'margin-left': '700px','display': 'none'});
                        $(check1).addClass('listing');
                        var atr = $(check1).attr('data-list');
                        $('#'+atr).animate({'marginLeft': '0px'},400);
                        $('#'+atr).css({'display': 'block'});
                        return false;
                    }

            });  
            });
            $('.detInfoBottom ul li').tooltip();
            $('#signUpSubmit').click(function(e)
            {
                txtEmailAddressValue = $('#email1').val();
                txtValue = $('#userName').val();
                txtphoneValue = $('#password').val();
                if (txtValue == '')
                {
                    alert('Please Enter User Name');
                    return false;
                }
                if(txtphoneValue == '')
                {
                     alert('Please Enter password');
                    return false;
                }
                if (txtEmailAddressValue == '')
                {
                    alert('Please Enter a email address');
                    return false;
                }
                else if (!IsValidEmail1(txtEmailAddressValue))
                    {
                        alert('Please Enter a valid email address');
                        return false;
                    }
                return true;
            });
               $("#requestDemo").mCustomScrollbar({theme:"dark",advanced:{
          normalizeMouseWheelDelta: true,
          updateOnContentResize:true,   
          updateOnBrowserResize:true   
      } });
        display_ct();
      <?php 
        if(isset($_COOKIE['rw'])){
          foreach ($_COOKIE['rw'] as $key=>$value) {
            foreach($_COOKIE['rw'][$key] as $key1=>$val1)
            {
              setcookie("rw[".$key."][".$key1."]", "", time() - 3600,"/",'.rankwatch.com');
            }
            setcookie("rw[".$key."]", "", time() - 3600,"/",'.rankwatch.com');
          }
        }
        if(!app_is_auth())
        {
          $oraganic = array('organic'); 
          if(isset($_GET['utm_source']))
          {
            $soruceVal = serialize($_GET);
            $val = $_GET['utm_source'];
          }
          else
          {
            $soruceVal = serialize($oraganic);
            $val = "organic";
          }
          $actions = "Landing ".app_get_action();
          $firstPage = serialize($actions);
          if(!isset($_COOKIE['rwc']['_landing']))
          {
          setcookie('rwc[_landing]['.$val.']', $soruceVal,time()+3600*24*365,'/','.rankwatch.com');
          }
          else
          {
              if(!in_array($soruceVal, $_COOKIE['rwc']['_landing']))
                  setcookie('rwc[_landing]['.$val.']', $soruceVal,time()+3600*24*365,'/','.rankwatch.com');
          } 
          $referer = '';
          if(isset($_SERVER['HTTP_REFERER']))
          {
            $referer = $_SERVER['HTTP_REFERER'];
            $parseUrl = parse_url($referer);
          } 
          if($parseUrl['host'] != $_SERVER['HTTP_HOST'] && $referer != '')
          {
            if(!isset($_COOKIE['rwc']['_referer']))
            {
                setcookie('rwc[_referer]['.$val.']', serialize($referer),time()+3600*24*365,'/','.rankwatch.com');
            }
            else
            {
                if(!in_array(serialize($referer), $_COOKIE['rwc']['_referer']))
                  setcookie('rwc[_referer]['.$val.']', serialize($referer),time()+3600*24*365,'/','.rankwatch.com');
            }
          }
          if(!isset($_COOKIE['rwc']['_firstP']))
          {
              setcookie('rwc[_firstP]', $firstPage,time()+3600*24*365,'/','.rankwatch.com');
          }
        }
        ?>
        });

                function IsValidEmail1(email)
                {
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,63}|[0-9]{1,3})(\]?)$/;
                return filter.test(email);
                }
                Number.prototype.format = function(n, x) {
                  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
                  return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
                };
                function display_c(curVal){
                  var autos = Math.floor((Math.random() * 4) + 1);
                  curVal = curVal+autos;
                  var nVal = curVal.format();
                  var interval = autos*2000;
                  document.getElementById('loadVal').innerHTML ="$ "+nVal;
                  setTimeout('display_c('+curVal+')',interval);
                }
                function display_ct() {
                  var x = new Date().getTime()/1000;
                  var timeStamp = x-1406020379;
                  var curVal = 17413245+parseInt(timeStamp/2);
                  display_c(curVal);
                }
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34085419-1']);
  _gaq.push(['_trackPageview']);  
  _gaq.push(['_trackEvent', 'Vimeo', 'Started video', '//player.vimeo.com/video/117247325', undefined, true]);
  _gaq.push(['_trackEvent', 'Vimeo', 'Paused video', '//player.vimeo.com/video/117247325', undefined, true]);
  _gaq.push(['_trackEvent', 'Vimeo', 'Resumed video', '//player.vimeo.com/video/117247325', undefined, true]);
  _gaq.push(['_trackEvent', 'Vimeo', 'Completed video', '//player.vimeo.com/video/117247325', undefined, true]);
  _gaq.push(['_trackEvent', 'Vimeo', 'Skipped video forward or backward', '//player.vimeo.com/video/117247325', undefined, true]);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php if($gHTTPS== 'http://'): ?>
<?php endif; ?>
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '705849652817780']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=705849652817780&amp;ev=NoScript" /></noscript>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '468817429980737');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=468817429980737&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<link rel="canonical" href="<?php echo app_get_base_dir(2).app_get_action(); ?>.html" />
<?php echo app_render_section('fev-icon', array(),4); ?>
</head>
<body >
<!-- Google Tag Manager -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NW45RCT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager -->
	<div class="headerMain">
<div class="header">
<div class="headerLeft">
<a href="<?php e(__SITE_URL__); ?>"><img src="<?php echo $rw_cdn; ?>/images-home1/rank_logo.png?catched_main" /> </a>
</div>
<div class="headerRight">
	<div class="HeaderNavTop">
	<ul>
	</ul>
</div>
<div class="clear"></div>

</div>
</div>
</div>
<div class="clear"></div>
<div class="bannerTop">
	<div class="bannerTopInner">
<div class="bannerLeft">
    <?php  if(app_get_action()=='competitors') {?>
	<img src="<?php echo $rw_cdn; ?>/images-home1/monitor.png" />
    <?php } else if(app_get_action()=='rank-tracking'){ ?>
    <img src="<?php echo $rw_cdn; ?>/images-home1/top-banner2.png" />
    <?php } else if(app_get_action()=='rankwatch-reporting'){ ?>
     <img src="<?php echo $rw_cdn; ?>/images-home1/top-banner3.png" />
     <?php } else if(app_get_action()=='website-analyzer'){ ?>
     <img src="<?php echo $rw_cdn; ?>/images-home1/web-banner.png" />
     <?php } else if(app_get_action()=='agency'){ ?>
     <img src="<?php echo $rw_cdn; ?>/images-home1/agency-banner.png" />
     <?php } ?>
</div>
<div class="bannerRgt">
    <?php 
      if(app_get_action() == 'competitors'){ 
        $report_head = 'Competition taking away your business? Get to know and analyze your Organic and Paid Competition within seconds';
        $report_content = 'Focus on ROI and generating leads while we focus on your competition';
        $headings = explode('-', $heading);
          if( isset($headings[0]) && $headings[0] == 'a' )
            $newHead = $report_head.' '.str_replace('+', ' ', $headings[1] );
          else if( isset($headings[0]) && $headings[0] == 'c' )
            $newHead = str_replace('+', ' ', $headings[1]);
          else
            $newHead = $report_head;

        $contents = explode('-', $content);
          if( isset($contents[0]) && $contents[0] == 'a' )
            $newContent = $report_content.' '.str_replace('+', ' ', $contents[1] );
          else if( isset($contents[0]) && $contents[0] == 'c' )
            $newContent = str_replace('+', ' ', $contents[1]);
          else
            $newContent = $report_content;

      ?>
	<span><?php echo $newHead; ?></span>
  <p><?php echo $newContent; ?></p>
<a href="#myModal" id="tester" data-toggle="modal" class="btntop">Demo</a>
<a href="%%__THEME_PATH__%%pdf/Competitor Report.pdf" class="btntop btnBg" download>Competitor Report</a>
<?php } 
  if(app_get_action() == 'rank-tracking'){ 
    $report_head = '99.6% users believe that <br>RankWatch is the most accurate<br> SEO Management Platform';
    $report_content = 'We use <b style="font-size:20px;color:#fff">localized IPs</b> for your <b style="color:#fff;font-size:20px;">rank tracking</b>';
    $headings = explode('-', $heading);
      if( isset($headings[0]) && $headings[0] == 'a' )
        $newHead = $report_head.' '.str_replace('+', ' ', $headings[1] );
      else if( isset($headings[0]) && $headings[0] == 'c' )
        $newHead = str_replace('+', ' ', $headings[1]);
      else
        $newHead = $report_head;

    $contents = explode('-', $content);
      if( isset($contents[0]) && $contents[0] == 'a' )
        $newContent = $report_content.' '.str_replace('+', ' ', $contents[1] );
      else if( isset($contents[0]) && $contents[0] == 'c' )
        $newContent = str_replace('+', ' ', $contents[1]);
      else
        $newContent = $report_content;

?>
<span><?php echo $newHead; ?></span>
<p><?php echo $newContent; ?></p>
<a href="#myModal" data-toggle="modal" class="btntop">Demo</a>
<a href="%%__THEME_PATH__%%pdf/Sample Report.pdf" class="btntop btnBg" download>Sample Report</a>
<?php 
} 
  if(app_get_action() == 'rankwatch-reporting'){
    $report_head = 'Completely Automated SEO Reports that can be customized according to your needs';
    $report_content = 'Set a lasting impression on your boss or your set of clients from wherever you are by providing them with eye-catching and insightful SEO reports in just a few seconds';
    $headings = explode('-', $heading);
      if( isset($headings[0]) && $headings[0] == 'a' )
        $newHead = $report_head.' '.str_replace('+', ' ', $headings[1] );
      else if( isset($headings[0]) && $headings[0] == 'c' )
        $newHead = str_replace('+', ' ', $headings[1]);
      else
        $newHead = $report_head;

    $contents = explode('-', $content);
      if( isset($contents[0]) && $contents[0] == 'a' )
        $newContent = $report_content.' '.str_replace('+', ' ', $contents[1] );
      else if( isset($contents[0]) && $contents[0] == 'c' )
        $newContent = str_replace('+', ' ', $contents[1]);
      else
        $newContent = $report_content;

?>
<span><?php echo $newHead; ?></span>
<p><?php echo $newContent; ?></p>
<a href="#myModal" data-toggle="modal" class="btntop">Demo</a>
<a href="%%__THEME_PATH__%%pdf/Sample Report.pdf" class="btntop btnBg" download>Sample Report</a>
<?php } 
  if(app_get_action() == 'website-analyzer'){  
    $report_head = 'Comprehensively measure your website’s effectiveness from a score of 100, by testing it against numerous parameters set by us';
    $report_content = 'Analyze what you are doing right and what you are doing wrong by testing your website’s effectiveness against a set of parameters laid out by RankWatch such as Speed, Technology, Mobile and Social Media';
    $headings = explode('-', $heading);
      if( isset($headings[0]) && $headings[0] == 'a' )
        $newHead = $report_head.' '.str_replace('+', ' ', $headings[1] );
      else if( isset($headings[0]) && $headings[0] == 'c' )
        $newHead = str_replace('+', ' ', $headings[1]);
      else
        $newHead = $report_head;

    $contents = explode('-', $content);
      if( isset($contents[0]) && $contents[0] == 'a' )
        $newContent = $report_content.' '.str_replace('+', ' ', $contents[1] );
      else if( isset($contents[0]) && $contents[0] == 'c' )
        $newContent = str_replace('+', ' ', $contents[1]);
      else
        $newContent = $report_content;
?>
<span><?php echo $newHead; ?></span>
<p style="margin:12px 0px;"><?php echo $newContent; ?></p>
<a href="#myModal" data-toggle="modal" class="btntop">Demo</a>
<a href="%%__SITE_URL__%%tools/web-analyzer.html" class="btntop btnBg" download>REVIEW MY SITE<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;(NO SIGNUP REQUIRED)</span></a>
<?php }
  if(app_get_action() == 'agency'){
   $report_head = 'Time, Money and long hours of Manpower saved through a fully automated SEO platform';
    $report_content = 'Track and accurately manage hundreds of clients and their website rankings on a one-stop dashboard without the need for countless hours of rigorous manual tracking of keywords. Automate everything from Reports to Competitors';
    $headings = explode('-', $heading);
      if( isset($headings[0]) && $headings[0] == 'a' )
        $newHead = $report_head.' '.str_replace('+', ' ', $headings[1] );
      else if( isset($headings[0]) && $headings[0] == 'c' )
        $newHead = str_replace('+', ' ', $headings[1]);
      else
        $newHead = $report_head;

    $contents = explode('-', $content);
      if( isset($contents[0]) && $contents[0] == 'a' )
        $newContent = $report_content.' '.str_replace('+', ' ', $contents[1] );
      else if( isset($contents[0]) && $contents[0] == 'c' )
        $newContent = str_replace('+', ' ', $contents[1]);
      else
        $newContent = $report_content;  

?>
<span><?php echo $newHead; ?></span>
<p><?php echo $newContent; ?></p>
<a href="#myModal" data-toggle="modal" class="btntop">Demo</a>
<a href="%%__THEME_PATH__%%pdf/Sample Report.pdf" class="btntop btnBg" download>Sample Report</a>
<?php } ?>
	<div class="clear"></div>
	<div class="signUpForm">
		<img class="arowAdst" src="<?php echo $rw_cdn; ?>/images-home1/arrow-w.png"/>
		<div class="clear"></div>
		<span><b>Sign Up Today!&nbsp;&nbsp;</b>14 Day Free Trial</span>
        <p style="color:#ff000;margin:0px;"><?php echo $errors; ?></p>
		<form name="signUp" onSubmit="_gaq.push(['_trackEvent', 'Registration', 'rankwatch', (document.getElementById('email1') ? document.getElementById('email1').value : '')   , 1, false])"  method="post">
            <input type="text" name="form[signUp][username]" id="userName" class="form-control" placeholder="Name" />
            <input type="text" name="form[signUp][email]" id="email1" class="form-control" placeholder="Email" />
            <input type="password" name="form[signUp][password]"  id="password" class="form-control" placeholder="Password" />
            <input type="submit" id="signUpSubmit" class="btn" value="Submit" />
        </form>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<div class="btStrip">
	<div class="btStripMain">
	<div class="botStripInner">
		<ul>
			<li>Total Number of Users<br/><span>28,750</span></li>
			<li>Total Amount of money saved<br/><span id='loadVal' >$ 17,413,245</span></li>
			<li>Total Number of Hours saved<br/><span>4 Hours daily</span></li>
		</ul>

	</div>
	</div>
</div>
<div class="OurClients">
	<div class="ClentInner">
		<ul>
			<li><img title="Virgin" alt="Virgin" src="<?php echo $rw_cdn; ?>/images-home1/virgin.jpg" /></li>
			<li><img title="Airtel" alt="Airtel" src="<?php echo $rw_cdn; ?>/images-home1/airtel.jpg" /></li>
			<li><img title="KMPG" alt="KMPG" src="<?php echo $rw_cdn; ?>/images-home1/kmpg.jpg" /></li>
			<li><img title="i-bibo" alt="i-bibo" src="<?php echo $rw_cdn; ?>/images-home1/ibibo.jpg" /></li>
			<li><img title="Puma" alt="Puma" src="<?php echo $rw_cdn; ?>/images-home1/puma.jpg" /></li>
		</ul>
	</div>
</div>
<div class="clear"></div>
 %%VIEW_CONTENTS%%
 <?php if(app_get_action() != 'rank-tracking'): ?>
<div class="mianDet2">
	<div class="mainDet2Inner">
		<h3>A Lot More...</h3>
		<div class="clear"></div>
        <!--
		<div class="detInfoLeft">
			<ul>
				<li class="list1 listing1" data-list="listing1">Daily Weekly SERP Tracking</li>
                <li class="list2" data-list="listing2">100% White Label</li>
                <li class="list3" data-list="listing3">City Based Rank Tracking</li>
                <li class="list4" data-list="listing4">Reporting</li>
                <li class="list5" data-list="listing5">Keyword Archive</li>
                <li class="list6" data-list="listing6">Email Triggers</li>
                <li class="list7" data-list="listing7">Analytics</li>
                <li class="list8" data-list="listing8">Competitors</li>
			</ul>
		</div>
    -->
		<div class="detInfoMain">
              <div class="left" style="position:absolute;margin:180px 0 0 15px;"><img src="<?php echo $rw_cdn; ?>/images-home1/arr-left.png" height="42" style="min-height:inherit;" width="42"/></div>
              <div class="right" style="position:absolute;margin:100px 0 0 910px"><img src="<?php echo $rw_cdn; ?>/images-home1/arr-rgt.png" style="min-height:inherit;margin-top:inherit;" height="42" width="42" /></div>
            <div id="listing1" class="marginClass" style="margin-left:0px;">
            <img src="<?php echo $rw_cdn; ?>/images-home1/dash-banner.png" />
                <h6>Daily Weekly SERP Tracking</h6>
                <p>Instant and timely rank results with the option to track your keywords on a daily or weekly basis on more that 200 search engines including Google, Baidu, Bing and Yahoo. </p>
            </div>
            <div id="listing2"  class="marginClass" style="display:none;">
                <img src="<?php echo $rw_cdn; ?>/images-home1/api-banner1.png" />
                 <h6>100% White Label</h6>
                <p>Our 100% White Label Interface allows you to set up multiple logins for your Clients or your Project Managers, which gives them access by logging in to their respective Projects with their own credentials.</p>
            </div>
            <div id="listing3"  class="marginClass" style="display:none;">
                    <img src="<?php echo $rw_cdn; ?>/images-home1/project-banner.png" />
                     <h6>City Based Rank Tracking</h6>
                <p>Get your rankings as precise as possible with location-based tracking and see what results your customer sees. Choose the search engine along with the specific city on which you want to monitor your keyword rankings.  </p>
            </div>
            <div id="listing4"  class="marginClass" style="display:none;">
                <img src="<?php echo $rw_cdn; ?>/images-home1/an-breif-banner.png" />
                 <h6>Reporting</h6>
                <p>Get automated reports on a daily/weekly/monthly basis whichever is convenient for you or create customized reports within minutes for your clients with RankWatch advanced reporting. <a href="%%__THEME_PATH__%%pdf/Sample Report.PDF" download>Click here</a> for a sample PDF report. </p>
            </div>
            <div id="listing5"  class="marginClass" style="display:none;">
                <img src="<?php echo $rw_cdn; ?>/images-home1/arch-banner.png" />
                 <h6>Keyword Archive</h6>
                <p>Go back to any past date and check what the Google Page looked like. RankWatch through Keyword Archive gives you access to historical data for your keywords bykeeping a screenshot of the Google SERP for you to refer to when you need it. This allows you to re-confirm your rankings and also enquire into whom else was ranking on that specific day. </p>
            </div>
            <div id="listing6"  class="marginClass" style="display:none;">
                   <img src="<?php echo $rw_cdn; ?>/images-home1/email-banner.png" />
                    <h6>Email Triggers</h6>
                <p>Don't waste time in searching for position fluctuations of your keywords. Get automated E-mail notifications of any change in your rankings by setting conditions on when you want to be notified of such changes through RankWatch Email Triggers </p>
            </div>
            <div id="listing7"  class="marginClass" style="display:none;">
   
                      <img src="<?php echo $rw_cdn; ?>/images-home1/anal-banner.png" />
                      <h6>Analytics</h6>
                <p>RankWatch is fully integrated with Google Analytics, with the sole purpose to provide our users with inbound marketing data to make better strategically sound and informed decisions to improve their online performance. </p>
            </div>
            <div id="listing8"  class="marginClass" style="display:none;">

                  <img src="<?php echo $rw_cdn; ?>/images-home1/comp-banner.png" />
                  <h6>Competitors</h6>
                <p>SEO is all about going above your competitors website. RankWatch will assist you in doing just that by keeping a close eye on their online activities, organic or paid and report to you on a timely basis. We find out who your toughest competitor is and what ads they are running and how many keywords of yours they are ranking on. On top of that, we will give you a trend of what their online presence has been like and suggest you keywords that will give you an edge over them. Learn More. </p>
            </div>
             <div id="listing9"  class="marginClass" style="display:none;">

                  <img src="<?php echo $rw_cdn; ?>/images-home1/website-banner.png" />
                  <h6>Website Analyzer</h6>
                <p>Get your website audited and evaluated by RankWatch with a comprehensive in-depth analysis on what you are doing right and wrong with your website.RankWatch has just introduced its new version of Website Analyzer, a module that focuses on conducting research into what makes a website stand out or makes it unnoticeable. It neatly informs and tests a website on extensive parameters ranging from Technology, Social Media and Mobile which are essential to score  in order to get ranked and become more visible to users. </p>
            </div>
        </div>
        <div class="clear"></div>
        <div class="detInfoBottom">
            <ul>
                <li class="list1 listing" data-list="listing1" data-toggle="tooltip" data-placement="top" title="Daily Weekly SERP Tracking"></li>
                <li class="list2" data-list="listing2" data-toggle="tooltip" data-placement="top" title="100% White Label"></li>
                <li class="list3" data-list="listing3" data-toggle="tooltip" data-placement="top" title="City Based Rank Tracking"></li>
                <li class="list4" data-list="listing4" data-toggle="tooltip" data-placement="top" title="Reporting"></li>
                <li class="list5" data-list="listing5" data-toggle="tooltip" data-placement="top" title="Keyword Archive"></li>
                <li class="list6" data-list="listing6" data-toggle="tooltip" data-placement="top" title="Email Triggers"></li>
                <li class="list7" data-list="listing7" data-toggle="tooltip" data-placement="top" title="Analytics"></li>
                <li class="list8" data-list="listing8" data-toggle="tooltip" data-placement="top" title="Competitors"></li>
                 <li class="list9" data-list="listing9" data-toggle="tooltip" data-placement="top" title="Website Analyzer"></li>
            </ul>
            
        </div>

	</div>
    <div class="border-dotted"></div>
</div>
<?php endif; ?>
<div class="clear"></div>
<div id="checkPricing" class="pricingMainOuter" <?php if(app_get_action()== 'rank-tracking'){ ?>style="background-color:#f8f8f8;"<?php } ?>>
    <div class="pricingMain" <?php if(app_get_action()== 'rank-tracking'){ ?>style="padding-top:12px;background-color:#f8f8f8;"<?php } ?>>
        <div class="pricingMainTop">
             



            <h1>Pricing</h1>

             <div class="countryPrice">
            <a href="<?php e(app_get_site_url().''.app_get_action().'.html?c=usa#checkPricing'); ?>">
                <img alt="USD($)" title="USD($)" <?php if($country != 'usa'): ?>class="opacTrue"<?php endif; ?> src="<?php echo $rw_cdn; ?>/images-home1/flag1.png" />
            </a>
            <a href="<?php e(app_get_site_url().''.app_get_action().'.html?c=uk#checkPricing'); ?>"><img alt="GBP(&pound;)" title="GBP(&pound;)"  <?php if($country != 'uk'): ?>class="opacTrue"<?php endif; ?> src="<?php echo $rw_cdn; ?>/images-home1/flag3.png" />
            </a>
              <a href="<?php e(app_get_site_url().''.app_get_action().'.html?c=au#checkPricing'); ?>" ><img alt="AUD($)" title="AUD($)"  <?php if($country != 'au'): ?>class="opacTrue"<?php endif; ?> src="<?php echo $rw_cdn; ?>/images-home1/flag2.png" />
            </a>
</div>
<div class="clear"></div>
            <select id="checkPlan" class="form-control">
                <option value="Daily" selected="selected">Daily Rank Updates</option>
                <option value="Weekly">Weekly Rank Updates</option>
            </select>
            <img class="imgs" src="<?php echo $rw_cdn; ?>/images-home1/select-arrow.jpg">
            <p>Choose any of the packages listed below or customize one to suit your own requirements.</p>
            <div class="pricingPlan"><a href="javascript:void(0);" title="Rankings will be updated on a daily basis" class="planActive" id="monthly" data-test='flipOutY' >1 Month</a><a id="quarterly" title="Rankings will be updated once a week." data-test='flipInY'  ref="javascript:void(0);">6 Months</a><a id="yearly"  data-test='flipInY' c ref="javascript:void(0);">1 Year</a></div>
        </div>
            </div>
        <div class="clear"></div>
        <div style="width:100%;background-color:#fff;">
        <div class="pricingMainMid">
            
            <div class="pricing priceDiv1">
                <div id="animateTest" >
                <h6  class="m-daily" ><span id="md-key">250</span> Keywords</h6>
                <h6  class="m-weekly" style="display:none;"><span id="mw-key">1000</span> Keywords</h6>
                </div>
                <div class="circleSmall circle1"><span>M</span></div>
                   <?php 
                       if($country == 'uk')
                       {
                        $currency = "£<b>19</b>";
                        $currency1 = "£<b>65</b>";
                        $currency2 = "£<b>294</b>";
                        $currency3 = "£<b>38</b>";
                        $crt = "-UK-1-Month";
                       }
                       else if($country == 'usa')
                       {
                           $crt = "";
                           $currency = "$<b>29</b>";
                           $currency1 = "$<b>99</b>";
                           $currency2 = "$<b>449</b>";
                           $currency3 = "$<b>58</b>";
                       }  
                       else if($country == 'au')
                       {
                          $currency = "$<b>32</b>"; 
                          $crt = "-AUD-1-Month"; 
                          $currency1 = "$<b>108</b>"; 
                          $currency2 = "$<b>489</b>";  
                          $currency3 = "$<b>489</b>"; 
                       }
                    ?>
                <div  class="currency-bx" >
                    <em id="m-price1-ex" class="ex-price" style="display:none"></em>
                    <em id="m-price1" class="main-price"><?php echo $currency ?></em>

                   <!-- <em id="m-price2" style="display:none;">$<b>29</b></em>-->
                </div>
        
                <table style="margin-top:16px;">
                    <tr><td><span class="wRefresh">Weekly Rank Refresh</span><span class="dRefresh" style="display:none">Daily Rank Refresh</span></td></tr>
                    <tr><td>Local/City Rank Tracking</td></tr>
                    <tr><td>Automated Alerts</td></tr>
                    <tr><td> White Label Reporting</td></tr>
                    <tr><td>Multiple Logins</td></tr>
                    <tr><td>Competitor Analysis</td></tr>
                    <tr><td>&nbsp;</td></tr>
                </table>
                 <a id="m-daily"  href="<?php e(app_get_site_url()); ?>member/signup/index/c/M-250-Keywords-Daily-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseM">Purchase</a>
                <a id="m-weekly" style="display:none" href="<?php e(app_get_site_url()); ?>member/signup/index/c/M-1000-Keywords-weekly-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseM">Purchase</a>
            </div>

            <div class="pricing priceDiv2">
                <div class="bestBuyTop"></div>
                <div class="clear"></div>
                <div class="priceDivInner">
                       <div id="animateTest1" >
                        <h6 class="m-daily kAdjust" ><span id="ld-key">1500</span> Keywords</h6>
                        <h6  class="m-weekly kAdjust" style="display:none;"><span id="lw-key">6000</span> Keywords</h6>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="circleLarge circle2"><span>L</span></div>
                     <div  class="currency-bx1">
                    <em id="l-price1-ex" style="display:none" class="ex-price"></em>
                    <em id="l-price1" class="main-price"><?php echo $currency1; ?></em>
                    <!--<em id="l-price2" style="display:none;">$<b>199</b></em>-->
                     </div>
                    
                    <table style="margin-top: 15px;">
                     <tr><td><span class="wRefresh">Weekly Rank Refresh</span><span class="dRefresh" style="display:none">Daily Rank Refresh</span></td></tr>    
                    <tr><td>Local/City Rank Tracking</td></tr>
                    <tr><td>Automated Alerts</td></tr>
                    <tr><td> White Label Reporting</td></tr>
                    <tr><td>Multiple Logins</td></tr>
                    <tr><td>Competitor Analysis</td></tr>
                    <tr><td>100% White Label Interface</td></tr>
                </table>
               <a id="l-daily"  href="<?php e(app_get_site_url()); ?>member/signup/index/c/L-1500-Keywords-Daily-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseL">Purchase</a>
                <a id="l-weekly" style="display:none;" href="<?php e(app_get_site_url()); ?>member/signup/index/c/L-6000-Keywords-weekly-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseL">Purchase</a>
                </div>
            </div>

            <div class="pricing priceDiv3">
                    <div id="animateTest2" >
                        <h6 class="m-daily" ><span id="xld-key">7500</span> Keywords</h6>
                        <h6  class="m-weekly" style="display:none;"><span id="xlw-key">30000</span> Keywords</h6>
                    </div>
                      <div class="circleSmall circle3"><span>XL</span></div>
                       <div class="currency-bx2">
                    <em id="xl-price1-ex" style="display:none;" class="ex-price"></em>
                    <em id="xl-price1" class="main-price"><?php echo $currency2; ?></em>
                    <!--<em id="xl-price2" style="display:none;">$<b>1449</b></em>-->
                     </div>
                      <table style="margin-top: 17px;">
                     <tr><td><span class="wRefresh">Weekly Rank Refresh</span><span class="dRefresh" style="display:none">Daily Rank Refresh</span></td></tr>
                    <tr><td>Local/City Rank Tracking</td></tr>
                    <tr><td>Automated Alerts</td></tr>
                    <tr><td> White Label Reporting</td></tr>
                    <tr><td>Multiple Logins</td></tr>
                    <tr><td>Competitor Analysis</td></tr>
                    <tr><td>100% White Label Interface</td></tr>
                    <tr><td>Account Manager</td></tr>
                </table>
                <a id="xl-daily" style="margin-top:10px;" href="<?php e(app_get_site_url()); ?>member/signup/index/c/XL-7500-Keywords-Daily-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseXL">Purchase</a>
                <a id="xl-weekly" style="display:none;margin-top:10px;" href="<?php e(app_get_site_url()); ?>member/signup/index/c/XL-30000-Keywords-weekly-Rank-Tracking<?php echo $crt; ?>" class="purchase purchaseXL">Purchase</a>
            </div>

            <div class="pricing priceDiv4">
                   
                     <div id="animateTest3" >
                        <div >  <h6 class="m-daily" ><span id="range1">500</span>&nbsp;Keywords </h6>
                            <h6  class="m-weekly" style="display:none;"><span id="range2">1500</span>&nbsp;Keywords </h6>
                           </div>            
                    </div>
                      <div class="circleSmall circle4"><span>Custom<br/>tailored</span></div>
                      <div  class="currency-bx3">
                      <em id="rangePrice-ex" style="display:none;" class="ex-price"></em>
                      <em id="rangePrice" class="main-price"><?php echo $currency3; ?></em>
                  </div>
                      <p class="customAlign">Set Number of the Kewords</p>
                      <div id="rangeSliderD" >
                      <input id="rangeSlider" type="text" data-slider-min="2" data-slider-max="28"  data-slider-package="M" data-slider-handle="square" data-slider-step="1" data-slider-value="2" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show"  />
                    </div>
                    <div id="rangeSliderW" style="display:none;">
                      <input id="rangeSlider1" type="text" data-slider-min="2" data-slider-max="28" data-slider-package="M" data-slider-handle="square" data-slider-step="1" data-slider-value="2" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show"  />
                  </div>
                  
                    <img src="<?php echo $rw_cdn; ?>/images-home1/arrows.png" class="arrowSlide"/>
                    <div class="clear"></div>
                    
                    <p style="margin-top:37px;font:12px roboto;min-height:137px;">Move the slider to create a custom package. If your requirements exceed the maximum number of keywords, please get in touch with us at info@rankwatch.com to get a quote. We would love to help you out.</p>
                   
                      <!--<p>Choose any plan to start your 14-days free trial or you can customize it to suit  your needs no credit card required.Choose any plan to start your 14-days free trial or you can customize it to suit  your needs no credit card required.  </p>-->
                      <a id="range" style="margin-top:26px;"  href="<?php e(app_get_site_url()); ?>member/signup/index/c/custom-500-Keywords-Daily-Tracking<?php echo $crt; ?>/?range=500" class="purchase purchaseCs s-daily">
                        Purchase</a>
                      <a id="ranges" style="display:none;margin-top:26px;" href="<?php e(app_get_site_url()); ?>member/signup/index/c/Custom-1500-Keywords-WeeklyTracking<?php echo $crt; ?>/?range=1500" class="purchase purchaseCs s-weekly">
                        Purchase</a>
                                         
            </div>
            <div class="clear"></div>
            <!--
            <div class="bottomList">
                <ul>
                    <li class="listActive">Monthly</li>
                     <li>|</li>
                    <li>6 Months</li>
                    <li>|</li>
                    <li>Yearly</li>
                </ul>
                <div class="clear"></div>
            </div>
        -->
        </div>
</div>
</div>


<!--
 <div class="freeTrial">
  <div class="freeTrialInner">
    Are you ready to Signup for the 14 day free trial? <br/>
    <a href="<?php echo app_get_site_url(); ?>member/signup/" class="btnStyle">Get Started now</a>
</div>
</div>
-->
<div class="clear"></div>
<div class="footer" style="background-color:#e5e5e5">
  <?php if( isset($keywords) && strlen($keywords) > 0 ) { ?>
    <h4 align="center" style="padding-top:10px;"> Tags :  <?php echo $keywords; ?></h4>
  <?php } ?>
  <div class="footerInner">
      &copy; 2014 RankWatch, Inc. All rights reserved. <a href="#termsModal" data-toggle="modal">Terms of Service &amp; Privacy Policy</a>. 
</div>
</div>


<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:45%;">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Request A Demo</h4>
      </div>
      <div class="modal-body" style="padding-left:20px;">
        <form class="form-horizontal" role="form" name="demoData" method="post" action="" style="text-align:left;">
            <table width="95%" style="margin-left:5%;" class="formTopTable">
                <tr><td colspan="2"><label for="inputEmail3" class="control-label" style="text-align:left;">Name</label></td></tr>
                <tr><td width="90%" colspan="2"><input type="text" style="width:90%" id="name" name="username" class="form-control animateBox" id="inputEmail3" placeholder="Name"></td></tr>
                <tr><td colspan="2" > <div id="nameError"  style="font:12px roboto regular;color:#ff0000;"></div></td></tr>
                <tr><td colspan="2"><label for="inputPassword3" class="control-label" style="text-align:left;">Email</label></td></tr>
                <tr><td colspan="2"> <input  type="email" id="email" name="email" style="width:90%" class="form-control animateBox" id="inputPassword3" placeholder="Email"></td></tr>
                <tr><td colspan="2"> <div id="emailError" style="font:12px roboto regular;color:#ff0000;"></div></td></tr>
                 <tr>
                        <td colspan="2">  
                            <div class="radio" style="float:left;padding-bottom:10px;">
                            <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Digital Agency
                            </label>
                            </div>
                            <div class="radio" style="float:left; margin-left:15px;padding-bottom:10px;">
                            <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Website Owner
                            </label>
                            </div>
                            <br/>
                        </td>
                    </tr>

                <tr><td colspan="2"><label for="website" class="control-label" style="text-align:left;">Website</label></td></tr>
                <tr><td colspan="2"><input type="input" id="website" name="website" style="width:90%" class="form-control animateBox" placeholder="Website"></td></tr>
                <tr><td colspan="2"> <div id="websiteError" style="font:12px roboto regular;color:#ff0000;"></div></td></tr>
                <tr><td colspan="2"> <label for="inputEmail3" class="control-label" style="text-align:left;">Phone Number</label></td><tr>
                <tr><td width="40%"><input type="text" style="width:70%" id="countryCode" name="countryCode" class="form-control" id="inputEmail3" placeholder="Country code"></td><td width="50%"><input type="text" style="width:82%"  id="phone" name="phonen" class="form-control" id="inputEmail3" placeholder="Number"></td></tr>
                <tr><td colspan="2"> <div id="phoneError" style="font:12px roboto regular;color:#ff0000;"></div></td></tr>
                <tr><td colspan="2"><label for="website" class="control-label" style="text-align:left;">When are you available for the demo?</label></td></tr>
                <tr><td colspan="2">  <input colspan="2" type="input" id="whenAvail" name="whenAvail" style="width:90%" class="form-control animateBox" placeholder=""></td></tr>
                <tr><td colspan="2"> <div id="whenError" style="font:12px roboto regular;color:#ff0000;"></div></td></tr>
            </table>
<div class="clear"></div>
      <button type="submit" id="submits" onclick="_gaq.push(['_trackEvent', 'Registration', 'rankwatch', (document.getElementById('email') ? document.getElementById('email').value : '')   , 1, false])" class="btn btn-primary" style="margin:0px 0 0 33%;">Schedule My Demo</button>
</form>
<?php var_dump('express');die;?>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Terms and conditions</h4>
      </div>
      <div class="modal-body" id="requestDemo" style="padding-left:20px;max-height:450px;" id="">
        <h3>RankWatch Terms of Use</h3>
        <br/>
        <b>Description of Service</b>
        <p>Rank Watch is a toolset for SEO professionals that provides Internet marketing tools for search engine optimization (“SEO”) social media management (SMM) website optimization, including research and analysis, link building, campaign management, automated tracking of search engine performance, analytics and conversion tracking, and SEO reports.</p>
        <b>The “Service” includes </b>
        <p>(a) The Site, <br/>
        (b) The on-demand Rank Watch SEO platform, tools and Rank Watch API, and  <br/>
        (c) The other services  <br/>
        </p>
        <p>These services are provided to you through the site based on the plan purchased, including all software, data, text, images, sounds, videos, and other content made available through the site, or developed via the Rank Watch API (collectively, “Content”). Any new features added to or augmenting the Service, are also subject to these Terms.</p>
        <b>Fee for Service  </b>
        <p>Rank Watch provides a free account and several tiered service, fee based accounts. Fees are based on the package the user has chosen. Each package has a base fee, which may incur extra charges for overages. Overage charges may apply to some services. You need to pay for services rendered above and beyond those included with your package.</p>
        <p><b>Account Downgrading: </b>Downgrading your subscription plan level may cause the loss of content, features, or capacity of your account and you will be released by Rank Watch from any liability for such loss. In order to initiate the account downgrading process, you must manually delete the number of keywords tracked to permit use of the service on the desired subscription plan tier. If you do not make those changes prior to requesting the downgrade of your account, the action will not be authorized and you will remain on your current subscription plan tier until all appropriate and requested actions are made.</p>
        <p><b>Representations and Warranties:</b> You have to represent and warrant that all the information provided to Rank Watch for using the service is correct, and current. Also, you need to ensure that you have all the necessary right, power, and authority to enter this agreement and perform the acts required as enumerated in this Agreement.</p>
        <p><b>Third-Party Content:</b> Certain content, products or services made available through the Rank Watch service may include materials from third parties. In addition, Rank Watch may provide links to certain third-party websites as needed or to be used as reference when applicable. We are not responsible for this content or these websites, and you must agree not to hold us liable for any damage that may result from accessing or using them.</p>
        <p><b>No Thirty Party Beneficiaries: </b>As a user of the Rank Watch service, you acknowledge that there shall be no third party beneficiaries to the agreement.</p>
        <p><b>Privacy:</b> As a condition of using the service, you must agree to the terms of the Privacy Policy. You must acknowledge, consent and agree that Rank Watch may access, preserve and disclose your account information and any content or data, including the content of your e-mails if required to do so by law, or with a good faith belief that such access, preservation, or disclosure is desirable to comply with legal process, enforce our terms of service agreement, respond to claims that any content violates the rights of third parties, respond to your requests for customer service, or protect the rights, property or personal safety of Rank Watch, its users, or any other party.</p>
        <p><b>Limitation of Liability:</b> Under no circumstances shall Rank Watch be liable to any user or third party on account of that user's use or misuse of or reliance on the service arising from any claim relating to this agreement or the website, or the service. Such limitation of liability shall apply to prevent recovery of direct, indirect, incidental, consequential, special, exemplary, and punitive damages including last profits, lost sales or business, lost data or business interruption whether such claim is based on warranty, contract, or tort (including negligence). Without limiting the generality of the foregoing, under no circumstances shall Rank Watch be held liable for any delay or failure in performance resulting directly or indirectly from acts, forces, or causes beyond its reasonable control, including, without limitation, Internet failures, computer equipment failures, telecommunication equipment failures, other equipment failures, electrical power failures, strikes, labor disputes (including lawful and unlawful strikes), riots, insurrections, civil disturbances shortages of labor or materials, fires, floods, storms, explosions, acts of God, ware, governmental actions, orders of domestic or foreign courts or tribunals, non-performance of third parties, or loss of or fluctuations in heat, light, or air conditioning. Rank Watch shall not be liable for any direct damages, costs, losses or liabilities whatsoever by any user or third party. Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply to you. In these situations, ‘Rank Watch' liability will be limited to the greatest extent permitted by law.</p>
        <p><b>Assignment:</b> Rank Watch may assign or transfer Agreement, in whole or in part, without restriction. In the event of an assignment or transfer, all rights to your data will be transferred, and you may be required by the beneficiary of the assignment or transfer to enter into a new agreement.</p>
        <p><b>Cancellation:</b> You are responsible for properly cancelling your account. You may cancel your account at any time by going to your PayPal or Recur account to cancel future charges for the service. Any method of communication other than electing to cancel your subscription plan inside your selected payment method will not be considered cancellation. All of your content will be immediately deleted from the service upon cancellation. This data cannot be recovered once your account is cancelled. If you pay your subscription in monthly installments and you cancel your subscription prior to the end of the subscription period, Rank Watch will terminate your access to the service and cease billing for future use of the service. However, you will remain responsible for all charges incurred prior to Rank Watch terminating access to your account. Nonpayment of the Rank Watch service seven (7) days after the last date of billing will constitute and initiate the cancellation of your account. After canceling your account by terminating future billings through PayPal or Recur, please submit a support ticket to initiate the termination of your account immediately.</p>
        <p><b>MODIFICATIONS:</b> The Rank Watch Team reserves the right, at its sole discretion, to modify or replace any part of these terms. It is your responsibility to check these Terms of Service periodically for changes. Your continued use of Rank Watch service or access to Rank Watch website following the changes in these Terms constitutes acceptance of those changes.</p>
        <p><b>Governing Law: </b>This Agreement shall be governed by and construed under the laws of the state of India without reference to its conflict of law principles. In the event of any conflicts between foreign law, rules, and regulations, and Indian law, rules, and regulations, Indian law, rules, and regulations shall prevail and govern. Each party agrees to submit to the exclusive and personal jurisdiction of the courts located in New Delhi, India. The United Nations Convention on Contracts for the International Sale of Goods and the Uniform Computer Information Transactions Act shall not apply to this Agreement.</p>
        <br/>
        <h3>Privacy Policy</h3>
        <br/> 
        <p>We collect certain information relating to users who visit the site. Rank Watch does not make any attempt to obtain information that personally identifies our users who visit our site. It is not our policy to sell or otherwise provide access to such information to unaffiliated third parties. We collect the e-mail addresses of those who communicate with us via e-mail, aggregate information on what pages consumer access or visit, and information volunteered by the consumer (such as survey information and/or site registrations). The information we collect is used to improve the content of our Web pages and the quality of our service, and is not shared with or sold to other organizations for commercial purposes, except to provide products or services you’ve requested, when we have your permission.</p>
        <b>Information Gathering and Usage</b>
        <p>We may collect personal information from Users in a variety of ways, including, but not limited to, when Users visit our site, fill out a form, and in connection with other activities, services, features or resources that we make available on our Site. Users may be asked to input their name, email address, phone number, address, payment information, and other information that we may deem desirable to collect for the purposes of delivering or enhancing our Site or services. Users may, however, visit our Site without providing this information. We will collect personal information from Users only if they voluntarily submit such information to us. Users can always refuse to supply personal information, except that it may prevent them from engaging in certain Site-related activities, and they will be unable to enroll in the service that we provide.</p>
        <p>We may use the information we collect for internal reporting services, to create reports about rankings with all identifying information and keywords removed, and to help us help you. Namely, our service is designed to help you understand where you stand with your marketing efforts and to help us know how we can better serve you. Thus, we aggregate certain personal and non personal identifiable information, in an anonymous form, to help us develop new products, services, enhance existing ones, and create reports.
        We may collect non-personal information about users whenever they interact with our Site. Non-personal information may include the browser name, the type of computer, IP address, operating system, Internet Service Provider, and other technical information about users' means of visiting our Site.</p>
        <b>Web Browser Cookies</b>
        <p>Our Site may use "cookies" to enhance Users' experiences. Users' web browsers place cookies on their hard drives in order to allow us to distinguish user accounts for security and privacy reasons, and to conduct marketing campaigns, that we think may grab the attention of certain Users. For these reasons, enabling cookies is mandatory for full functionality of our Site and service.</p>
        <b>Data Ownership</b>
        <p>Rank Watch uses third party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to run Rank Watch. All search engine data and other important information collected through Rank Watch is owned by Rank Watch and licensed to its customers on an as-needed basis.</p>
        <b>How We Protect Your Information</b>
        <p>We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, username, password, transaction information and data stored on our Site.</p>
        <b>Sharing Your Personal Information</b>
        <p>We do not sell, trade, or rent Users' personal information to others. We may share generic aggregated demographic information not linked to any personal information regarding visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined above and for any other purpose we deem desirable for our business operations or our Users.</p>
        <b>Changes To This Privacy Policy</b>
        <p>Rank Watch has the discretion to update their privacy policy at any time. When we do, we will revise the updated date at the bottom of this page. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy each time you visit our website or use our service, and remain aware of any amendments.</p>
        <b>Your Acceptance Of These Terms</b>
        <p>By using this Site, you signify your acceptance of this policy and terms of service. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of changes to this policy means that you accept those changes.</p>

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
    $('#tester').click(function(){
        $('#myModal').modal('show');
    });

});
$(function()
{

    var txtEmailAddress = $('#email');
    var txtName = $('#name');
    var txtphone = $('#phone');
    var emailError = $('#emailError');
    var nameError = $('#nameError');
    var phoneError = $('#phoneError');
    var date = $('#datepick');
    var time= $('#time');
    var timezone = $('#timezone');
    var dateError = $('#dateError');
    var timeError= $('#timeError');
    var timezoneError = $('#timezoneError');
    var code = $('#countryCode');
    
$('#submits').click(function(e)
{
    var checkError = false;
    txtEmailAddressValue = txtEmailAddress.val();
    txtValue = txtName.val();
    txtphoneValue = txtphone.val();
    dateValue = date.val();
    timeValue = time.val();
    timezoneValue = timezone.val();
    codeValue = code.val();
    if (txtValue == '')
    {
        nameError.html('This is Required field');
        nameError.fadeIn(400);
        checkError = true;
    }
    else
    {   
        nameError.html('');
        nameError.hide();

    }
    if (txtEmailAddressValue == '')
    {
        emailError.html('This is Required field');
        emailError.fadeIn(400);
        checkError = true;
    }
    else
    {
        if (!IsValidEmail(txtEmailAddressValue))
        {
            emailError.html('Please Enter a valid email address');
            emailError.fadeIn(400);
            checkError = true;
        }
        else
        {
            emailError.html('');
            emailError.hide();
        }
    }
    if (txtphoneValue == '' || codeValue == '')
    {
        phoneError.html('This is Required field');
        phoneError.fadeIn(400);
        checkError = true;
    }
    else
    {
        if (!IsValidPhone(txtphoneValue))
        {
            phoneError.html('Please Enter a numeric Phone Number without characters');
            phoneError.fadeIn(400);
            checkError = true;
        }
        else
        {   
        phoneError.html('');
        phoneError.hide();
        }
    }
        
    if (dateValue == '')
    {
            
        dateError.html('This is Required field');
        dateError.fadeIn(400);
        checkError = true;
    }
    else
    {   
        dateError.html('');
        dateError.hide();

    }
    if (timeValue == 0)
    {
        timeError.html('This is Required field');
        timeError.fadeIn(400);
        checkError = true;
    }
    else
    {   
        timeError.html('');
        timeError.hide();

    }
    if (timezoneValue == 0)
    {
        timezoneError.html('This is Required field');
        timezoneError.fadeIn(400);
        checkError = true;
    }
    else
    {   
        timezoneError.html('');
        timezoneError.hide();

    }
    if(checkError){
        return false;
        alert("hii");
    }

    return true;

});
    function IsValidEmail(email)

    {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,63}|[0-9]{1,3})(\]?)$/;
    return filter.test(email);
    }

    function IsValidPhone(phone)
    {
    var filter =  /^\d{10,14}$/;
    return filter.test(phone);

    }

});
</script>
<!-- Start Adding Cookie Consent -->
  <?php echo app_render_section('cookie-consent-pixel', array(),4); ?>
  <!-- Ends Adding Cookie Consent -->
</body>
</html>