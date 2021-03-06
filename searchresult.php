<?php
require ('php/classes/searchresult.class.php');
if (isset($_POST['findmycar'])) {
    $cartype = $_POST['cartype'];
	$manufacturer = $_POST['car_manufacturer'];
	$fuel_type = $_POST['fuel_type'];
	$millage = $_POST['millage'];
	$transmission = $_POST['transmission'];
	$displacement = $_POST['displacement'];
	$budget = $_POST['budget'];

    if ($obj->createQuery($cartype,$manufacturer,$fuel_type,$millage,$transmission,$displacement,$budget)){

        $data= $obj->output;
        $data2 = $obj->queryResult;
        $countsize = sizeof($data2);
    }
}
?>
<html>
<head>
    <title>Search Result | Easy Cars</title>
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<body>
<header class="b-topBar">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="b-topBar__addr">
                    <span class="fa fa-map-marker"></span>
                    JP Nagar 5th phase, Bangalore
                </div>
            </div>
            <div class="col-md-2 col-xs-6">
                <div class="b-topBar__tel">
                    <span class="fa fa-phone"></span>
                    1800-111-000
                </div>
            </div>
            <div class="col-xs-6">
                <nav class="b-topBar__nav">
                    <ul>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Sign in</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header><!--b-topBar-->

<nav class="b-nav">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-4">
                <div class="b-nav__logo wow slideInLeft">
                    <h3><a href="index.php">Easy <span>Cars</span></a></h3>
                    <h2><a href="index.php">Project For SV.CO 2016</a></h2>
                </div>
            </div>
            <div class="col-sm-9 col-xs-8">
                <div class="b-nav__list wow slideInRight">
                    <div class="collapse navbar-collapse navbar-main-slide" id="nav">
                        <ul class="navbar-nav-menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>                            
                            <li><a href="contacts.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav><!--b-nav-->

