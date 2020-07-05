// var agents = [];
// console.log(templateUrl)
// let img;
// let text;
// let font;
// function preload() {
//   img = loadImage(templateUrl + '/js/assets/slogan.png');
//   font = loadFont(templateUrl + '/js/assets/Syne-Bold.otf');
// }

// function setup() {

//   pixelDensity(3.0);
//   // createCanvas(400, 400, WEBGL);
//   // canvas.parent('me-link');
//   var canvas = createCanvas(80, 80, WEBGL);
//   canvas.parent('me-link');
//   perspective(PI / 2.5, width / height, 0.001, 900);
//   pg = createGraphics(200, 200);
//   pg.textFont(font);
//   pg.textSize(25);
//   // setGradient(50, 90, 540, 80, c1, c2, 1);
//   pg.fill(255, 255, 255);
//   background(0, 0, 20);
//   //img.resize(800, 200);
//   img.loadPixels();
//   //  image(img, 0, 0);
//   img.loadPixels();
//   pg.text('Marie Dvorzak Marie Dvorzak', -1, 130);
//   //pass image as texture



//   for (var i = 0; i < 200; i++) {
//     agents.push(new Agent());
//   }
//   console.log(img.pixels);

// }
// let count = 0;
// function draw() {
//   // rotateX(0.3);
//   // rotateZ(-0.7);
//   // rotateX(count);
//   push();
//   rotateX(0.8);
//   rotateZ(-0.7);

//   background(8, 8, 8);
//   noStroke();
//   fill(255, 255, 255);
//   box(1, 70, 1);
//   pop();

//   push();

//   // push();
//   rotateX(0.6);
//   rotateZ(-0.8);
//   // pop();

//   rotateY(count);
//   fill(255, 0, 255)
//   texture(pg);
//   sphere(35, 160, 186);
//   pop();


//   count += 0.005;
//   for (var i = 0; i < 200; i++) {
//     //agents[i].draw(); 
//   }
// }

// function Agent() {
//   this.x = random(windowWidth);
//   this.y = random(windowHeight);
// }


// Agent.prototype.draw = function () {
//   //fill(random(255), random(255), random(255));
//   //ellipse(this.x, this.y, 40, 40);
//   let c = get(this.x, this.y);
//   if ((c[0] !== 0) && (c[1] !== 0) && (c[2] !== 0)
//     //(cLast[0] !== 0) && (cLast[1] !== 0) && (cLast[2] !== 0)
//   ) {

//     stroke(100, 100, 100, 20);
//     strokeWeight(3);
//     line(this.lastX, this.lastY, this.x, this.y);
//     this.lastX = this.x;
//     this.lastY = this.y;
//     this.x = this.x + random(2) - 1;
//     this.y = this.y + random(2) - 1;
//   }

// }

// function setGradient(x, y, w, h, c1, c2, axis) {
//   noFill();

//   if (axis === Y_AXIS) {
//     // Top to bottom gradient
//     for (let i = y; i <= y + h; i++) {
//       let inter = map(i, y, y + h, 0, 1);
//       let c = lerpColor(c1, c2, inter);
//       stroke(c);
//       line(x, i, x + w, i);
//     }
//   } else if (axis === X_AXIS) {
//     // Left to right gradient
//     for (let i = x; i <= x + w; i++) {
//       let inter = map(i, x, x + w, 0, 1);
//       let c = lerpColor(c1, c2, inter);
//       stroke(c);
//       line(i, y, i, y + h);
//     }
//   }
// }
