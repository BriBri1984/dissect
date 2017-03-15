<?php 
class Card
{
	//private properties can only be access inside the class. 
	private $rank;
	private $suite;
	private $htmlColor;
	private $color;
	private $htmlIcon;
								//The arguments will pass the information to the rank and suite properties.
	public function __construct($rankAsFuck,$suiteAsFuck)
	{
		//$this is available in a method, it is a pseudo-variable that references the (class or object???)
		$this->rank = $rankAsFuck;
		$this->site = $suiteAsFuck;

		// if $suiteAsFuck = to H or D
		if ($suiteAsFuck == 'H' || $suiteAsFuck == 'D') 
		{
			// red will be transfered to the color property
			$this->color = 'red';
			//hex color #ff0000(red) will be transfered to the htmlColor property
			$this->htmlColor = '#ff0000';
		}else{
			//if it is not H or D the color and the htmlColor will be black(#000000)
			$this->color = 'black';
			$this->htmlColor = '#000000';
		}

		//if $suiteAsFuck is equal to D, transfer &diams(diamond symbol entity) to htmlIcon property
		if ($suiteAsFuck = 'D') {
			$this->htmlIcon = '&diams;';
		//if $suiteAsFuck is equal to H, transfer &hearts(heart symbol entity) to htmlIcon property
		}elseif ($suiteAsFuck = 'H') {
			$this->htmlIcon = '&hearts;';
		//if $suiteAsFuck is equal to S, transfer &spades(spade symbol entity) to htmlIcon property	
		}elseif ($suiteAsFuck = 'S') {
			$this->htmlIcon = '&spades;';
		//if $suiteAsFuck is equal to C, transfer &clubs(club symbol entity) to htmlIcon property	
		}elseif ($suiteAsFuck = 'C') {
			$this->htmlIcon = '&clubs;';
		}
	}

	//frameworks will have a method named render that has to deal with html markup????
	public function render()
	{
		return '
		<div style="border: 5px solid '.$this->cardHtmlColor.'; padding:20px; margin: 10px; width: 20px;">
		'.$this->suite.' '.$this->rank.'<br/>' . $this->htmlIcon.'
		</div>
		';
	}



}