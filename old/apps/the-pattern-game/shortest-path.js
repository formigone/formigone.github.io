/********************************************************
* Copyright 2012 Rodrigo Silveira. All rights reserved.
*********************************************************/

var Shortest = function(){
	this.shell;
	this.scoreBoard;
	this.rows = 0;
	this.cols = 0;
	this.hotValue;
	this.max = 0;
	this.score = 0;
	this.lives = 5;
	this.grid = [];
	this.easiness = 10;
	this.totalClean = 0;
	this.level = 1;
};

Shortest.prototype.showGrid = function(){
	var str = "<table>";

	for (var y = 0; y < this.rows; y++)
	{
		str += "<tr>";
		
		for (var x = 0; x < this.cols; x++)
			str += "<td value='" + this.grid[y][x] + "'></td>";
			
		str += "</tr>";
	}
	
	str += "</table>";
	
	this.shell.innerHTML = str;
};

Shortest.prototype.showScore = function(){
	this.scoreBoard.innerHTML = "<h1>Highscore: <span id='max'>" + this.max + "</span></h1>" +
								"<h1>Score: " + this.score + "</h1>" + 
								"<h1>Lives: " + this.lives + "</h1>" + 
								"<h1>Level: " + this.level + "</h1>" + 
								"<h1>Difficulty: " + (10 - this.easiness) + "</h1>";
};

Shortest.prototype.init = function(pEl, pWidth, pHeight, pScoreBoardEl, pEasiness){
	this.shell = document.querySelector(pEl);
	this.scoreBoard = document.querySelector(pScoreBoardEl);
	this.cols = pWidth;
	this.rows = pHeight;
	this.easiness = pEasiness;
	
	this.hotValue = parseInt(Math.random() * pEasiness * 2);
	this.totalClean = 0;
	
	for (var y = 0; y < pHeight; y++)
	{
		this.grid[y] = [];
		
		for (var x = 0; x < pWidth; x++)
		{
			this.grid[y][x] = parseInt(Math.random() * pEasiness * 2);
			if (this.grid[y][x] != this.hotValue)
				this.totalClean++;
		}
	}

	this.showGrid();
	this.showScore();
	this.setEvents();
};

Shortest.prototype.highLight = function(pEl){
	var classList = pEl.classList;
	
	for (var i = 0, len = classList.length; i < len; i++)
		if (classList[i] == "highlight")
		{
			classList.remove("highlight")
			return true;
		}
		
	classList.add("highlight");
};

Shortest.prototype.isGameOver = function(pSelf){
	if (pSelf.lives < 0)
	{
		pSelf.shell.innerHTML = "<h1>Game Over!</h1><p>Copyright &copy; 2012 Rodrigo Silveira. All rights reserved.<br/><a href='http://www.rodrigo-silveira.com'>http://www.rodrigo-silveira.com</a></p>";
		return true;
	}
	
	if (pSelf.score == pSelf.totalClean)
	{
		alert("Level cleared!");
		pSelf.level++;
		pSelf.init("#" + pSelf.shell.id, pSelf.cols + 1, pSelf.rows + 1, "#" + pSelf.scoreBoard.id, pSelf.easiness);
		
		return true;
	}
	
	return false;
};

Shortest.prototype.cellClicked = function(pCell, pSelf){

	//
	// Kill if clicked on hot block;
	//
	if (pCell.getAttribute("value") == pSelf.hotValue)
	{
		pSelf.lives--;

		if (!pSelf.isGameOver(pSelf))
		{
			alert("You die =(");
			pSelf.score = 0;
			pSelf.init("#" + pSelf.shell.id, pSelf.cols + 1, pSelf.rows + 1, "#" + pSelf.scoreBoard.id, pSelf.easiness);
		}
		
		return;
	}
	
	
	//
	// Ignore multiple clicks to save square
	//
	if (pCell.getAttribute("hit") != "yep")
		pCell.setAttribute("hit", "yep");
	else
		return;
	

	//
	// Update highscore if needed
	//
	if (pSelf.score >= document.querySelector("#max").innerText)
		pSelf.max++;
		
	pSelf.score++;
		
		
	//
	// Update UI
	//
	pSelf.highLight(pCell);
	pSelf.showScore();
	pSelf.isGameOver(pSelf);
};

Shortest.prototype.setEvents = function(){
	var cells = document.querySelectorAll("#" + this.shell.id + " td");
	var self = this;
	
	for (var i = 0, len = cells.length; i < len; i++)
		cells[i].addEventListener("click", function(){self.cellClicked(this, self);});
};
