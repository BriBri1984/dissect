<?php 
class Card
{
	//private properties can only be access inside the class. 
	private $rank;
	private $suite;
	private $htmlColor;
	private $color;
	private $htmlIcon;

	// @samir: The constructor looks great man

								//The arguments will pass the information to the rank and suite properties.
	public function __construct($rankAsFuck,$suiteAsFuck)
	{
		//$this is available in a method, it is a pseudo-variable that references the object
		$this->rank = $rankAsFuck;
		$this->suite = $suiteAsFuck;

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
    // @samir: Yes they certainly will. Typically you should'nt have any HTML in your classes, those will live in templates.
    // Dont worry about templates for now we can do it this way until we get into symfony
	public function render()
	{
		return '
		<div style="border: 5px solid '.$this->cardHtmlColor.'; padding:20px; margin: 10px; width: 20px;">
		'.$this->suite.' '.$this->rank.'<br/>' . $this->htmlIcon.'
		</div>
		';
	}

}
class Deck
{
	//since the property $cards is going to have multiple items I want it's value to be an array
	private $cards = [];

	//when class Deck gets instatiated, I want to call the method getCards() automatically 
	public function __construct()
	{
		//the shuffled array of cards from getCards() transfers the information to the property cards
		$this->cards = $this->getCards();
	}

	// This method will be called later for the class Game
	public function getCard()
	{
		// array_pop is a built in function that will remove the last item in the array. In this case the last card in the shuffled deck.
		return array_pop($this->cards);
	}

	// The purpose for this method is to create all the cards in the deck. This method is private due to the fact that once the card deck is produced, you stay with it throughout the game
	private function getCards()
	{
		// A property named cards that's value is an empty array
		$cards = [];
		// A property named suites that has an array with the types of suites the cards will have
		$suites = ['H','D','S','C'];
		// A property named ranks  that has an array with a range of value each suite will have
		$ranks = [1,2,3,4,5,6,7,8,9,10,'J','Q','K'];


		// This foreach loop with isolate each suite and apply it to the next loop
		foreach ($suites as $suite){
			// This foreach loop is going to grab a individual suite and loop it through each rank. Ex(H1,H2,H3,H4..., then D1,D2,D3,D4... And so on....)
			foreach ($ranks as $rank){
				// All the loops output will be held in the property cards. Since cards is being instatiated with the class Card, each card will have a color and a html icon.
				$cards[] = new Card($rank,$suite);
			}
		}
		// The shuffle function with take the property cards with all the items from the loops and randomly shuffle the array to give them a new order.
		shuffle($cards);
		// Returns the finish product to the property cards when the class Deck is called due to the constructor.
		return $cards;
	}
}
class Player
{
	//??? In this challenge is private and protected the same since there's no inherting classes ???

	// Since the Player class is only tracking one player at a time, the property name  will only have one string as it's value
	protected $name;
	// The hand property will later be used for the class Game to hold the player's cards
	protected $hand =[];

	// This class will be instatiated in the Game class and will be used to hold hold the players name, one by one
	public function __construct($firstName){
		$this->name = $firstName;
	}

	// giveCard method will be used in the class Game, in the method playGame during a loop to hold the player's hand
	public function giveCard($card){
		$this->hand[] = $card;
	}

}

class Game
{
	// Keeps track of the number of cards each player will receive
	protected $numCards;
	// Keeps track of the player's names
	protected $playerNames;
	// Keeps track of the cards each player will receive
	protected $players = [];
	// Holds on to the deck thats transfered from the class Deck
	protected $deck;

	// This constructor will gather the information from the arguments(names,#cards) during the instantiation
								// I know its easier just to name the arguments the same as the properties
								//but i wanted to see the relationships 
	public function __construct($namesOfPlayers,$numberOfCards)
	{
		// Once an object is created it will pass the information to namesOfPlayers and will be inserted to playerNames proprety 
		$this->playerNames = $namesOfPlayers;
		// Deck() is instansiated and is inserted to deck proprety
		$this->deck = new Deck();
		// Once an object is created it will pass the information to numberOfCards and will be inserted to numCards proprety 
		$this->numCards = $numberOfCards;
	}

	
	public function playGame()
	{
		// This foreach loop will give the list of players names and send it to the instantiated object $player, each player will pass thier name as an argument to satisfy constructor in the class Player 
		foreach($this->playerNames as $name){
			$player = new Player($name);

			// This for loop will start at zero, while $i is less than the number of cards in the $numCards proprety, the loop will add an additional card until it reaches the $numCards
			// getCard() will remove the last card from the deck and will store it in this classes $deck proprety, the method $giveCard from the class player will use $desk as an argument
			for ($i=0; $i < $this->numCards; $i++) { 
				$player->giveCard($this->deck->getCard());
			}

			//Each $player will be added to the proprety $players in this class
			$this->players[] = $player;

		}
	}
}


echo '<pre>';
$playerNames = ['Brian', 'Samir', 'Judah', 'Ashley', 'Jason'];
$numOfCards = 3;
$game = new Game($playerNames,$numOfCards);
$game->playGame();
print_r($game);
 
 





