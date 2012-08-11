<?php
/**
 * @copyright  Copyright (C) 2012 Martin Jainta - All rights reserved.
 * @license  GNU General Public License version 2 or later
 */
defined('_JEXEC') or die;
JHTML::_('behavior.framework', true);
$app = JFactory::getApplication();

// The text displayed after the copyright and site of the name inside the footer.
$footerText = $this->params->get('footerText');
$bannerImg = '/'.$this->params->get('bannerImage');
$slideshowWidth = $this->params->get('slideshowWidth');
$slideshowHeight= $this->params->get('slideshowHeight');

// All Images are put into an array, the key indicating its number.
$slideshowImgParams = array();
$slideshowImgParams[1] = $this->params->get('slideshowImg1');
$slideshowImgParams[2] = $this->params->get('slideshowImg2');
$slideshowImgParams[3] = $this->params->get('slideshowImg3');
$slideshowImgParams[4] = $this->params->get('slideshowImg4');
$slideshowImgParams[5] = $this->params->get('slideshowImg5');
$slideshowImgParams[6] = $this->params->get('slideshowImg6');
$slideshowImgParams[7] = $this->params->get('slideshowImg7');
$slideshowImgParams[8] = $this->params->get('slideshowImg8');
$slideshowImgParams[9] = $this->params->get('slideshowImg9');
$slideshowImgParams[10] = $this->params->get('slideshowImg10');
  
$slideshowImages = array();

for ($i = 1; $i <= count($slideshowImgParams); $i++)
{
	if($slideshowImgParams[$i] != null)
	{
		// For each Image the description and title are get
		$imgBasePath = $this->baseurl.'/'.$slideshowImgParams[$i];
		$imgDescriptionTitle = $this->params->get('slideshowDescriptionTitle'.$i);
		$imgDescription = $this->params->get('slideshowDescription'.$i);

		$slideshowImage = array();
		$slideshowImage['imgPath'] = $imgBasePath;
		$slideshowImage['description'] = $imgDescription;
		$slideshowImage['descriptionTitle'] = $imgDescriptionTitle;

		$slideshowImages[] = $slideshowImage;
    }
}
?>
<!DOCTYPE html>  
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?= $this->baseurl ?>/templates/<?= $this->template ?>/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->baseurl ?>/templates/<?= $this->template ?>/css/bootstrap-responsive.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->baseurl ?>/templates/<?= $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->baseurl ?>/templates/<?= $this->template ?>/css/stylesheet.css" type="text/css" />
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/mootools.js" ></script>
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/plugins/Loop.js" ></script>
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/plugins/SlideShow.js" ></script>
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/plugins/SlideShow.CSS.js" ></script>
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/plugins/modernizr.js" ></script>
</head>
<body>
    <div class="container">
        <section class="banner">            
            <div class="row" align="center">
                <div class="span12 banner">
                    <?php
                    if(empty($bannerImg) == false)
                    {
                        // If a image as banner was provided display it.
                        ?>
                        <img src="<?= $this->baseurl ?><?= $bannerImg ?>" >
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
        if (count($slideshowImages) > 0)
        {
			$useSlideshow = true;
            ?>
            <section class="slideshow">
                <div class="row">  
                    <div class="span12">
          <?php if ($this->countModules( 'headerShow' ))
          {
            ?>
            <jdoc:include type="modules" name="headerShow" />
            <?php
          }
          else
          {
          ?>
			<div id="slideshowCarousel" >
				<div>
				<div id="slideshow">
					<?php
					foreach ($slideshowImages as $slideshowImage)
					{
						?>
							<img src="<?= $slideshowImage['imgPath'] ?>" alt>
						<?php
					}
					?>
					<span class="carousel-control left" >&lsaquo;</span>
					<span class="carousel-control right" >&rsaquo;</span>
				</div>
				</div>
			</div>
            <?php
          }
          ?>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>
        <section class="navbarSection">
            <div class="row">  
                <div class="span12">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container">
                                <jdoc:include type="modules" name="navbar" style="none" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="span10 offset1">
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                </div>
            </div>
        </section>
        <section class="footer">
            <div class="row">
                <div class="span10 offset1 footerMargin" >
                    <footer>
                        <p>&copy; 2011 - <?= date('Y') ?> <?= $app->getCfg('sitename') ?></p>
                    </footer>
                </div>
            </div>
        </section>
    </div>
	<script type="text/javascript">
		/**
		 * @type {Boolean} Says wheter the slideshow should be used.
		 */
		var useSlideshow = '<?=isset($useSlideshow) ? $useSlideshow : ''?>';
	</script>
    <script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/template.js?slide=yes" ></script>
</body>
</html>