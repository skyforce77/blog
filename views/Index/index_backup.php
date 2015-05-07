<html>

	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="/blog/css/index.css" media="all" />
		<link rel="stylesheet" href="/blog/css/main.css" media="all" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>	
		<script type="text/javascript" src="js/slider.js"></script>	
		<title>TEst</title>
		
	</head>

	<body>
		
		<header>
			<table><tr>			
			<td id="banniere"><img src="/blog/image/bnniere.png"/></td>
			<td id="nav"><a href="">Accueil</a><a href="">Articles</a><a href="">Me connaitre</a><a href="">Mes projets</a><a href="">Me contacter</a></td>				
			</tr></table>
		</header>

		<section>
			<div id="carousel">
				<div id="slider">
					<div id="image">
						<img src="image/slider/info_slider.jpg">
						<img src="image/slider/quadricopter_slider.jpg">
						<img src="image/slider/info_slider.jpg">
					</div>	
					<button id="prev">prev</button><button id="play_pause">Pause</button><button id="next">next</button>		
					<div id="imageNavigation"></div>					
				</div>				
				<div id="legende">
					<ul>
						<li>
							<h1>J'aime l'informatique</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lorem sed malesuada sagittis. Proin hendrerit non dolor sit amet fermentum. Praesent vel justo tempor, facilisis risus porta, co</p>
						</li>
						<li>
							<h1>Mon quadri copter</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lorem sed malesuada sagittis. Proin hendrerit non dolor sit amet fermentum. Praesent vel justo tempor, facilisis risus porta, co</p>
						</li>
						<li>
							<h1>Encore l'informatique</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lorem sed malesuada sagittis. Proin hendrerit non dolor sit amet fermentum. Praesent vel justo tempor, facilisis risus porta, co</p>
						</li>
					</ul>
				</div>
				
			</div>

			<div id="container">
				<h1>Ceci est un titre</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat lorem sed malesuada sagittis. Proin hendrerit non dolor sit amet fermentum. Praesent vel justo tempor, facilisis risus porta, co</p>
				</p>

			</div>

			
		</section>


				<!--<section>
					<div id="caption">
						<ul>
							<li><div class="code" style="background:#B5E655"></div>Informatique</li>
							<li><div class="code" style="background:#F73F3F"></div>Jeux video</li>					
							<li><div class="code" style="background:#FFF"></div>Divers</li>
						</ul>
					</div>
					<?php	
					
						if(isset($_GET['c']))
							$categorie = $_GET['c'];
						else
							$categorie = NULL;
					
						if(!isset($_GET['p']))
							$page=1;
						else
						{
							if(intval($_GET['p'])==0)
								$page=1;
							$page=intval($_GET['p']);
						}
						$sql = 'SELECT * FROM actualite '.$categorie.' LIMIT '. ( $page - 1) * 10 .',10';					
								
							
						$reponse = $bdd->query($sql) or die('Erreur SQL !'.mysql_error());
						$nb_article = $reponse->num_rows;
						
						if ($nb_article == 0)
						{
							echo '<div id="block" style="text-align:center;"><b>Aucun article enregistré.</b></div>';
						}
			
						while ($data = $reponse->fetch_assoc())
						{
							
							echo "<div id=\"block\" style=\"background:".$data["color"]."\">
									 <img src= \"/blog/image/".$data["image"]."\"/>
									".$data["text"]."
									</div>";
						}	
						
						
						echo "<div class='page'>";
						if($page > 3)
						{
						echo "<a href='index.php?p=1'>Début</a>";				
						}
						
						if($page >= 3)
						{
							echo "<a href='index.php?p=".($page-2)."'>".($page-2) ."</a>";
							echo "<a href='index.php?p=".($page-1) ."'>".($page-1) ."</a>";
						}
						elseif($page == 2)
							echo "<a href='index.php?p=".$page-1 ."'>".$page-1 ."</a>";
						else
							echo "";
						
						echo "<strong>".$page."</strong>";
						
						
						if(($nb_article -  $page*10) > 0 && ($nb_article -  $page*10) <= 10 )				
							echo "<a href='index.php?p=".$page+1 ."'>".$page+1 ."</a>";
										
						elseif(($nb_article -  $page*10) > 0 && ($nb_article -  $page*10) <= 20 )
						{
							echo "<a href='index.php?p=".$page+1 ."'>".$page+1 ."</a>";
							echo "<a href='index.php?p=".$page+2 ."'>".$page+2 ."</a>";
						}				
						elseif(($nb_article -  $page*10) >= 20)
						{
							echo "<a href='index.php?p=".$page+1 ."'>".$page+1 ."</a>";
							echo "<a href='index.php?p=".$page+2 ."'>".$page+2 ."</a>";
							echo "<a href='index.php?p=".$nb_article/10 ."'>Fin</a>";
						}
										
						// on ferme la connexion à la base de données.
						$reponse->close ();

					?>
					</div>
				</section>-->
				
		<foot>
			
		</foot>
	
	</body>		
</html>
