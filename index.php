<?
	class Partia {
		public $gracz;
		public $data;
		public $wygrana;
		public $pula;
		public $nd;
			
		public function setGame ($gracz, $data, $wygrana, $pula, $nd){
			$this->gracz = $gracz;
			$this->data = $data;
			$this->wygrana = $wygrana;
			$this->pula = $pula;
			$this->nd = $nd;
		}
		
		public function gracz(){
			return $this->gracz;
		}
		
		public function data(){
			return $this->data;
		}
		
		public function wygrana(){
			return $this->wygrana;
		}
		
		public function pula(){
			return $this->pula;
		}
		
		public function nd(){
			return $this->nd;
		}
	} //koniec klasy Partia
	
	function setDataBase() {
		
		global $player;
		global $mainDataBase;
		global $dateOfGame;
		
		$player = file('players.txt');
		$gameDataBase = file('database.txt');
		
		
		for ($i = 0; $i < count($player); $i++){ //stworzenie bazy danych z obiektami typu Partia. x - id gracza y - id partii
		
			$dateOfGame = explode("\t", $gameDataBase[0]);
			$valueOfGame = explode("\t", $gameDataBase[$i+1]);
		
			for ($j = 0; $j < count($dateOfGame); $j++){
			
				$stats = explode(".", $valueOfGame[$j]);
			
				$mainDataBase[$i][$j] = new Partia;
				$mainDataBase[$i][$j] -> setGame($player[$i], $dateOfGame[$j], $stats[0], $stats[1], $stats[2]);
			}//koniec for($j)
		}//koniec for($i)
		
	}//koniec funkcji setDataBase
	
	function showNameTable($mainDataBase, $dateOfGame, $player){
		echo "<table id='nametable'>";
			echo "<tr id='header-vol'>";
				echo "<tr id='gorna-belka'>";
					echo "<td id='gorny-lewy-rog-vol'>Imię/DataImię DataImię/Data</td>";
				echo "</tr>";	
				echo "<tr id='gorna-belka'>";
					echo "<td id='gorny-lewy-rog'>Imię/Data</td>";
				echo "</tr>";	
					for ($i = 0; $i < count($player); $i++){
						echo "<tr class='linia-gracza'>";
							echo "<td class='imie-gracza'>".$player[$i]."</td>";				
						}
			echo "</tr>";
		echo "</table>";
	}
	
	function showDataBase($mainDataBase, $dateOfGame, $player){												
		echo "<table id='bazadanych'>";
			echo "<tr rowspan=2 id='header'>";
				echo "<tr colspan=3 id='gorna-belka'>";
					//echo "<td rowspan=2 id='gorny-lewy-rog'>Imię/Data</td>";
					for ($i = count($dateOfGame); $i > 0; $i--){
						echo "<td colspan=3 class='gorna-belka-daty'>".$dateOfGame[$i-1]."</td>";
					}
				echo "</tr>";
					
				echo "<tr>";
					for ($i = 0; $i < count($dateOfGame); $i++){
						echo "<td class='header-wygrana'>Wygrana</td>";
						echo "<td class='header-pula'>Pula</td>";
						echo "<td class='header-nd'>ND</td>";
					}
				echo "</tr>";	
			echo "</tr>";	
				for ($i = 0; $i < count($player); $i++){
					echo "<tr class='linia-gracza'>";
						//echo "<td class='imie-gracza'>".$player[$i]."</td>";
						for ($j = count($dateOfGame); $j > 0; $j--){
							echo "<td class='wygrana'>".$mainDataBase[$i][$j-1]->wygrana."</td>";
							echo "<td class='pula'>".$mainDataBase[$i][$j-1]->pula."</td>";
							echo "<td class='nd'>".$mainDataBase[$i][$j-1]->nd."</td>";
						}
					echo "</tr>";	
				}
		echo "</table>";
	}//koniec funkcji showDataBase
	
	function playerWholeMoney($mainDataBase, $dateOfGame, $idGracza){
		$playerMonay = 0;
		
		for ($j = 0; $j < count($dateOfGame); $j++){
			$playerMonay += $mainDataBase[$idGracza][$j]->wygrana;
		}
		return $playerMonay;
	}
	
	function playerND($mainDataBase, $dateOfGame, $idGracza){
		$playerMonay = 0;
		
		for ($j = 0; $j < count($dateOfGame); $j++){
			$playerMonay += $mainDataBase[$idGracza][$j]->nd;
		}
		return $playerMonay;
	}
	
	function playerWholeInside($mainDataBase, $dateOfGame, $idGracza){
		$playerMonay = 0;
		
		for ($j = 0; $j < count($dateOfGame); $j++){
			$playerMonay += $mainDataBase[$idGracza][$j]->pula;
		}
		return $playerMonay;
	}
	
	function playerPresent($mainDataBase, $dateOfGame, $idGracza){
		$playerPresent = 0;
		
		for ($j = 0; $j < count($dateOfGame); $j++){
			if ($mainDataBase[$idGracza][$j]->pula != null) $playerPresent++;
		}
		
		return $playerPresent*100/count($dateOfGame);
	}
	
	/*function maxPartii($mainDataBase, $dateOfGame, $idPartii){
		for ($i = 0; $i < count($player); $i++){
			$tablica[$i] = $mainDataBase[$i][$idPartii]->wygrana;
		}
		
		$varMax = 0;
		
		for ($i = 0; $i < count($player); $i++){
			if($tablica[$i] >= $varMax) $varMax = $tablica[$i];
		}
		
		return $varMax;
	}
	
	function playerWins($mainDataBase, $dateOfGame, $idGracza){
		
		$playerWins = 0;
		
		for ($i = 0; $i < count($dateOfGame); $i++){
			if ($mainDataBase[$idGracza][$i]->wygrana == maxPartii($mainDataBase, $dateOfGame, $i)) $playerWins++;
		}
		
		return $playerWins;
	}*/ //DO NAPRAWY!!!!!!!!!
	
	function personalRanking($mainDataBase, $dateOfGame, $player){		
		echo "<table id='personal-ranking-table'>";
			echo "<tr id='personal-ranking-header-row'><td id='personal-ranking-header-name'>Osobisty ranking</td>";
			echo "<td>Suma wygranej</td>";
			echo "<td>Obecność</td>";
			echo "<td>ND</td></tr>";
			//echo "<td>Wygrane</td></tr>";
			for ($i = 0; $i < count($player); $i++){
				echo "<tr class='personal-ranking-name'>";
					echo"<td class='pr-td-name'>".$player[$i]."</td>";
					echo "<td class='suma'>".playerWholeMoney($mainDataBase, $dateOfGame, $i)."</td>";
					echo "<td class='obecnosc'>".playerPresent($mainDataBase, $dateOfGame, $i)."%</td>";
					echo "<td class='ND'>".playerND($mainDataBase, $dateOfGame, $i)."</td>";
					//echo "<td class='wygrane'>".playerWins($mainDataBase, $dateOfGame, $i)."</td>";
				echo "</tr>";	
			}
		echo "</table>";
	}
	
	function globalRanking($mainDataBase, $dateOfGame, $player){	
		
		$playerSort = $player;
		
		for ($i = 0; $i < count($player); $i++){ //stworzenie tablicy z ratio
			$whole = playerWholeMoney($mainDataBase, $dateOfGame, $i);
			$inside = playerWholeInside($mainDataBase, $dateOfGame, $i);
			$nd = playerND($mainDataBase, $dateOfGame, $i);
			$playerMonayArray[$i] = round(($whole-($nd*600))/$inside, 2);
		}
		
		
		
		for ($j = 0; $j < count($player); $j++){ //posortowanie tablicy z ratio
			for ($i = 0; $i < count($player); $i++){
				if ($playerMonayArray[$i] < $playerMonayArray[$i+1]){
					$x = $playerMonayArray[$i]; $playerMonayArray[$i] = $playerMonayArray[$i+1]; $playerMonayArray[$i+1]= $x;
					$x = $playerSort[$i]; $playerSort[$i] = $playerSort[$i+1]; $playerSort[$i+1]= $x; //posrotowanie tablicy z nazwami graczy
				}
			}
		}
		
		echo "<table id='global-ranking-table'>";
			echo "<tr id='global-ranking-header-row'><td id='global-ranking-header-name'>Globalny ranking</td>";
			echo "<td>Ratio [(wygrana-ND*600)/wkład]</td>";
			for ($i = 0; $i < count($player); $i++){
				$var = $i + 1;
				echo "<tr class='global-ranking-name'>";
					echo"<td class='gl-td-name'>".$var.". ".$playerSort[$i]."</td>";
					echo "<td class='ratio'>".$playerMonayArray[$i]."</td>";
				echo "</tr>";	
			}
		echo "</table>";
	}
	
	setDataBase();
?>

<?php include("header.php"); ?>

		<div id="container">
			<div id="div-names">
				<? showNameTable($mainDataBase, $dateOfGame, $player); ?>
			</div>
			<div id="div-table">
				<? showDataBase($mainDataBase, $dateOfGame, $player); ?>
			</div>
		</div>
		<div id="stats">
			<div id="personal-ranking" class="ranking"><? personalRanking($mainDataBase, $dateOfGame, $player);?></div>
			<div id="global-ranking" class="ranking"><? globalRanking($mainDataBase, $dateOfGame, $player);?></div>
			<div id="game-ranking" class="ranking">Podsumowanie gier</div>
		</div>
		
<?php include("footer.php"); ?>		