<section class="b-pageHeader">
			<div class="container">
				<h1 class=" wow zoomInLeft" data-wow-delay="0.5s">EASY CARS LISTINGS</h1>
				<div class="b-pageHeader__search wow zoomInRight" data-wow-delay="0.5s">
					<h3>Your search results</h3>
				</div>
			</div>
		</section><!--b-pageHeader-->

		<div class="b-breadCumbs s-shadow">
			<div class="container wow zoomInUp" data-wow-delay="0.5s">
				<a href="index.php" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a href="" class="b-breadCumbs__page m-active">Search Results</a>
			</div>
		</div><!--b-breadCumbs-->
		
		
		<div class="b-infoBar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-xs-12">
						<div class="b-infoBar__compare wow zoomInUp" data-wow-delay="0.5s">							
							<a id="compareurl" href="" target="_blank" class="b-infoBar__compare-item"><span class="fa fa-compress"></span>COMPARE VEHICLES:</a>
						</div>
					</div>					
				</div>
			</div>
		</div><!--b-infoBar-->
		
		<section class="b-items s-shadow">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-sm-8 col-xs-12">
						<div class="b-items__cars" id="pagdiv">
                            <?php
                            if (count($data2) >1) {
                                $counter =1;
                                foreach ($data2 as $keys => $value1) {
                                    ?>
                                    <li style="display:none;list-style: none;">
                                    <div class="b-items__cars-one wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="b-items__cars-one-img">
                                            <img src="<?php $obj->getCarImages($value1['id']) ?>"/>
                                            <a data-toggle="modal" data-target="#myModal" href="#"></a>
                                            <form>
                                                <input type="checkbox" id="check<?php echo $counter?>" value="<?php echo $value1['id']; ?>"/>
                                                <label for="check<?php echo $counter?>" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                            <?php $counter++; ?>
                                            </form>
                                        </div>
                                        <div class="b-items__cars-one-info">
                                            <header class="b-items__cars-one-info-header s-lineDownLeft">
                                                <h2><?php echo strtoupper($value1['manufacturer'] . ' ' . $value1['model']); ?></h2>
                                                <span>Rs.<?php $obj->moneyconv($value1['price']); ?></span>
                                            </header>
                                            <p>
                                                <?php $obj->descCut($value1['description']) ?>
                                            </p>
                                            <div class="b-items__cars-one-info-km">
                                                <span
                                                    class="fa fa-tachometer"></span> <?php echo $value1['fuel_type'] ?>
                                            </div>
                                            <div class="b-items__cars-one-info-details">
                                                <div class="b-featured__item-links">
                                                    <a href="javascript:void(0);"><?php echo $value1['millage'] ?>
                                                        KMPL</a>
                                                    <a href="javascript:void(0);"><?php echo strtoupper($value1['transmission']) ?></a>
                                                    <a href="javascript:void(0);"><?php echo $value1['displacement'] ?>
                                                        CC</a>
                                                    <a href="javascript:void(0);"><?php echo strtoupper($value1['exterior_color']) ?></a>
                                                </div>
                                                <a href="details.php?carid=<?php echo $value1['id']; ?>" target="_blank"
                                                   class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    </li>
                                    <?php
                                }
                            }elseif(count($data2)<1){
                                    ?>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="b-detail__head-title">
                                        <h1>NO RECORD FOUND</h1>
                                    </div>
                                    <br>
                                </div>
                            <?php
                            }else {
                                ?>
                                <div class="b-items__cars-one wow zoomInUp" data-wow-delay="0.5s">
                                    <div class="b-items__cars-one-img">
                                        <img src="<?php $obj->getCarImages($data2['id']) ?>"/>
                                        <a data-toggle="modal" data-target="#myModal" href="#"></a>
                                        <form>
                                         <label class="b-items__cars-one-img-check"><span class="fa fa-check" title="Add To Compare"></span>
                                             <input type="checkbox" name="check1" title="Add To Compare"/>
                                         </label>
                                        </form>
                                    </div>
                                    <div class="b-items__cars-one-info">
                                        <header class="b-items__cars-one-info-header s-lineDownLeft">
                                            <h2><?php echo strtoupper($data2['manufacturer'] . ' ' . $data2['model']); ?></h2>
                                            <span>Rs.<?php $obj->moneyconv($data2['price']); ?></span>
                                        </header>
                                        <p>
                                            <?php $obj->descCut($data2['description']) ?>
                                        </p>
                                        <div class="b-items__cars-one-info-km">
                                            <span class="fa fa-tachometer"></span> <?php echo $data2['fuel_type'] ?>
                                        </div>
                                        <div class="b-items__cars-one-info-details">
                                            <div class="b-featured__item-links">
                                                <a href="javascript:void(0);"><?php echo $data2['millage'] ?>
                                                    KMPL</a>
                                                <a href="javascript:void(0);"><?php echo strtoupper($data2['transmission']) ?></a>
                                                <a href="javascript:void(0);"><?php echo $data2['displacement'] ?>
                                                    CC</a>
                                                <a href="javascript:void(0);"><?php echo strtoupper($data2['exterior_color']) ?></a>
                                            </div>
                                            <a href="details.php?carid=<?php echo $data2['id']; ?>" target="_blank"
                                               class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
						</div>
                            <div class="b-compare__links wow zoomInUp" data-wow-delay="0.3s">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12 col-sm-offset-2">
                                    </div>
                                    <div  class="col-sm-3 col-xs-12">
                                        <a href="javascript:void(0)" id="pagloadmore" class="btn m-btn">Load More<span class="fa fa-angle-down"></span></a>
                                    </div><br>
                                </div>
                            </div>
						</div>
					<div class="col-lg-3 col-sm-4 col-xs-12">
						<aside class="b-items__aside">
							<h2 class="s-title wow zoomInUp" data-wow-delay="0.5s">REFINE YOUR SEARCH</h2>
							<div class="b-items__aside-main wow zoomInUp" data-wow-delay="0.5s">
								<form action="<?php echo $_SERVER["PHP_SELF"]."?pageno=1"; ?>" method="post">
									<div class="b-items__aside-main-body">
										<div class="b-items__aside-main-body-item">
											<label>CAR TYPE</label>
											<div>
												<select name="cartype" class="m-select" required>
                                                    <option value="">Car Type</option>
                                                    <option value="hatchback">HatchBack</option>
                                                    <option value="sedan">Sedan</option>
                                                    <option value="coupe">Coupe</option>
                                                    <option value="convertable">Convertable</option>
                                                    <option value="suv">SUV</option>
												</select>
												<span class="fa fa-caret-down"></span>
											</div>
										</div>
										<div class="b-items__aside-main-body-item">
											<label>MANUFACTURER</label>
											<div>
                                                <select name="car_manufacturer" required>
                                                    <option value="" selected>Any Make</option>
                                                    <option value="marutisuzuki">Maruti Suzuki</option>
                                                </select>
                                                <span class="fa fa-caret-down"></span>
											</div>
										</div>
										<div class="b-items__aside-main-body-item">
											<label>BUDGET</label>
											<div class="slider"></div>
											<input type="hidden" name="budget" value="100" class="j-min" required />
										</div>
										<div class="b-items__aside-main-body-item">
											<label>MILLAGE</label>
											<div>
                                                <select name="millage">
                                                    <option value="" selected>MILLAGE</option>
                                                    <option value="15">Above 15 KMPL</option>
                                                    <option value="18">Above 18 KMPL</option>
                                                    <option value="20">Above 20 KMPL</option>
                                                </select>
                                                <span class="fa fa-caret-down"></span>
											</div>
										</div>
										<div class="b-items__aside-main-body-item">
											<label>TRANSMISSION</label>
											<div>
                                                <select name="transmission">
                                                    <option value="">Transmission</option>
                                                    <option value="manual">Manual</option>
                                                    <option value="automatic">Automatic</option>
                                                </select>
                                                <span class="fa fa-caret-down"></span>
											</div>
										</div>
										<div class="b-items__aside-main-body-item">
											<label>FUEL TYPE</label>
											<div>
                                                <select name="fuel_type" required>
                                                    <option value="" selected>FUEL</option>
                                                    <option value="petrol">PETROL</option>
                                                    <option value="diesel">DIESEL</option>
                                                </select>
                                                <span class="fa fa-caret-down"></span>
											</div>
										</div>
										<div class="b-items__aside-main-body-item">
											<label>DISPLACEMENT</label>
											<div>
                                                <select name="displacement">
                                                    <option value="" selected>Displacement</option>
                                                    <option value="1000">Above 1000 CC</option>
                                                    <option value="1500">Above 1500 CC</option>
                                                    <option value="2000">Above 2000 CC</option>
                                                    <option value="2500">Above 2500 CC</option>
                                                </select>
                                                <span class="fa fa-caret-down"></span>
											</div>
										</div>
									</div>
									<footer class="b-items__aside-main-footer">
										<button type="submit" name="findmycar" value="findclicked" class="btn m-btn">FILTER VEHICLES<span class="fa fa-angle-right"></span></button><br />
									</footer>
								</form>
							</div>							
						</aside>
					</div>
				</div>
			</div>
		</section><!--b-items-->
		
		
		<div class="b-features">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-md-offset-3 col-xs-6 col-xs-offset-6">
                        <ul class="b-features__items">
							<li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">Low Prices, No Haggling</li>
							<li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">Largest Car Database</li>
							<li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">EMI Calculator</li>
						</ul>
					</div>
				</div>
			</div>
		</div><!--b-features-->
		
		<footer class="b-footer">
			<a id="to-top" href="#this-is-top"><i class="fa fa-chevron-up"></i></a>
			<div class="container">
				<div class="row">
					<div class="col-xs-4">
						<div class="b-footer__company wow fadeInLeft" data-wow-delay="0.3s">
							<div class="b-nav__logo">
								<h3><a href="index.php">Easy<span>Cars</span></a></h3>
								<h2><a href="index.php">Project For SV.CO 2016</a></h2>
							</div>
							
						</div>
					</div>
					<div class="col-xs-8">
						<div class="b-footer__content wow fadeInRight" data-wow-delay="0.3s">
							<div class="b-footer__content-social">
								<a href="#"><span class="fa fa-facebook-square"></span></a>
								<a href="#"><span class="fa fa-twitter-square"></span></a>
								<a href="#"><span class="fa fa-google-plus-square"></span></a>
								<a href="#"><span class="fa fa-instagram"></span></a>
								<a href="#"><span class="fa fa-youtube-square"></span></a>								
							</div>
							<nav class="b-footer__content-nav">
								<ul>
									<li><a href="index.php">Home</a></li>																											
									<li><a href="about.php">About</a></li>
									<li><a href="contacts.php">Contact Us</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer><!--b-footer-->
		</body>
		<!--Main-->
<script src="assets/js/jquery-1.11.3.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.custom.js"></script>
		<!-- jQuery UI Slider -->
		<script src="assets/plugins/slider/jquery.ui-slider.js"></script>
		<script src="assets/js/jquery.smooth-scroll.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/jquery.placeholder.min.js"></script>
		<script src="assets/js/theme.js"></script>
        <script src="assets/js/sweetalert.min.js"></script>
        <script src="assets/js/customfunc_compare.js"></script>
<script>
    $(document).ready(function() {
        $('#pagdiv li:lt(3)').show();
        var items =  "<?php echo $countsize; ?>";
        if (items < 2){
            $('#pagloadmore').hide();
        }
        console.log(items);
        var shown =  3;
        $('#pagloadmore').click(function () {
            shown = $('#pagdiv li:visible').size()+5;
            if(shown< items) {$('#pagdiv li:lt('+shown+')').show();}
            else {$('#pagdiv li:lt('+items+')').show();
                $('#pagloadmore').hide();
            }
        });
    });
</script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/55f6df43c80442b36814b1b5/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</html>