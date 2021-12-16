

<html><head><meta name="viewport" content="width=device-width, initial-scale=1"></head> <body style="background-color: green "><canvas id="canvas" style="border:10px solid #000000;" <="" canvas="">
<script>
const ROWS = 20;
const COLS = 20;
const CANVAS_HEIGHT = 500;
const CANVAS_WIDTH = 500;
const SQUARE = 25;
const COLOR = "blue";
const FOOD = 4;
const RIGHT = 5;
const LEFT = 6;
const UP = 7;
const DOWN = 8;

var cn = document.getElementById("canvas");
cn.width = 2*CANVAS_WIDTH;
cn.height = 2*CANVAS_HEIGHT;

cn.style.height = CANVAS_HEIGHT + "px";
cn.style.width = CANVAS_WIDTH + "px";
cn.getContext("2d").scale(2,2);

class Board {
    constructor(rows, cols, square, color) {
        this.grid = [];
        this.ROWS = rows;
        this.COLS = cols;
        for(let i = 0; i < rows; i++) {
            this.grid.push(new Array(cols));
        }
        this.SQUARE = square;
        this.fill = document.getElementById("canvas").getContext("2d");
        this.COLOR = color;

        this.eat = 0;
        let x = 0;
        let y = rows - 1;
        this.head = new Snode(x, y);
        this.grid[y][x] = this.head;
        this.tail = this.head;
        this.draw(y, x);
        this.makeFood();
        this.lastOrientation = "UP";
        this.length = 1;
        this.hasFood = false;
    }
    draw(row, col) {
        this.fill.fillStyle = this.COLOR;
        this.fill.fillRect(col * 25 + 1, row * 25 + 1, this.SQUARE - 2, this.SQUARE - 2);
    }
    erase(row, col) {
        this.fill.clearRect(col * 25, row * 25, this.SQUARE, this.SQUARE);
    }
    makeFood() {
        let y = Math.floor(Math.random() * this.ROWS);
        let x = Math.floor(Math.random() * this.COLS);
        while(this.grid[y][x] !== undefined && !this.hasFood) {
            y = Math.floor(Math.random() * this.ROWS);
            x = Math.floor(Math.random() * this.COLS);
        }
        if(!this.hasFood){
            this.grid[y][x] = FOOD;
            this.drawFood(y, x);
            this.hasFood = true;
        }
    }
    drawFood(row, col) {
        this.fill.fillStyle = "red";
        this.fill.fillRect(col * 25 + 1, row * 25 + 1, this.SQUARE - 2, this.SQUARE - 2);
    }
    update(orientation) {
        if(this.length > 1) {
            if(orientation == UP && this.lastOrientation == DOWN) orientation = DOWN;
            if(orientation == DOWN && this.lastOrientation == UP) orientation = UP;
            if(orientation == LEFT && this.lastOrientation == RIGHT) orientation = RIGHT;
            if(orientation == RIGHT && this.lastOrientation == LEFT) orientation = LEFT;
        }
        let x = this.head.x;
        let y = this.head.y;
        if(orientation == UP) y--;
        else if (orientation == DOWN) y++;
        else if (orientation == RIGHT) x++;
        else x--;
        if(y >= this.ROWS || y < 0 || x >= this.COLS || x < 0 || (this.grid[y][x] != undefined && this.grid[y][x] != FOOD)){
            RUNNING = false;
            return;
        }
        let s = new Snode(x, y, null);
        this.head.next = s;
        if(this.grid[y][x] === FOOD){
            this.eat += 3;
            this.makeFood();
            this.hasFood = false
        }
        //hold tail still if eating
        if(this.eat > 0){
            this.eat--;
            this.length++;
        }
        else{
            this.grid[this.tail.y][this.tail.x] = undefined;
            this.erase(this.tail.y, this.tail.x);
            this.tail = this.tail.next;
        }
        //update the head;
        this.grid[y][x] = s;
        this.draw(y, x);
        this.head = this.head.next;
        this.lastOrientation = orientation;
    }
    auto(){
        var newOrientation;
        if(this.head.y !=0 && this.head.x != this.COLS - 1){
            //zig zag upwards
            
            if((this.head.x == 0 || this.head.x == this.COLS - 2) && this.lastOrientation != UP && this.lastOrientation != DOWN){
                newOrientation = UP;
            }
            else if( this.lastOrientation == UP || this.lastOrientation == DOWN){
                newOrientation = this.head.x == 0 ? RIGHT : LEFT;
            }
            else newOrientation = this.lastOrientation;  
        }
        else if (this.head.y == 0) {
            newOrientation = RIGHT;
        }
            //newOrientatio n = this.head.x == this.COLS - 1 ? DOWN : RIGHT
        board.update(newOrientation);
    }
}


class Snode {
    constructor(x, y, next) {
        this.x = x;
        this.y = y;
        this.next = next;
    }
}

var board;

var lastFrameTimeMS = 0;
var maxFPS = 20;
var key = RIGHT;
var RUNNING = false;
function mainLoop(timestamp) {
    if(!RUNNING) return;
    if (timestamp < lastFrameTimeMS + (1000 / maxFPS)) {
        requestAnimationFrame(mainLoop);
        return;
    }
    lastFrameTimeMS = timestamp;
    board.update(key);
    //board.auto()
    requestAnimationFrame(mainLoop);
}

document.onkeydown = function(evt) {
  evt = evt || window.event;
  var charStr = evt.key
    if(!RUNNING){
        document.getElementById("canvas").getContext("2d").clearRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        board = new Board(ROWS, COLS, SQUARE, COLOR)
        requestAnimationFrame(mainLoop);
        RUNNING = true;
    }
    if(charStr == "W" || charStr == "ArrowUp") key = UP;
    if(charStr == "A" || charStr == "ArrowLeft") key = LEFT;
    if(charStr == "S" || charStr == "ArrowDown") key = DOWN;
    if(charStr == "D" || charStr == "ArrowRight") key = RIGHT;
}
</script>
</canvas><p style="font-family: Arial;">press any key to play</p> 
<!--
<audio loop autoplay controls>
    <source src="music.mp3" type="audio/mp3">
</audio>
-->
</body><body></body></html>
