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
$bannerImg = $this->params->get('bannerImage');
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

$slideshowImages = array();

for ($i = 1; $i <= count($slideshowImgParams); $i++) 
{
    // For each Image the description and title are get
    $imgBasePath = $this->baseurl . $slideshowImgParams[$i];
    $imgDescriptionTitle = $this->params->get('slideshowDescriptionTitle'.$i);
    $imgDescription = $this->params->get('slideshowDescription'.$i);
    
    // If a valid filepath was specified the image will be added to another array containing the images to display.
    if (is_file($imgBasePath)) {
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" ></script>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/bootstrap.js" ></script>
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
                        <div id="slideshowCarousel" class="carousel slide">
                            <div class="carousel-inner">
                                <?php
                                foreach ($slideshowImages as $slideshowImage) 
                                {
                                    ?>
                                    <div class="item" align="center">
                                        <img src="<?= $slideshowImage['imgPath'] ?>" alt>
                                    <?php
                                    $description = $slideshowImage['description'];
                                    $descriptionTitle = $slideshowImage['descriptionTitle'];
                                    $isDescription = !empty($description);
                                    $isDescriptionTitle = !empty($descriptionTitle);
                                    
                                    if($isDescription || $isDescriptionTitle)
                                    {
                                        // If a description or a title is present display a carousel-caption.
                                        ?>
                                        <div class="carousel-caption">
                                            <?php
                                            if($isDescriptionTitle)
                                            {
                                                // If a title is present display it.
                                                ?>
                                                <h4><?= $descriptionTitle ?></h4>
                                                <?php
                                            }
                                            if($isDescription)
                                            {
                                                // If a description is present display it.
                                                ?>
                                                <p><?= $description ?></p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <a class="carousel-control left" href="#slideshowCarousel" data-slide="prev">&lsaquo;</a>
                            <a class="carousel-control right" href="#slideshowCarousel" data-slide="next">&rsaquo;</a>
                        </div>
						<script type="text/javascript" >
							$('#slideshowCarousel').carousel({
								interval:4000
							});

							$('#slideshowCarousel').carousel('next');
						</script>
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
                            <script type="text/javascript">
                                // Setting the necessary classes to enable a nice dropdown menu for the navbar
                                // Make sure the root element <ul> of the navbar has the id "navbar-menu"
                                $('#navbar-menu').children().each(function(){
                                    var classAttr = this.getAttribute('class');

                                    // If an element has the class "deeper" it is marked by jommla it has submenus
                                    if($(this).hasClass('deeper'))
                                    {
                                        // The submenu <li> needs the class "dropdown"
                                        $(this).addClass('dropdown');
                                        // The <a> of the submenu needs "dropdown-toggle" and a new attribute "data-toggle"
                                        $(this).children('a').addClass('dropdown-toggle');
                                        $(this).children('a').attr('data-toggle', 'dropdown');
                                        $(this).children('a').append('<b class="caret"></b>');
                                        // The children <ul> of the submenu get the class "dropdown-menu"
                                        $(this).children('ul').addClass('dropdown-menu');
                                    }
                                });
                            </script>
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
                        <p><pre class="footerText" ><?= $footerText ?></pre></p>
                    </footer>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="<?= $this->baseurl ?>/templates/<?= $this->template ?>/js/template.js" ></script>
</body>
</html>