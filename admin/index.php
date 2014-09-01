<?php include($path.'header.php');
      include($_SERVER['DOCUMENT_ROOT'].'/embrace/admin/include/verifyUser.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="Devices." class="well span3 top-block" href="#">
					<span class="icon32 icon-orange icon-sent"></span>
					<div>Devices</div>
					<div id="total_d" ></div>
					<span id="today_d" class="notification"></span>
				</a>

				<a data-rel="tooltip" title="Apps." class="well span3 top-block" href="#">
					<span class="icon32 icon-orange icon-document"></span>
					<div>Apps</div>
					<div id="total_a" ></div>
					<span id="today_a" class="notification green"></span>
				</a>

				<a data-rel="tooltip" title="Pairing." class="well span3 top-block" href="#">
					<span class="icon32 icon-orange icon-link"></span>
					<div>Pairing</div>
					<div id="total_p" ></div>
					<span id="today_p" class="notification yellow"></span>
				</a>
				
				<a data-rel="tooltip" title="Fence." class="well span3 top-block" href="#">
					<span class="icon32 icon-orange icon-globe"></span>
					<div>Fence</div>
					<div id="total_f" ></div>
					<span id="today_f" class="notification red"></span>
				</a>
			</div>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Welcome to emBrace Control Panel</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<h1> <small>You know your children are growing up when they stop asking you where they came from and refuse to tell you where they're going.</small></h1>
						<p>Youth was the time for happiness, its only season; young people, leading a lazy, carefree life, partially occupied by scarcely 
						absorbing studies, were able to devote themselves unlimitedly to the liberated exultation of their bodies. They could play, dance,
						love, and multiply their pleasures. They could leave a party, in the early hours of the morning, in the company of sexual partners 
						they had chosen, and contemplate the dreary line of employees going to work. They were the salt of the earth, and everything was 
						given to them, everything was permitted for them, everything was possible. Later on, having started a family, having entered the 
						adult world, they would be introduced to worry, work, responsibility, and the difficulties of existence; they would have to pay 
						taxes, submit themselves to administrative formalities while ceaselessly bearing witness--powerless and shame-filled--to the 
						irreversible degradation of their own bodies, which would be slow at first, then increasingly rapid; above all, they would have 
						to look after children, mortal enemies, in their own homes, they would have to pamper them, feed them, worry about their illnesses,
						provide the means for their education and their pleasure, this would last not just for a season,
						the time of joy was well and truly over for them, they would have to continue to suffer until the end, in pain and with increasing health problems.</p>
						<p class="hide" >Having kids - the responsibility of rearing good, kind, ethical, responsible human beings - is the biggest job anyone can embark on. As with any risk, you have to take a leap of faith and ask lots of wonderful people for their help and guidance. I thank God every day for giving me the opportunity to parent.</p>
						<p><b>If your child marches to a different beat, a different drummer, you might just have to go along with that music. Help them achieve what's important to them.</b></p>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

<?php include('footer.php'); ?>
<script src="<?php echo $path ; ?>js/admin_index.js"></script>				